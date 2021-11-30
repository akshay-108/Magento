<?php
namespace Ambab\RestApiData\Model\Api;
use Psr\Log\LoggerInterface;
class Custom
{
    protected $logger;
    protected $orderRepository;
    public function __construct(
        LoggerInterface $logger,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    )
    {
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
    }
    /**
     * @inheritdoc
     */
    public function getOrderId($value)
    {
        try {
            $order = $this->orderRepository->get($value);
            $payment = $order->getPayment()->getData();
            $collection=[];
            foreach ($order->getAllItems() as $item) 
            {
                $collection['product information']=[
                    'Product Name'=>$item->getName(),
                    'Regular Price'=>$item->getOriginalPrice(),
                    'Image'=>$item->getImageUrl(),
                    'Discount'=>$item->getDiscountAmount(),
                    'Quantity'=>$item->getQtyOrdered(),
                    'Special Price'=>$item->getPrice(),
                ];
            } 
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        // $returnArray = json_encode($response);
        return $collection; 
   }
}