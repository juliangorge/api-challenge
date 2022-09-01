<?php
namespace ReportsAPI\V1\Rest\Reports;

use Psr\Container\ContainerInterface;

class ReportsResourceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ReportsResource(
            $container->get(ReportsTableGateway::class),
            'id',
            ReportsCollection::class
        );
    }
}
