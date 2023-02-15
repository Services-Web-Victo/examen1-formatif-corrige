<?php

namespace App\Domain\Titre\Service;

use App\Domain\Titre\Repository\TitreRepository;

final class TitreView
{
    /**
     * @var TitreRepository
     */
    private $repository;

    public function __construct(TitreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afficheTitres(string $filtre, int $page)
    {
        // Modifie le filtre pour les termes de la BD
        switch ($filtre) {
            case 'films':
                $genre = "Movie";
                break;
            case 'series':
                $genre = "TV Show";
                break;
            default:
                $genre = "%";
                break;
        }
        $titreParPage = 20;
        $titresFiltre = $this->repository->afficheTitres($genre);
        $nbPagesTotales = ceil(count($titresFiltre) / $titreParPage);

        $indexTitreDebut = ($page - 1) * $titreParPage;
        $titresPourPage = array_slice($titresFiltre, $indexTitreDebut, $titreParPage);

        $resultat = [
            "titres" => $titresPourPage,
            "filtre" => $genre == "%" ? "Tous" : $genre,
            "page" => $page,
            "pages_totales" => $nbPagesTotales
        ];

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
