<?php
namespace ReportsAPI\V1\Rest\Reports;

use DomainException;
use Laminas\ApiTools\DbConnectedResource;

class ReportsResource extends DbConnectedResource
{
    public function fetchAll($data = [])
    {
        return new ReportsCollection($this->table->getReportsByIp());
    }
}