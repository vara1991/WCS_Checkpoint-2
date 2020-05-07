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

    public function selectPlanetMovie(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("
        SELECT beast.id, movie.id as movie_id, movie.title as movie_title, planet.id as planet_id, planet.name as planet_name 
        FROM $this->table 
        JOIN movie ON movie.id=beast.id_movie
        JOIN planet ON planet.id=beast.id_planet
        WHERE beast.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }


    public function update(array $item):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `id_planet` = :planet, `id_movie` = :movie WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $item['planet'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $item['movie'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function insert(array $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,`area`,`picture`,`size`,`id_movie`, `id_planet`) VALUES (:name,:area,:picture,:size,:movie, :planet)");
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('area', $item['area'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $item['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $item['size'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $item['id_movie'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $item['id_planet'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


}
