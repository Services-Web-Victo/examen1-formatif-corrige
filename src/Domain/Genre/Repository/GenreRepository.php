<?php

namespace App\Domain\Genre\Repository;

use PDO;

/**
 * Repository.
 */
class GenreRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Sélectionne le genre pour chaque titre.
     *
     * @return array Le genre et le id de chaque titre
     */
    public function selectGenre(): array
    {
        $sql = "SELECT show_id, listed_in FROM netflix_titles; ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result ?? [];
    }

}

