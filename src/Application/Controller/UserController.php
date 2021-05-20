<?php
declare(strict_types=1);

namespace App\Application\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Application\Models\User;
use Psr\Log\LoggerInterface;
class UserController
{
    private $capsule;
    private $logger;
    private $twig;
    public function __construct(Capsule $capsule, LoggerInterface $logger, Twig $twig)
    {
        $this->capsule = $capsule;
        $this->logger = $logger;
        $this->twig = $twig;
    }

    public function index(Request $request, Response $response, array $args): Response
  {
      /*$capsule = new Capsule;
      $capsule->addConnection([
          'driver' => 'mysql',
          'host' => 'localhost',
          'database' => 'bikeexchange',
          'username' => 'root',
          'password' => '123456',
          'charset' => 'utf8mb4',
          'collation' => 'utf8mb4_unicode_ci',
          'prefix' => '',
      ]);
      $capsule->setAsGlobal();
      $capsule->bootEloquent();
      $users = $this->capsule->table('users')->get();*/
      $users = User::where('id', '=', 1)->get();
      //$users = array("name"=>"Hòa");
      //echo json_encode($users);
      //$this->logger->info($users);
      //$view = Twig::fromRequest($request);
      return $this->twig->render($response, 'users.html', [
          'title' => 'Users',
          'users' => $users
      ]);
  }

    public function profile(Request $request, Response $response, array $args): Response
    {
        return $this->twig->render($response, 'profile.html', [
            'name' => $args['name']
        ]);
    }
}
