<?php

use App\Config;
use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Error\LoaderError;
use function DI\create;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $twig = Twig::create(
        __DIR__ . '/../template',
        ['cache' => false]
    );
} catch (LoaderError $e){
    die(500);
}

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = new Container();
$container->set(Config::class, create(Config::class)->constructor($_ENV));
$container->set(EntityManager::class, fn(Config $config) => EntityManager::create(
    $config->db,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/Model'])
));

AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->add(TwigMiddleware::create($app, $twig));

$app->run();