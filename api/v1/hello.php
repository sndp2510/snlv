<?php

$app->get('/hello/{name}', function ($request, $response, $args) {

    $data = array('hello' => $args['name']);

    return apiOut($data, $request, $response, $args);
});