<?php
namespace Ambab\EmiCalc\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Ambab\EmiCalc\Model\Grid', 'Ambab\EmiCalc\Model\ResourceModel\Grid');
    }
}
