<?php
/**
 * Webkul_Grid Grid Interface.
 *
 * @category    Webkul
 *
 * @author      Webkul Software Private Limited
 */
namespace Ambab\EmiCalc\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    // const ID = 'id';
    const Name = 'Bank_Name';
    const Emi = 'Emi_Plan';
    const Roi = 'Intrest';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set EntityId.
     */
    public function setEntityId($id);
    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getName();

    /**
     * Set Title.
     */
    public function setName($Name);

    /**
     * Get Content.
     *
     * @return varchar
     */
    public function getEmi();

    /**
     * Set Content.
     */
    public function setEmi($Emi);

    /**
     * Get Publish Date.
     *
     * @return varchar
     */
    public function getRoi();

    /**
     * Set PublishDate.
     */
    public function setRoi($Roi);

    
}