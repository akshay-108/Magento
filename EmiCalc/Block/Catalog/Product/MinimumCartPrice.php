<?php
namespace Ambab\EmiCalc\Block\Catalog\Product;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Checkout\Model\Cart;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\Framework\View\Element\Template;
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku; 

class MinimumCartPrice extends Template
{
    protected $registry;
    protected $grandTotal;
    protected $scopeConfigInterface;
    protected $stockItemRepository;
    protected $getSalableQuantityDataBySku;

    public function __construct(Context $context, array $data = [],
    GetSalableQuantityDataBySku $getSalableQuantityDataBySku,
    \Magento\Framework\Registry $registry, 
    \Magento\Checkout\Model\Cart $grandTotal,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface,  
    StockItemRepository $stockItemRepository
    )
    {
        $this->registry = $registry;
        $this->grandTotal = $grandTotal;
        $this->scopeConfigInterface = $scopeConfigInterface;
        $this->stockItemRepository = $stockItemRepository;
        $this->getSalableQuantityDataBySku = $getSalableQuantityDataBySku;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

  
    public function getGrandTotal(){
        // return $this->grandTotal->getQuote()->getBaseSubtotal();
        return $this->grandTotal->getQuote()->getGrandTotal();
    }

    public function getMinimumCartValue(){
        
        return $this->scopeConfigInterface->getValue('sales/minimum_order/amount');
    }

    // get stock value
    public function getStockItem($productId)
    {
        return $this->stockItemRepository->get($productId);
    }

    public function getCurrentProduct()
    {        
        return $this->registry->registry('current_product')->getId();
    }   

    public function getProductSalableQty($sku)
    {
        $qty =  $this->getSalableQuantityDataBySku->execute($sku);
        return $qty[0]['qty'];
    }
}

