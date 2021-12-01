<?php
namespace Ambab\EmiCalc\Controller\Page;

class EmiPage extends \Magento\Framework\App\Action\Action
{
	protected $pageFactory;
	// protected $bankFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory
		// \Ambab\EmiCalc\Model\BankFactory $bankFactory
		)
	{
		$this->pageFactory = $pageFactory;
		// $this->bankFactory = $bankFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		echo "Hello World";
		return $this->pageFactory->create();
		exit;

		// $bank = $this->bankFactory->create();
		// $collection = $bank->getCollection();
		// foreach($collection as $item){
		// 	echo "<pre>";
		// 	print_r($item->getData());
		// 	echo "</pre>";
		// }
		// exit();
		// return $this->pageFactory->create();
	}
}
