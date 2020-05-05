<?php

namespace App\Model;

/**
 * Class BeastManager
 * @package Model
 */
class MovieManager extends AbstractManager
{

    /**
     *
     */
    const TABLE = 'movie';


    /**
     * BeastManager constructor.
     * @param \PDO $pdo
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $movie
     * @return int
     */
    public function insert(array $movie): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $movie['title'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    /**
     * @param array $movie
     * @return bool
     */
    public function update(array $movie):bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $movie['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $movie['title'], \PDO::PARAM_STR);
        $statement->execute();

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $movie['id'], \PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }
}
