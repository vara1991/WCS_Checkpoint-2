<?php

namespace App\Model;

/**
 * Class MovieManager
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

    public function update(array $beast)
    {
        $statement = $this->pdo->prepare("UPDATE ".self::TABLE." SET `title`= :title WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $beast['title'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM ".self::TABLE ." WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}