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
    public function selectOneById($id)
    {
        $statement = $this->pdo->prepare("
        SELECT beast.id, beast.name, beast.size, beast.picture, beast.area, movie.id as movie_id, movie.title as movie_title, planet.id as planet_id, planet.name as planet_name  
        FROM ". self::TABLE ." 
        JOIN movie ON movie.id=beast.id_movie
        JOIN planet ON planet.id=beast.id_planet
        WHERE beast.id=:id"
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $beast):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title, `planet_id` = :planet_id, `movie_id` = :movie_id WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $beast['title'], \PDO::PARAM_STR);
        $statement->bindValue('planet_id', $beast['planet'], \PDO::PARAM_INT);
        $statement->bindValue('movie_id', $beast['movie'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function selectAll(): array
    {
        return $this->pdo->query('SELECT beast.id, beast.name, beast.size, beast.picture, beast.area, movie.id as movie_id, movie.title as movie_title, planet.id as planet_id, planet.name as planet_name FROM beast JOIN movie ON movie.id=beast.id_movie JOIN planet ON planet.id=beast.id_planet')->fetchAll();
    }
}
