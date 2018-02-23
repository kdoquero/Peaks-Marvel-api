<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\Poll;
use simplon\dao\DaoPoll;

// Routes


$app->get('/', function (Request $request, Response $response, array $args) {
    $val = [
        "title" => "Toto",
        "options" => [
            ["text" => "option1"],
            ["text" => "option2"],
            ["text" => "option3"],
            ["text" => "option4"]   
        ]
    ];
    return $response->withJson( $val );
})->setName('index');