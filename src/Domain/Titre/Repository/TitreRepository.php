<?php

namespace App\Domain\Titre\Repository;
use App\Factory\LoggerFactory;

use PDO;

/**
 * Repository.
 */
class TitreRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection, LoggerFactory $loggerFactory)
    {
        $this->connection = $connection;
        $this->logger = $loggerFactory
            // Le nom de fichier de log utilisé
            ->addFileHandler('Transaction.log')
            ->createLogger('TitreRepository');

    }

    /**
     * Insére un nouveau titre dans la base de données
     * 
     * @param array $data Les informations du nouveau titre
     * 
     * @return array Les informations du titre qui a été ajouté
     */
    public function insereTitre(array $data): array
    {
        $sql = "INSERT INTO netflix_titles (show_type, title, director, actors, country, date_added, release_year, rating, duration, listed_in, `description`)
            VALUES (:show_type, :title, :director, :actors, :country, :date_added, :release_year, :rating, :duration, :listed_in, :description);";

        $params = [
            "show_type" => $data['show_type'] ?? null,
            "title" => $data['title'] ?? null,
            "director" => $data['director'] ?? null,
            "actors" => $data['actors'] ?? null,
            "country"=> $data['country'] ?? null,
            "date_added" => $data['date_added'] ?? null,
            "release_year" => $data['release_year'] ?? null,
            "rating" => $data['rating'] ?? null,
            "duration" => $data['duration'] ?? null,
            "listed_in" => $data['listed_in'] ?? null,
            "description" => $data['description'] ?? null
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $idTitre = $this->connection->lastInsertId();
        $resultat = $this->afficheTitreParId($idTitre);

        $this->logger->info("Ajout du titre [" . $resultat["title"] . "] id : [" . $resultat["show_id"] . "]");

        return $resultat;
    }

    /**
     * Affiche un titre selon un id
     * 
     * @param int $idTitre Le id du titre à afficher
     * 
     * @return array Les informations du titre
     */
    public function afficheTitreParId(int $idTitre): array
    {
        $sql = "SELECT * FROM netflix_titles WHERE show_id = :id;";
        $params = [
            'id' => $idTitre
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }

    /**
     * Affiche tous les titres avec possibilité de filtre
     * 
     * @param string $filtre Le type de titre à afficher
     * 
     * @return array La liste de tous les titres
     */
    public function afficheTitres(string $filtre): array
    {
        $sql = "SELECT show_id, title FROM netflix_titles WHERE show_type LIKE :filtre;";
        $params = [
            'filtre' => $filtre
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result ?? [];
    }


}

