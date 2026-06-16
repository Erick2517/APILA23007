<?php
use Slim\App;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $body = json_encode(['msg' => 'api ok!']);
        $response->getBody()->write($body);
        return $response->withHeader('Content-Type', 'application/json');
    });
};