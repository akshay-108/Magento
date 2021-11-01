<?php

namespace Ambab\EmiCalc\Model;

use Ambab\EmiCalc\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'bank_emi_details';

    /**
     * @var string
     */
    protected $_cacheTag = 'bank_emi_details';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'bank_emi_details';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Ambab\EmiCalc\Model\ResourceModel\Grid');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getName()
    {
        return $this->getData(self::Name);
    }

    /**
     * Set Title.
     */
    public function setName($Bank_Name)
    {
        return $this->setData(self::Name, $Bank_Name);
    }

    /**
     * Get emi months
     *
     * @return integer
     */
    public function getEmi()
    {
        return $this->getData(self::Emi);
    }

    /**
     * Set Content.
     */
    public function setEmi($Emi_Plan)
    {
        return $this->setData(self::Emi, $Emi_Plan);
    }


    public function getRoi()
    {
        return $this->getData(self::Roi);
    }

    /**
     * Set Content.
     */
    public function setRoi($Roi)
    {
        return $this->setData(self::Roi, $Intrest(pa));
    }
}