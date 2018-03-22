<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\User;
use simplon\entities\Favorite;
use simplon\dao\DaoUser;

// Routes
// On autorise les requêtes venant d'un autre domaine
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


// route pour créer un user
$app->post('/user', function(Request $request, Response $response, array $args) {
    $dao = new DaoUser();
    // On récupère la payload en json, on n'utilise pas getParsedBody car
    // le body de la requête est encodé en json et non comme un formulaire HTML
    $json = $request->getBody();
    // On parse le JSON pour le convertir en tableau PHP
    $user = json_decode($json, true);
    $favorites = [];
    // Pour chaque favorite du user, on créé une instance de Favorite et on l'ajoute dans un tableau
    foreach ($user['favorites'] as $key => $favorite) {
        $favorites[] = new Favorite(0, $favorite['name']);
    }
    // On peut ensuite instancier un user
    $user = new User(0, $user['name'], $favorites);
    // On enregistre le user dans la base de données et on écrase sa valeur par la nouvelle instance comprenant l'id
    $user = $dao->addWithFavorite($user);
    return $response->withJson( $user->get() );
});
// route pour récupérer un user
$app->get('/user/{id}', function(Request $request, Response $response, array $args) {
    $dao = new DaoUser();
    // on recupère l'user avec ses favorites dans la base de données
    $user = $dao->getByIdWithFavorites($args['id']);
    // on retroune le contenu du user en JSON
    return $response->withJson( $user->get() );
});
