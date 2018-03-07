<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\Poll;
use simplon\entities\Option;
use simplon\dao\DaoPoll;
use simplon\dao\DaoOption;

// Routes
// On autorise les requêtes venant d'un autre domaine
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


// route pour créer un poll
$app->post('/polls', function(Request $request, Response $response, array $args) {
    $dao = new DaoPoll();
    // On récupère la payload en json, on n'utilise pas getParsedBody car
    // le body de la requête est encodé en json et non comme un formulaire HTML
    $json = $request->getBody();
    // On parse le JSON pour le convertir en tableau PHP
    $poll = json_decode($json, true);
    $options = [];
    // Pour chaque option du poll, on créé une instance de Option et on l'ajoute dans un tableau
    foreach ($poll['options'] as $key => $option) {
        $options[] = new Option(0, $option['text'], 0);
    }
    // On peut ensuite instancier un poll
    $poll = new Poll(0, $poll['title'], $options);
    // On enregistre le poll dans la base de données et on retourne la réponse en json
    return $response->withJson( $dao->addWithOptions($poll) );
});
// route pour récupérer un poll
$app->get('/polls/{id}', function(Request $request, Response $response, array $args) {
    $dao = new DaoPoll();
    // on recupère le poll avec ses options dans la base de données
    $poll = $dao->getByIdWithOptions($args['id']);
    // on retroune le contenu du poll en JSON
    return $response->withJson( $poll->get() );
});
// route pour voter
$app->patch('/options/{id}/vote', function(Request $request, Response $response, array $args) {
    $dao = new DaoOption();
    // on fait appel à la méthode vote() pour voter pour une option
    $option = $dao->vote($args['id']);
    // on retourne l'option modifiée
    return $response->withJson( $option->get() );
});