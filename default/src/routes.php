<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\Poll;
use simplon\entities\Option;
use simplon\dao\DaoPoll;
use simplon\dao\DaoOption;

// Routes

$app->post('/polls', function(Request $request, Response $response, array $args) {
    $dao = new DaoPoll();
    $json = $request->getBody();
    $poll = json_decode($json, true);
    $options = [];

    foreach ($poll['options'] as $key => $option) {
        $options[] = new Option(0, $option['text'], 0);
    }

    $poll = new Poll(0, $poll['title'], $options);

    return $response->withJson( $dao->addWithOptions($poll) );
});

$app->get('/polls/{id}', function(Request $request, Response $response, array $args) {
    $dao = new DaoPoll();
    $poll = $dao->getByIdWithOptions($args['id']);
    return $response->withJson( $poll->get() );
});

$app->patch('/options/{id}/vote', function(Request $request, Response $response, array $args) {
    $dao = new DaoOption();
    $option = $dao->vote($args['id']);
    return $response->withJson( $option->get() );
});