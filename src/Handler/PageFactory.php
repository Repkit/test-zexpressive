<?php

declare(strict_types=1);

namespace Pages\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Hal\Renderer;

use function get_class;

class PageFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        // $renderer = $container->get(Renderer\JsonRenderer::class);
        $renderer = new Renderer\JsonRenderer();
        return new Page(new \StdClass, $renderer);
    }
}
