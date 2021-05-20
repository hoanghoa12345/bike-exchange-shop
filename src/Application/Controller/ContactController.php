<?php


namespace App\Application\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;
use App\Application\Models\User;

class ContactController
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
        $users = Capsule::table('users')->get();
        return $this->twig->render($response, 'pages/contact.html', [
            'title' => 'Contact',
            'users' => $users
        ]);
    }

    public function store(Request $request, Response $response, array $args): Response
    {
        /*$flight = new Flight;

        $flight->name = $request->name;

        $flight->save();*/
        $user = new User();
        $user->username = "Test2";
        $user->email = "test2@gmail.com";
        $user->password = "123456";
        $user->fullname = "Test Name2";
        $user->save();
        $response->getBody()->write('Hello world!');
        return $response;
    }
}