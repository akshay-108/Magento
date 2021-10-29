<?php
namespace Ambab\Emicalc\Model\ResourceModel\Banks;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
	
	protected $_eventPrefix = 'addbankmenu_addbanks_collection';

    protected $_eventObject = 'addbanks_collection';
	
	/**
     * Define model & resource model
     */
	protected function _construct()
	{
		$this->_init('Ambab\EmiCalc\Model\AllBanksCollection', 'Ambab\EmiCalc\Model\ResourceModel\Allbanks');
	}
}
?>