<?php

namespace App\Action\Titre;

use App\Domain\Titre\Service\TitreView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TitreViewAction
{
    private $titreView;

    public function __construct(TitreView $titreView)
    {
        $this->titreView = $titreView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des paramètres dans un tableau
        $queryParams = $request->getQueryParams() ?? [];
        // Récupération de la valeur du paramètre page
        $filtre = $queryParams['filtre'] ?? 'Tous';
        $page = $queryParams['page'] ?? 1;

        $resultat = $this->titreView->afficheTitres($filtre, $page);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
