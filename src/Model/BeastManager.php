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

    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT beast.id, beast.area, beast.size, beast.name, 
        movie.title as movie_title, movie.id as movie_id, planet.name as planet_name  
        FROM " .self::TABLE . " 
        JOIN movie ON movie.id = beast.id_movie
        JOIN planet ON planet.id = beast.id_planet 
        WHERE beast.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $beast)
    {
        $statement = $this->pdo->prepare("UPDATE " .self::TABLE . " SET 'name' = :name, 'picture' = :picture, 
        'size' = :size, 'area' = :area WHERE 'id' = :id");
        $statement->bindvalue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindvalue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindvalue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindvalue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindvalue('id', $beast['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function insert(array $beast)
    {
        $statement = $this->pdo->prepare("INSERT INTO " .self::TABLE . " 
        ('name', 'picture', 'size', 'area', 'movie_id', 'planet_id') 
        VALUES (:name, :picture, :size, :area, :movie, :planet)");
        $statement->bindvalue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindvalue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindvalue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindvalue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindvalue('movie', $beast['movie_id'], \PDO::PARAM_INT);
        $statement->bindvalue('planet', $beast['planet_id'], \PDO::PARAM_INT);
        if($statement->execute()) {
            return (int)$this->pdo-lastInsertId();
        }
    }

}
