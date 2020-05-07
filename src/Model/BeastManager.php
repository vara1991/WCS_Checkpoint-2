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

    public function movie()
    {
        $statement = $this->pdo->prepare("SELECT (movie.title) AS movieTitle FROM movie JOIN beast ON movie.id = beast.id_movie;");
        $statement->execute();
        return $statement->fetch();
    }

    public function planet()
    {
        $statement = $this->pdo->prepare("SELECT (planet.name) AS planetName FROM planet JOIN beast ON planet.id = beast.id_planet;");
        $statement->execute();
        return $statement->fetch();
    }

    public function insert(array $beast)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(`name`, `picture`, `size`, `area`, `id_movie`, `id_planet`) VALUES (:name, :picture, :size, :area, :id_movie, :id_planet)");

        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $beast['movie'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $beast['planet'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

    }

    public function update(array $beast):bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name`, `picture`, `size`, `area`, `id_movie`, `id_planet` = :name, :picture, :size, :area, :id_movie, :id_planet WHERE id=:id");
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('movie', $beast['movie'], \PDO::PARAM_INT);
        $statement->bindValue('planet', $beast['planet'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}


