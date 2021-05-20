<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;
use App\Views\TwigUtilities;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        Capsule::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $capsule = new Capsule;
            $capsule->addConnection($settings->get('db'));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return $capsule;
        },
        Twig::class => function(ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);
            $twig = Twig::create(__DIR__ .'/../templates', ['cache_path' => __DIR__ .'/../var/cache', 'cache_enabled' => false]);
            $twig->addExtension(new TwigUtilities());
            $twig->getEnvironment()->addGlobal('settings', $settings->toArray());
            return $twig;
        }
    ]);
};
