<?php

use App\Controllers\MarcaVehiculoController;
use Slim\App;

return function (App $app) {

    //ruta para prueba que se hace bien el ruteo, localhost/
    $app->get('/', function ($request, $response) {
        $body = json_encode(['msg' => 'api ok!']);
        $response->getBody()->write($body);
        return $response->withHeader('Content-Type', 'application/json');
    });

    //rutas de marcas
    $app->get('/marcas', [MarcaVehiculoController::class, 'obtenerTodas']);


    //rutas de vehiculos
    
};