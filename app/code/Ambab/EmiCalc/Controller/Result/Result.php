<?php

namespace Ambab\EmiCalc\Controller\Result;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Result extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        parent::__construct($context);
    }


    public function execute()
    {
        // $data = $this->getRequest()->getParam('data');
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('Ambab\EmiCalc\Block\Catalog\Product\EmiPrice')
                ->setTemplate('Ambab_EmiCalc::catalog\product\view.phtml')
                ->setData('data',$data)
                ->toHtml();

        $result->setData(['output' => $block]);
        return $result;
    } 
}