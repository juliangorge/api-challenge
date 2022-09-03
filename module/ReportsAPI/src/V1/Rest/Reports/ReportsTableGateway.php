<?php 
namespace ReportsAPI\V1\Rest\Reports;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Paginator\Adapter\DbSelect;

class ReportsTableGateway extends TableGateway
{

    private $jsonLocation = './public/data/';

    private function sortArray(array $array, string $sortByFirstKey)
    {
        $sortedArray = [];

        foreach($array as $value)
        {
            $secondKey = $value['created_at']->format('Y-m-d');
            //También podría ser un array multidimensional
            //$sortedArray[$value[$sortByFirstKey]][$secondKey][] = $value;
            $sortedArray[$value[$sortByFirstKey . '_' . $secondKey]][] = $value;
        }

        return $sortedArray;
    }

    private function generateJsonFiles(array $array = [])
    {
        $sortedArray = $this->sortArray($array, 'ip_address');

        foreach($sortedArray as $keyByIpAndDate => $valuesByIpAndDate)
        {

            $file = fopen($this->jsonLocation . $keyByIpAndDate . '.json', 'w');

            foreach($valuesByIpAndDate as $value)
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
        $this->generateJsonFiles($resultSet->toArray());

        return new DbSelect($select, $this->getAdapter(), $this->getResultSetPrototype());
    }
}