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
 * Class MovieManager
 * @package Model
 */
class MovieManager extends AbstractManager
{

    /**
     *
     */
    const TABLE = 'movie';


    /**
     * MovieManager constructor.
     * @param \PDO $pdo
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
