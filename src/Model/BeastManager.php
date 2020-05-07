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

    //public function selectOnebeast(int $id){
    // $statement = $this->pdo->prepare("SELECT beast.id, beast.name, beast.size, beast.area, movie.id as movie_id, movie.title as movie_title, planet.id as planet_id, planet.name as planet_name
    // FROM " . self::TABLE . " JOIN movie ON movie.id=beast.movie_id JOIN planet ON planet.id=beast.planet_id WHERE beast.id=:id");
    //  $statement->bindValue('id', $id, \PDO::PARAM_INT);
    // $statement->execute();

    //return $statement->fetch();
    // }

    public function update(array $beast):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name, `planet_id` = :planet_id, `movie_id` = :movie_id WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $beast['title'], \PDO::PARAM_STR);
        $statement->bindValue('planet_id', $beast['planet'], \PDO::PARAM_INT);
        $statement->bindValue('movie_id', $beast['movie'], \PDO::PARAM_INT);

        return $statement->execute();
    }


    public function insert(array $beast): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `pictures`,`planet_id`,`area`, `size`, `movie_id`) VALUES (:name, :pictures, :planet, :area, :size, :movie)");
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('pictures', $item['pictures'], \PDO::PARAM_STR);
        $statement->bindValue('planet', $item['planet_id'], \PDO::PARAM_STR);
        $statement->bindValue('area', $item['area'], \PDO::PARAM_STR);
        $statement->bindValue('size', $item['size'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $item['movie_id'], \PDO::PARAM_STR);


        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
