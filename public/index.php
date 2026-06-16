<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

// Inicializar phpdotenv apuntando a la raíz del proyecto
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

// para interpretar los json de entrada
$app->addBodyParsingMiddleware();

// Cargar las rutas pasándole la instancia de $app
$routes = require __DIR__ . '/../routes/routes.php';
$routes($app);
$app->run();