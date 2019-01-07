<?php
declare(strict_types=1);

namespace Pages\Handler;

use Pages\RestDispatchTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Helper\UrlHelper;
use Pages\Repository\PageModel;

class Bage implements RequestHandlerInterface
{
    private $model;

    use RestDispatchTrait;

    public function __construct(
        PageModel $model,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->model = $model;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    public function get(ServerRequestInterface $request) : ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        return false === $id
            ? $this->getAllPages($request)
            : $this->getPage((int) $id, $request);
    }

    public function getPage(int $id, ServerRequestInterface $request): ResponseInterface
    {
        // var_dump($this->model->getPage($id));exit(__FILE__.'::'.__LINE__);
        return $this->createResponse(
            $request,
            $this->model->getPage($id)
        );
    }

    public function getAllPages(ServerRequestInterface $request): ResponseInterface
    {
        $page = $request->getQueryParams()['page'] ?? 1;
        $users = $this->model->getAll();
        $users->setItemCountPerPage(25);
        $users->setCurrentPageNumber($page);
        return $this->createResponse($request, $users);
    }
}
