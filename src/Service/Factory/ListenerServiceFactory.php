<?php

namespace Reinfi\RequestListener\Service\Factory;

use Psr\Container\ContainerInterface;
use Reinfi\RequestListener\Service\ListenerService;
use Zend\Stdlib\RequestInterface;

/**
 * @package Reinfi\RequestListener\Service\Factory
 */
class ListenerServiceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ListenerService
     */
    public function __invoke(ContainerInterface $container)
    {
        $application = $container->get('Application');

        $eventManager = $application->getEventManager();
        /** @var RequestInterface $request */
        $request = $container->get('Request');

        /** @var array $config */
        $config = $container->get('Config');

        $cliListener = isset($config['cli_listener']) ? $config['cli_listener'] : [];
        $httpListener = isset($config['http_listener']) ? $config['http_listener'] : [];

        return new ListenerService(
            $container,
            $eventManager,
            $request,
            $cliListener,
            $httpListener
        );
    }
}