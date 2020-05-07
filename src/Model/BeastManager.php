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

    public function selectOneBeast(int $id)
    {
        $statement = $this->pdo->prepare("SELECT  beast.id, beast.name, beast.picture, beast.size, beast.area, beast.id_movie, 
        beast.id_planet, planet.id as planet_id, planet.name as planet_name, movie.id as movie_id, movie.title 
        FROM " . self::TABLE . " LEFT JOIN planet ON beast.id_planet=planet.id RIGHT JOIN movie ON beast.id_movie=movie.id 
        WHERE beast.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function updatePlanet(array $planet):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE planet SET `name` =:name WHERE id=:id");
        $statement->bindValue('id', $planet['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $planet['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function selectAllPlanets(): array
    {
        return $this->pdo->query('SELECT * FROM planet')->fetchAll();
    }

    public function selectAllMovies(): array
    {
        return $this->pdo->query('SELECT * FROM movie')->fetchAll();
    }

    public function insertBeast(array $beast) : int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,`picture`,`size`,`area`,
        `id_movie`,`id_planet`) 
        VALUES (:name,:picture,:size,:area,:id_movie,:id_planet)");
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', intval($beast['id_movie']), \PDO::PARAM_INT);
        $statement->bindValue('id_planet', intval($beast['id_planet']), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function insertPlanet(array $planet) : int
    {
        $statement = $this->pdo->prepare("INSERT INTO planet (`name`) VALUES (:name)");
        $statement->bindValue('name', intval($planet['name']), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function insertMovie(array $movie) : int
    {
        $statement = $this->pdo->prepare("INSERT INTO movie (`title`) VALUES (:title)");
        $statement->bindValue('title', intval($movie['title']), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

}
