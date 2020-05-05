<?php

namespace App\Model;

/**
 * Class BeastManager
 * @package Model
 */
class PlanetManager extends AbstractManager
{

    /**
     *
     */
    const TABLE = 'planet';


    /**
     * BeastManager constructor.
     * @param \PDO $pdo
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $planet
     * @return int
     */
    public function insert(array $planet): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $planet['name'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param array $planet
     * @return bool
     */
    public function update(array $planet):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name WHERE id=:id");
        $statement->bindValue('id', $planet['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $planet['name'], \PDO::PARAM_STR);
        $statement->execute();

        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $planet['id'], \PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }
}