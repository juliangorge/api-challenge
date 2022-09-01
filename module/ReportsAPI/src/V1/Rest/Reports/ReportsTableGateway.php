<?php 
namespace ReportsAPI\V1\Rest\Reports;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Paginator\Adapter\DbSelect;

class ReportsTableGateway extends TableGateway
{

    private $plainTextLocation = './public/data/';

    private function sortArray(array $array, string $sortByKey)
    {
        $sortedArray = [];

        foreach($array as $value)
        {
            $sortedArray[$value[$sortByKey]][] = $value;
        }

        return $sortedArray;
    }

    private function generatePlainTextFiles(array $array = [])
    {
        $sortedArray = $this->sortArray($array, 'ip_address');

        foreach($sortedArray as $keyByIp=> $valuesByIp)
        {
            $file = fopen($this->plainTextLocation . $keyByIp . '_' . date('Y-m-d') . '.txt', 'w');

            foreach($valuesByIp as $value)
            {
                fputs($file, json_encode($value));
            }

            fclose($file);
        }
        
    }

    /**
    * @return DbSelect
    */
    public function getReportsByIp()
    {
        $select = $this->getSql()->select();
        $select
            ->columns([
                'id',
                'created_at',
                'ip_address',
                'processor_info',
                'running_processes',
                'logged_in_users',
                'os_name',
                'os_version'
            ])
            ->order([
                'created_at' => 'DESC',
                'ip_address' => 'DESC'
            ]);

        $resultSet = $this->selectWith($select);
        $this->generatePlainTextFiles($resultSet->toArray());

        return new DbSelect($select, $this->getAdapter(), $this->getResultSetPrototype());
    }
}