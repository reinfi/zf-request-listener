<?php

return [
    'service_manager' => [
        'factories' => [
            \Reinfi\RequestListener\Service\ListenerService::class => \Reinfi\RequestListener\Service\Factory\ListenerServiceFactory::class,
        ],
    ],
];