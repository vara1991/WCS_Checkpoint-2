<?php

namespace App\Model;

/**
 * Class BeastManager
 * @package Model
 */
class BeastManager extends AbstractManager
{

    /**
     *
     */
    const TABLE = 'beast';


    /**
     * BeastManager constructor.
     * @param \PDO $pdo
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectOneById($id){
        $statement = $this->pdo->prepare(
            "SELECT beast.id, beast.name, beast.picture, beast.size, beast.area , movie.id as id_movie, movie.title as movie_title, planet.id as id_planet, planet.name as planet_name 
            FROM ".self::TABLE." 
            JOIN movie ON movie.id=beast.id_movie 
            JOIN planet ON planet.id=beast.id_planet 
            WHERE beast.id=:id"
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * @param array $beast
     * @return int
     */
    public function insert(array $beast): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE ."
            (`name`, `picture`, `size`, `area`, `id_movie`, `id_planet`) 
            VALUES 
            (:name, :picture, :size, :area, :movie, :planet)"
        );

        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_STR);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $beast['movie'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $beast['planet'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    /**
     * @param array $beast
     * @return bool
     */
    public function update(array $beast):bool{
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
            `name` = :name, 
            `picture` = :picture,
            `size` = :size,
            `area` = :area, 
            `id_movie` = :movie, 
            `id_planet` = :planet 
            WHERE id=:id"
        );
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $beast['movie'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $beast['planet'], \PDO::PARAM_INT);
        
        return $statement->execute();
    }

    /**
     * @param array $beast
     * @return bool
     */
    public function edit(array $beast):bool{
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name, `picture` = :picture, `size` = :size, `area` = :area WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        
        return $statement->execute();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
