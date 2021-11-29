<?php
namespace Ambab\EmiCalc\Block\Catalog\Product;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;

class View extends \Magento\Framework\View\Element\Template
{
    /**
         * @var \Ambab\EmiCalc\Helper\Data
     */
    protected $_dataHelper;
    public $collection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ambab\EmiCalc\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ambab\EmiCalc\Helper\Data $dataHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    public function canShowBlock()
    {
        return $this->_dataHelper->isModuleEnabled();
    }

    public function Collection(){

        return $collection = $this->_GridFactory->create()->getCollection();
    }
}