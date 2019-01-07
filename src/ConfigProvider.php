<?php

declare(strict_types=1);

namespace Pages;

use Zend\Expressive\Hal\Metadata\MetadataMap;
use Zend\Expressive\Hal\Metadata\RouteBasedCollectionMetadata;
use Zend\Expressive\Hal\Metadata\RouteBasedResourceMetadata;
use Zend\Hydrator\ObjectProperty as ObjectPropertyHydrator;
use Zend\Hydrator\ArraySerializableHydrator;

/**
 * The configuration provider for the Pages module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            MetadataMap::class => $this->getHalConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                // Handler\Page::class => Handler\PageFactory::class,
                Handler\Bage::class => Handler\BageFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'pages'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
    
    public function getHalConfig() : array
    {
        return [
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Repository\PageEntity::class,
                'route' => 'api.page',
                // 'extractor' => ObjectPropertyHydrator::class,
                'extractor' => ArraySerializableHydrator::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => Repository\PageCollection::class,
                'collection_relation' => 'pages',
                'route' => 'api.pages',
            ]
        ];
    }
}
