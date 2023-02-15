<?php

namespace App\Action\Genre;

use App\Domain\Genre\Service\GenreView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GenreViewAction
{
    private $genreView;

    public function __construct(GenreView $genreView)
    {
        $this->genreView = $genreView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $resultat = $this->genreView->viewGenreList();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
