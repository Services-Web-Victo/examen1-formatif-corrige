<?php

namespace App\Domain\Genre\Service;

use App\Domain\Genre\Repository\GenreRepository;

final class GenreView
{
    /**
     * @var GenreRepository
     */
    private $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne la liste de tous les genres.
     *
     * @return array Tous les genres
     */
    public function viewGenreList(): array
    {

        $resultatBrut = $this->repository->selectGenre();

        $listeFinal = [];

        foreach ($resultatBrut as $genreList) {
            $listeTrim = explode(',', $genreList['listed_in']);
            foreach ($listeTrim as $genre) {
                array_push($listeFinal, trim($genre));
            }
        }

        // Tri la liste en ordre alphabétique
        sort($listeFinal);

        // Supprime les doublons et ré-index le tableau
        $resultat = array_values(array_unique($listeFinal));

        return $resultat;
    }


}
