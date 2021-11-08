<?php
namespace Ambab\EmiCalc\Block\Catalog\Product;
use Magento\Framework\View\Element\Template;
use Ambab\EmiCalc\Model\Grid;
use Ambab\EmiCalc\Model\ResourceModel;
use Magento\Framework\App\ResourceConnection;

class EmiPrice extends Template
{
    private $resourceConnection;

    public function __construct(ResourceConnection $resourceConnection) 
    {
        $this->resourceConnection = $resourceConnection;
    }
    public function getSbiData()
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();
        // $bankname = 'SBI';
        // $select = $connection->select()
        //     ->from(
        //         ['c' => $tableName],
        //         ['*']
        //     )->where(
        //         "c.Bank_Name = bankname"
        //     );

        // get bank data
        $query="SELECT * FROM $tableName WHERE Bank_Name='SBI'";
        return $sbirecords = $connection->fetchAll($query);
    }
    public function getHdfcData()
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();

        $query="SELECT * FROM $tableName WHERE Bank_Name='HDFC'";
        return $hdfcrecords = $connection->fetchAll($query);

    }
    public function getCitibankData()
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();

        $query="SELECT * FROM $tableName WHERE Bank_Name='Citibank'";
        return $citibankrecords = $connection->fetchAll($query);

    }
    public function Emicalculation($productprice,$finalroi,$months)
    {
        $tableName = $this->resourceConnection->getTableName('bank_emi_details');
        $connection = $this->resourceConnection->getConnection();

        // $emiarray=[];

        $emiamount=($productprice*$finalroi*pow(1+$finalroi,$months))/(pow(1+$finalroi,$months)-1);
        // array_push($emiarray,$emiamount);
        return $emiamount;
    }

    public function getSmallValue($emiamtarray)
    {
        // print_r($emiamtarray);

        return $smallamt=min($emiamtarray);

        // for($i=0; $i<$length;$i++)
        // {
        //     $emiamt=$length[$i];
        // }
    }
}