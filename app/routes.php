<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/',\App\Application\Controller\HomeController::class . ':index');
    $app->group('/contact', function (Group $group) {
        $group->get('', \App\Application\Controller\ContactController::class . ':index');
        $group->get('/store', \App\Application\Controller\ContactController::class . ':store');
    });
    //shop/
    $app->group('/shop', function (Group $group) {
        $group->get('', \App\Application\Controller\ShopController::class . ':index');
    });

    $app->group('/users', function (Group $group) {
        $group->get('', \App\Application\Controller\UserController::class . ':index');
        $group->get('/{name}', \App\Application\Controller\UserController::class . ':profile');
    });

    $app->get('/hello/{name}', function ($request, $response, $args) {
      return $this->get('view')->render($response, 'profile.html', [
          'name' => $args['name']
      ]);
    })->setName('profile');

    $app->group('/admin', function (Group $group){
       $group->get('',\App\Application\Controller\Admin\DashboardController::class . ':index');
       $group->group('/product', function (Group $group) {
           $group->get('',\App\Application\Controller\Admin\ProductController::class . ':index');
           $group->get('/create',\App\Application\Controller\Admin\ProductController::class . ':create');
       });
    });
};
