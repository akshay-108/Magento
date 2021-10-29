<?php

// namespace Ambab\EmiCalc\Setup;

// use \Magento\Framework\Setup\UpgradeDataInterface;
// use \Magento\Framework\Setup\ModuleContextInterface;
// use \Magento\Framework\Setup\ModuleDataSetupInterface;

// /**
//  * Class UpgradeData
//  *
//  * @package Thecoachsmb\Mymodule\Setup
//  */
// class UpgradeData implements UpgradeDataInterface
// {

//     /**
//      * Creates sample articles
//      *
//      * @param ModuleDataSetupInterface $setup
//      * @param ModuleContextInterface $context
//      * @return void
//      */
//     public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
//     {
//         $setup->startSetup();

//             $tableName = $setup->getTable('bank_emi_details');

//             $data = [
//                 [
//                     'id' => 1,
//                     'Bank_Name' => 'Test Bank 1',
//                     'Emi_Plan' => 3,
//                     'Intrest(pa)' => 11,
//                     'Total_Cost' => 42000,
//                 ],
//                 [
//                     'id' => 2,
//                     'Bank_Name' => 'Test Bank 2',
//                     'Emi_Plan' => 6,
//                     'Intrest(pa)' => 9,
//                     'Total_Cost' => 38000,
//                 ],
//             ];

//             $setup
//                 ->getConnection()
//                 ->insertMultiple($tableName, $data);
        

//         $setup->endSetup();
//     }
// }