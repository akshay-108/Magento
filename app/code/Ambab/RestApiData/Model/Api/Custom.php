<?php
namespace Ambab\RestApiData\Model\Api;
use Psr\Log\LoggerInterface;
use Magento\Store\Model\StoreManagerInterface;
use  \Magento\Catalog\Api\ProductRepositoryInterface;
class Custom
{
    protected $logger;
    protected $orderRepository;
    protected $productRepository;
    protected $_storeManager;

    public function __construct(
        LoggerInterface $logger,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        StoreManagerInterface $storeManager
    )
    {
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->_storeManager = $storeManager;
    }
    /**
     * @inheritdoc
     */
    public function getOrderId($value)
    {
        try {
            $order = $this->orderRepository->get($value);
            
            // get image url
           
            // $shippingInfo=[];
            $collection=[];
            foreach ($order->getAllItems() as $item) 
            {
                $product=$this->productRepository->getByid($item->getProductId());
                $store = $this->_storeManager->getStore();
                $imageURL = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();

                // get final price
                $finalPrice=$item->getOriginalPrice() * $item->getQtyOrdered();

                $collection[]=[
                    'Product Name'=>$item->getName(),
                    'Image url'=>$imageURL,
                    'Order Date'=>$item->getCreatedAt(),
                    'Regular Price'=>$item->getOriginalPrice(),
                    'Discount'=>$item->getDiscountAmount(),
                    'Quantity'=>$item->getQtyOrdered(),
                    'Special Price'=>$item->getPrice(),
                    'Total Order'=>$finalPrice,
                ];

                $shippingInfo=[
                    'Shipping Address'=>$order->getShippingAddress()->getData(),
                    'Shipping Amount'=>$order->getShippingAmount(),
                    'Shipping Method'=>$order->getShippingMethod(),
                    'Payment Method'=>$order->getPayment()->getMethod(),
                ];
                $response = [$collection,$shippingInfo];
            } 
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        return $response;
        
   }
}