<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

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

    public function selectOneBeastById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT beast.id, beast.name, beast.picture, beast.size, beast.area,
        planet.id as planet_id ,planet.name as planet_name, movie.id as movie_id, movie.title as movie_title FROM 
        " .self::TABLE. " 
        JOIN planet ON planet.id=beast.id_planet
        JOIN movie ON movie.id=beast.id_movie
        WHERE beast.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function updateBeast(array $beast):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name, 
        `area` = :area, `picture` = :picture, `size` = :size, 
        `id_planet` = :id_planet, `id_movie` = :id_movie WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('id_planet', $beast['id_planet'], \PDO::PARAM_INT);
        $statement->bindValue('id_movie', $beast['id_movie'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function insertBeast(array $beast): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`name`, `area`, `size`, `picture`, `id_planet`, `id_movie`) 
        VALUES (:name, :area, :size, :picture, :id_planet, :id_movie)");
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('id_planet', $beast['id_planet'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', $beast['id_movie'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
