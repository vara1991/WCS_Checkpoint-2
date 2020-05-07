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

    public function details(int $id)
    {

        $statement = $this->pdo->prepare("SELECT * FROM beast $this->table");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }


    public
    function add(array $beast): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(`name`, `picture`, `size`, `area`, `id_movie`, `id_planet`) VALUES (:name, :picture, :size, :area, :id_movie, :id_planet)");
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_STR);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', $beast['id_movie'], \PDO::PARAM_INT);
        $statement->bindValue('id_planet', $beast['id_planet'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public
    function update(array $beast): bool
    {
        $statement = $this->pdo->prepare("UPDATE  " . self::TABLE . " SET `name` = :name, `picture` = :picture, `size` = :size, `area` = :area, `id_movie` = :id_movie, `id_planet` = :id_planet  WHERE id= :id");
        $statement->bindValue('id', $beast['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
        $statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
        $statement->bindValue('size', $beast['size'], \PDO::PARAM_STR);
        $statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
        $statement->bindValue('id_movie', $beast['id_movie'], \PDO::PARAM_INT);
        $statement->bindValue('id_planet', $beast['id_planet'], \PDO::PARAM_INT);


    }


}



