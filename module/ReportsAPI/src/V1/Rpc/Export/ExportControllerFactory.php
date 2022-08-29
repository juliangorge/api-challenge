<?php
namespace ReportsAPI\V1\Rpc\Export;

class ExportControllerFactory
{
    public function __invoke($controllers)
    {
        return new ExportController();
    }
}
