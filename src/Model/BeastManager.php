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
        // prepared request
        $statement = $this->pdo->prepare(
        "SELECT beast.id, beast.name, beast.picture, beast.size, beast.area, movie.title, planet.name as planet_name
        FROM " . self::TABLE . "
        JOIN movie ON movie.id=beast.id_movie
        JOIN planet ON planet.id=beast.id_planet
        WHERE beast.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function update(array $beast):bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
        "UPDATE " . self::TABLE . " SET `name` = :name, `picture` = :picture, `size` = :size, `area` = :area, `id_movie` = :id_movie, `id_planet` = :id_planet
        WHERE id=:id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', $beast['movie'], \PDO::PARAM_INT);
        $statement->bindValue('id_planet', $beast['planet'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function add(array $beast): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`,`picture`,`size`,`area`, `id_movie`, `id_planet`) 
        VALUES (:name, :picture, :size, :area, :id_movie, :id_planet)");
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_STR);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', $beast['movie'], \PDO::PARAM_STR);
        $statement->bindValue('id_planet', $beast['planet'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function delete($id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

}
