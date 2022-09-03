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
            $secondKey = new \DateTime($value['created_at']);
            $sortedArray[$value[$sortByFirstKey] . '_' . $secondKey->format('Y-m-d')][] = $value;
            
            // Tambien podría usarse un array multidimensional
            //$sortedArray[$value[$sortByFirstKey]][$secondKey->format('Y-m-d')][] = $value;
        }

        return $sortedArray;
    }

    private function generateJsonFiles(array $array = [])
    {
        $sortedArray = $this->sortArray($array, 'ip_address');

        foreach($sortedArray as $key => $values)
        {

            $file = fopen($this->jsonLocation . $key . '.json', 'w');

            foreach($values as $value)
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