<?php
require "../vendor/autoload.php";
use \Slim\Slim;

// Create and configure Slim app
$config = ['settings' => [

]];

$app = new \Slim\App($config);

// Version group
$app->group('/v1', function () use ($app) {

    $app->get('/hello/{name}', function ($request, $response, $args) {
        return $response->write("Hello " . $args['name']);
    });
});


// Run app
$app->run();