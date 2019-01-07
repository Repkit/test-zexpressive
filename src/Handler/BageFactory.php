<?php

declare(strict_types=1);

namespace Pages\Handler;

use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class BageFactory
{
    public function __invoke(ContainerInterface $container) : Bage
    {
        
        return new Bage(
            // $container->get(UserModel::class),
            new \Pages\Repository\PageModel(),
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class)
        );
    }
}
