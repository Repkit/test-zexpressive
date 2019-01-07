<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    // API
    $app->get('/pages[/{id}]', Pages\Handler\Bage::class, 'api.page');
    /*$app->post('/api/users', [
        Authentication\AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        App\User\CreateUserHandler::class
    ]);
    $app->route('/api/users/{id}', [
        Authentication\AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        App\User\ModifyUserHandler::class
    ], ['PATCH', 'DELETE'], 'api.user');*/
};