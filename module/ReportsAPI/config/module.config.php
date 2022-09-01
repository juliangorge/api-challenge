<?php
return [
    'router' => [
        'routes' => [
            'reports-api.rest.reports' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/reports[/:report_id]',
                    'defaults' => [
                        'controller' => 'ReportsAPI\\V1\\Rest\\Reports\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'reports-api.rest.reports',
        ],
    ],
    'api-tools-rest' => [
        'ReportsAPI\\V1\\Rest\\Reports\\Controller' => [
            'listener' => \ReportsAPI\V1\Rest\Reports\ReportsResource::class,
            'route_name' => 'reports-api.rest.reports',
            'route_identifier_name' => 'report_id',
            'collection_name' => 'reports',
            'entity_http_methods' => [
                0 => 'POST',
                1 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'POST',
                1 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ReportsAPI\V1\Rest\Reports\ReportsEntity::class,
            'collection_class' => \ReportsAPI\V1\Rest\Reports\ReportsCollection::class,
            'service_name' => 'reports',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'ReportsAPI\\V1\\Rest\\Reports\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'ReportsAPI\\V1\\Rest\\Reports\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ReportsAPI\\V1\\Rest\\Reports\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \ReportsAPI\V1\Rest\Reports\ReportsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'reports-api.rest.reports',
                'route_identifier_name' => 'report_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \ReportsAPI\V1\Rest\Reports\ReportsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'reports-api.rest.reports',
                'route_identifier_name' => 'report_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'db-connected' => [
            \ReportsAPI\V1\Rest\Reports\ReportsResource::class => [
                'adapter_name' => 'db_adapter',
                'table_name' => 'reports',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializableHydrator::class,
                'controller_service_name' => 'ReportsAPI\\V1\\Rest\\Reports\\Controller',
                'entity_identifier_name' => 'id',
                'table_service' => 'ReportsAPI\\V1\\Rest\\Reports\\ReportsResource\\Table',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'ReportsAPI\\V1\\Rest\\Reports\\Controller' => [
            'input_filter' => 'ReportsAPI\\V1\\Rest\\Reports\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ReportsAPI\\V1\\Rest\\Reports\\Validator' => [
            0 => [
                'name' => 'ip_address',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
            1 => [
                'name' => 'logged_in_users',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'os_name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
            3 => [
                'name' => 'os_version',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
            4 => [
                'name' => 'processor_info',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
            5 => [
                'name' => 'running_processes',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'ReportsAPI\\V1\\Rest\\Reports\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \ReportsAPI\V1\Rest\Reports\ReportsResource::class => \ReportsAPI\V1\Rest\Reports\ReportsResourceFactory::class,
            \ReportsAPI\V1\Rest\Reports\ReportsTableGateway::class => \ReportsAPI\V1\Rest\Reports\ReportsTableGatewayFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [],
    ],
    'api-tools-rpc' => [],
];
