<?php

namespace Reinfi\RequestListener\Service\Factory;

use Psr\Container\ContainerInterface;
use Reinfi\RequestListener\Service\ListenerService;
use Laminas\Stdlib\RequestInterface;

/**
 * @package Reinfi\RequestListener\Service\Factory
 */
class ListenerServiceFactory
{
    public function __invoke(ContainerInterface $container): ListenerService
    {
        $application = $container->get('Application');

        $eventManager = $application->getEventManager();
        /** @var RequestInterface $request */
        $request = $container->get('Request');

        /** @var array $config */
        $config = $container->get('Config');

        $cliListener = $config['cli_listeners'] ?? [];
        $httpListener = $config['http_listeners'] ?? [];

        return new ListenerService(
            $container,
            $eventManager,
            $request,
            $cliListener,
            $httpListener
        );
    }
}
