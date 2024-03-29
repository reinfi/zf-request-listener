<?php

namespace Reinfi\RequestListener;

use Psr\Container\ContainerInterface;
use Reinfi\RequestListener\Service\ListenerService;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleEvent;
use Laminas\ModuleManager\ModuleManagerInterface;

/**
 * @package Reinfi\RequestListener
 */
class Module implements InitProviderInterface, ConfigProviderInterface
{
    public function init(ModuleManagerInterface $manager): void
    {
        $manager->getEventManager()->attach(
            ModuleEvent::EVENT_LOAD_MODULES_POST,
            [
                $this,
                'attachListener'
            ]
        );
    }

    public function attachListener(ModuleEvent $event): void
    {
        /** @var ContainerInterface $container */
        $container = $event->getParam('ServiceManager');

        $container->get(ListenerService::class)->attachListener();
    }

    public function getConfig(): array
    {
        return require __DIR__ . '/../config/module_config.php';
    }
}
