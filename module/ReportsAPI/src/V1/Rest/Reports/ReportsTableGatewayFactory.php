<?php 
namespace ReportsAPI\V1\Rest\Reports;

use Psr\Container\ContainerInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator\ArraySerializable;

class ReportsTableGatewayFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ReportsTableGateway(
            'reports',
            $container->get('db_adapter'),
            null,
            $this->getResultSetPrototype($container)
        );
    }

    private function getResultSetPrototype(ContainerInterface $container)
    {
        $hydrators = $container->get('HydratorManager');
        $hydrator = $hydrators->get(ArraySerializable::class);
        return new HydratingResultSet($hydrator, new ReportsEntity());
    }
}
