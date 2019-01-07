<?php

declare(strict_types=1);

namespace Pages\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Router;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Zend\Expressive\Hal\HalResource;
use Zend\Expressive\Hal\Link;
use Zend\Expressive\Hal\Renderer\JsonRenderer;
use Pages\Repository;

class Page implements RequestHandlerInterface
{
    /** @var JsonRenderer */
    private $renderer;

    /** @var Repository */
    private $repository;

    public function __construct(
        $repository,
        JsonRenderer $renderer
    ) {
        $this->repository = $repository;
        $this->renderer = $renderer;
    }
    
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        // return new HtmlResponse('hi there'. $id);
        $page = new Repository\PageEntity();
        $page->Id = 1;
        $page->Name = 'home';
        $page->Content = 'hi there';
        $resource = new HalResource($page->toArray());
        $resource = $resource->withLink(new Link('self','/pages/1'));
        $resource = $resource->withLink(new Link('collection','/pages'));
        return new TextResponse(
            $this->renderer->render($resource),
            200,
            ['Content-Type' => 'application/hal+json']
        );
    }
}