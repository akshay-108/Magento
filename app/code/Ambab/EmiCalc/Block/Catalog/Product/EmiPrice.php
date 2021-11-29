<?php
namespace Ambab\EmiCalc\Block\Catalog\Product;
use Magento\Framework\View\Element\Template;
use Ambab\EmiCalc\Model\Grid;
use Ambab\EmiCalc\Model\ResourceModel;
use Magento\Framework\App\ResourceConnection;
use Magento\Checkout\Model\Cart as CustomerCart;

class EmiPrice extends Template
{
    public $resourceConnection;
    protected $registry;
    protected $_GridFactory;
    protected $priceHelper;
    protected $checkoutSession;

    public function __construct(ResourceConnection $resourceConnection,
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Framework\Registry $registry,
    \Magento\Framework\Pricing\Helper\Data $priceHelper,
    \Magento\Checkout\Model\Session $checkoutSession,
    \Ambab\EmiCalc\Model\GridFactory $GridFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    array $data = []) 
    {
        $this->_GridFactory = $GridFactory;
        $this->registry = $registry;
        $this->priceHelper = $priceHelper;
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->resourceConnection = $resourceConnection;
        $this->_storeManager = $storeManager;
    }
    
    // get product price on home page
    public function getProductPrice()
    {
        $product = $this->registry->registry('current_product');
        return $product->getFinalPrice();
    }

    // get only bank name from database 
    public function getBankName()
    {
        return $bankName = $this->_GridFactory->create()->getCollection()
            ->distinct(true)
            ->addFieldToSelect('Bank_Name')
            ->load();
    }

    // get bank details from database
    public function getBankDetails($name)
    {
        return $bankData = $this->_GridFactory->create()->getCollection()
            ->addFieldToFilter('Bank_Name', ['like'=>$name])
            ->load();  
    }

    // emi calculation for all banks
    public function Emicalculation($productprice,$months,$roi)
    {
        $emiamtarray=[];
        
        $finalroi=$roi/(12*100);
        $emiamount=($productprice*$finalroi*pow(1+$finalroi,$months))/(pow(1+$finalroi,$months)-1);
        $total_price=$emiamount*$months;
        $intrestamt=$total_price-$productprice;

        array_push($emiamtarray,$emiamount,$total_price,$intrestamt);

        return $emiamtarray;
    }

    // get smallest amout between all bank emi 
    public function getSmallValue($emiamtarray)
    {
        return $smallamt=min($emiamtarray);
    }


    // checkout page functions

    // get subtotal on checkout page
    public function getSubtotal()
    {
        return $this->getActiveQuoteAddress()->getGrandTotal(); 
    }
    protected function getActiveQuoteAddress()
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->checkoutSession->getQuote();
        if ($quote->isVirtual()) {
            return $quote->getBillingAddress();
        }
        return $quote->getShippingAddress();
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getAjaxData()
    {
        $data = [];
        foreach ($this->getBankName() as $bank){
            $data['getBank'][] = $bank['Bank_Name'];
            $banks = $bank['Bank_Name'];
            foreach ($this->getBankDetails($banks) as $b){
                $data['ROI'][$b['Bank_Name']]['Intrest'] = $b['Intrest'];
                $data['Months'][$b['Bank_Name']]['Emi_Plan'] = $b['Emi_Plan'];
            }
        }
        return json_encode($data);
    }
}