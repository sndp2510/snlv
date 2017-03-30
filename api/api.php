<?php
require "../vendor/autoload.php";
session_start();
use \Slim\Slim;

// check user logged in
if(! isset($_SESSION['user'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    $err = array('error' => 'Unauthorized');
    echo json_encode($err, JSON_PRETTY_PRINT);
    die;
}


$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,
    ],
];

$app = new \Slim\App($config);

$c = $app->getContainer();

$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {

        $err = array('error'   => 'Not found');

        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($err, JSON_PRETTY_PRINT));
    };
};

$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {

        $err = array('error'   => 'Internal server error',
                     'message' => $exception->getMessage());

        return $c['response']
            ->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($err, JSON_PRETTY_PRINT));
    };
};

// Version group
$app->group('/v1', function () use ($app) {

    require 'v1/hello.php';

});

function apiOut($obj, $request, $response, $args) {
    return $response
        ->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($obj, JSON_PRETTY_PRINT));
}

// Run app
$app->run();
