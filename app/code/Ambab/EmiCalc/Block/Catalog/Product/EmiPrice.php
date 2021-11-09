<?php
namespace Ambab\EmiCalc\Block\Catalog\Product;
use Magento\Framework\View\Element\Template;
use Ambab\EmiCalc\Model\Grid;
use Ambab\EmiCalc\Model\ResourceModel;
use Magento\Framework\App\ResourceConnection;

class EmiPrice extends Template
{
    private $resourceConnection;
    protected $registry;
    protected $priceHelper;

    public function __construct(ResourceConnection $resourceConnection,
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Framework\Registry $registry,
    \Magento\Framework\Pricing\Helper\Data $priceHelper,
    array $data = []) 
    {
        $this->resourceConnection = $resourceConnection;
        $this->registry = $registry;
        $this->priceHelper = $priceHelper;
        parent::__construct($context, $data);
    }
    // get product price
    public function getProductPrice()
    {
        $product = $this->registry->registry('current_product');
        return $product->getFinalPrice();
    }

    public function getBankName()
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();

        $query="select DISTINCT Bank_Name from $tableName";
        return $rec = $connection->fetchAll($query);
    }
    public function getBankDetails($name)
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();
        $query="select * from $tableName where Bank_Name = '$name'";
        return $rec = $connection->fetchAll($query);
        // exit();
    }
    public function Emicalculation($productprice,$finalroi,$months)
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();

        // $emiarray=[];

        $emiamount=($productprice*$finalroi*pow(1+$finalroi,$months))/(pow(1+$finalroi,$months)-1);
        // array_push($emiarray,$emiamount);
        return $emiamount;
    }

    public function getSmallValue($emiamtarray)
    {
        
        return $smallamt=min($emiamtarray);
    }
}