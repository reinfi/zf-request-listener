<?php

namespace Reinfi\RequestListener\Service;

use Psr\Container\ContainerInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Stdlib\RequestInterface;
use Laminas\Http\Request as HttpRequest;
use Laminas\Console\Request as ConsoleRequest;

/**
 * @package Reinfi\RequestListener\Service
 */
class ListenerService
{
    private ContainerInterface $container;
    private EventManagerInterface $eventManager;
    private RequestInterface $request;
    private array $cliListener;
    private array $httpListener;

    public function __construct(
        ContainerInterface $container,
        EventManagerInterface $eventManager,
        RequestInterface $request,
        array $cliListener,
        array $httpListener
    ) {
        $this->container = $container;
        $this->eventManager = $eventManager;
        $this->request = $request;
        $this->cliListener = $cliListener;
        $this->httpListener = $httpListener;
    }

    public function attachListener(): void
    {
        $this->attachConsoleListener();
        $this->attachHttpListener();
    }

    private function attachConsoleListener(): void
    {
        if (!$this->request instanceof ConsoleRequest) {
            return;
        }

        foreach ($this->cliListener as $listener) {
            $this->container->get($listener)->attach($this->eventManager);
        }
    }

    private function attachHttpListener(): void
    {
        if (!$this->request instanceof HttpRequest) {
            return;
        }

        foreach ($this->httpListener as $listener) {
            $this->container->get($listener)->attach($this->eventManager);
        }
    }
}
