<?php

namespace App\Action\Titre;

use App\Domain\Titre\Service\TitreCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TitreCreateAction
{
    private $titreCreate;

    public function __construct(TitreCreate $titreCreate)
    {
        $this->titreCreate = $titreCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        $resultat = $this->titreCreate->ajouterTitre($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
