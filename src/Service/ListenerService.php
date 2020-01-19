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
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var array
     */
    private $cliListener;

    /**
     * @var array
     */
    private $httpListener;

    /**
     * @param ContainerInterface    $container
     * @param EventManagerInterface $eventManager
     * @param RequestInterface      $request
     * @param array                 $cliListener
     * @param array                 $httpListener
     */
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

    /**
     *
     */
    public function attachListener()
    {
        $this->attachConsoleListener();
        $this->attachHttpListener();
    }

    /**
     * return void
     */
    private function attachConsoleListener()
    {
        if (!$this->request instanceof ConsoleRequest) {
            return;
        }

        foreach ($this->cliListener as $listener) {
            $this->container->get($listener)->attach($this->eventManager);
        }
    }


    /**
     * return void
     */
    private function attachHttpListener()
    {
        if (!$this->request instanceof HttpRequest) {
            return;
        }

        foreach ($this->httpListener as $listener) {
            $this->container->get($listener)->attach($this->eventManager);
        }
    }
}