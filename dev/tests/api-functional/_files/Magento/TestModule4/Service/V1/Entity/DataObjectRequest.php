<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\TestModule4\Service\V1\Entity;

class DataObjectRequest extends \Magento\Framework\Api\AbstractExtensibleObject
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->_get('name');
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->_get('id');
    }

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($Id)
    {
        return $this->setData('id', $Id);
    }
}
