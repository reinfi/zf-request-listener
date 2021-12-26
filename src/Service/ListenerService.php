<?php

namespace Reinfi\RequestListener\Service;

use Psr\Container\ContainerInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Stdlib\RequestInterface;
use RuntimeException;

/**
 * @package Reinfi\RequestListener\Service
 */
class ListenerService
{
    private ContainerInterface $container;
    private EventManagerInterface $eventManager;
    private RequestInterface $request;
    private array $httpListener;

    public function __construct(
        ContainerInterface $container,
        EventManagerInterface $eventManager,
        RequestInterface $request,
        array $httpListener
    ) {
        $this->container = $container;
        $this->eventManager = $eventManager;
        $this->request = $request;
        $this->httpListener = $httpListener;
    }

    public function attachListener(): void
    {
        $this->attachHttpListener();
    }

    private function attachHttpListener(): void
    {
        if (count($this->httpListener) > 0 && !class_exists('Laminas\Http\Request')) {
            throw new RuntimeException('laminas/laminas-http is not installed');
        }

        if (!is_a($this->request, 'Laminas\Http\Request')) {
            return;
        }

        foreach ($this->httpListener as $listener) {
            $this->container->get($listener)->attach($this->eventManager);
        }
    }
}
