<?php


namespace App\Model;


class PlanetManager extends AbstractManager
{
    const TABLE = 'planet';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $planet)
    {
        $statement = $this->pdo->prepare("INSERT INTO " .self::TABLE . " ('name') VALUES (:name)");
        $statement->bindvalue('name', $planet['name'], \PDO::PARAM_STR);
        if($statement->execute()) {
            return (int)$this->pdo-lastInsertId();
        }
    }

}