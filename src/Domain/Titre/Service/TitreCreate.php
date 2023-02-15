<?php

namespace App\Domain\Titre\Service;

use App\Domain\Titre\Repository\TitreRepository;

final class TitreCreate
{
    /**
     * @var TitreRepository
     */
    private $repository;

    public function __construct(TitreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function ajouterTitre(array $data): array
    {
        $resultat = $this->repository->insereTitre($data);

        return $resultat;
    }

    // /**
    //  * Sélectionne la liste de tous les genres.
    //  *
    //  * @return array Tous les genres
    //  */
    // public function viewGenreList(): array
    // {

    //     $resultatBrut = $this->repository->selectGenre();

    //     $listeFinal = [];

    //     foreach ($resultatBrut as $genreList) {
    //         $listeTrim = explode(',', $genreList['listed_in']);
    //         foreach ($listeTrim as $genre) {
    //             array_push($listeFinal, trim($genre));
    //         }
    //     }

    //     // Tri la liste en ordre alphabétique
    //     sort($listeFinal);

    //     // Supprime les doublons et ré-index le tableau
    //     $resultat = array_values(array_unique($listeFinal));

    //     return $resultat;
    // }


}
