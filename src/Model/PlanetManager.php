<?php

namespace App\Model;

/**
 * Class PlanetManager
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

    public function update(array $planet)
    {
        $statement = $this->pdo->prepare("UPDATE ".self::TABLE." SET `name`= :name WHERE id=:id");
        $statement->bindValue('id', $planet['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $planet['name'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM ".self::TABLE ." WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}