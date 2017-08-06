<?php

namespace Reinfi\RequestListener;

use Psr\Container\ContainerInterface;
use Reinfi\RequestListener\Service\ListenerService;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * @package Reinfi\RequestListener
 */
class Module implements InitProviderInterface, ConfigProviderInterface
{
    /**
     * @param ModuleManagerInterface $manager
     */
    public function init(ModuleManagerInterface $manager)
    {
        $manager->getEventManager()->attach(
            ModuleEvent::EVENT_LOAD_MODULES_POST,
            [
                $this,
                'attachListener'
            ]
        );
    }

    /**
     * @param ModuleEvent $event
     */
    public function attachListener(ModuleEvent $event)
    {
        /** @var ContainerInterface $container */
        $container = $event->getParam('ServiceManager');

        $container->get(ListenerService::class)->attachListener();
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return require __DIR__ . '/../config/module_config.php';
    }
}