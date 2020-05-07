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
}



