<?php


namespace App\Model;


class MovieManager extends AbstractManager
{
    const TABLE = 'movie';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $movie)
    {
        $statement = $this->pdo->prepare("INSERT INTO " .self::TABLE . " ('title') VALUES (:title)");
        $statement->bindvalue('title', $movie['title'], \PDO::PARAM_STR);
        if($statement->execute()) {
            return (int)$this->pdo-lastInsertId();
        }
    }

}