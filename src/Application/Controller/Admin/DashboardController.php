<?php


namespace App\Application\Controller\Admin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Illuminate\Database\Capsule\Manager as Capsule;

class DashboardController
{
    private $capsule;
    private $twig;
    public function __construct(Capsule $capsule, Twig $twig)
    {
        $this->capsule = $capsule;
        $this->twig = $twig;
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        return $this->twig->render($response, 'admin/pages/dashboard.html', [
            'title' => 'Dashboard Page'
        ]);
    }
}