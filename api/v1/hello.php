<?php

$app->get('/hello/{name}', function ($request, $response, $args) {

    $data = array('hello' => $args['name'], 'user' => $_SESSION['user'] );

    return apiOut($data, $request, $response, $args);
});
