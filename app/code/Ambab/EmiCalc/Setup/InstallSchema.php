<?php 
namespace Ambab\EmiCalc\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
//use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('bank_emi_details');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                            ->addColumn(
                                'id',
                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                null,
                     ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                                )
                            ->addColumn(
                                'Bank_Name',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                255,
                                ['nullable'=>false,'default'=>'false']
                                )
                            ->addColumn(
                                'Emi_Plan',
                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                '2M',
                                ['nullbale'=>false]
                                )
                            ->addColumn(
                                'Intrest',
                                \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                                '10,2',
                                ['nullbale'=>false]
                                )
                            ->addIndex(  
                                    $setup->getIdxName(  
                                         $setup->getTable('bank_details'),  
                                         ['bank_name'],  
                                         \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT  
                                    ),  
                                    [ 'bank_name'],  
                                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT]  
                                )
                        
                        
                            ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
 ?>