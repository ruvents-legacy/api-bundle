<?php

namespace Ruvents\ApiBundle\DependencyInjection;

use Ruvents\ApiBundle\Controller\DocsController;
use Ruvents\ApiBundle\DocsExtractor;
use Ruvents\ApiBundle\EventListener\ApiListener;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class RuventsApiExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->autowire(DocsExtractor::class)
            ->setPublic(false);

        $container->register(ApiListener::class)
            ->setPublic(false)
            ->addTag('kernel.event_subscriber');

        $container->autowire(DocsController::class);
    }
}
