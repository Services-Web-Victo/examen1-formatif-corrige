<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class);

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Genres
    $app->get('/genres', \App\Action\Genre\GenreViewAction::class);

    // Titres
    $app->post('/titres', \App\Action\Titre\TitreCreateAction::class);
    $app->get('/titres', \App\Action\Titre\TitreViewAction::class);


};

