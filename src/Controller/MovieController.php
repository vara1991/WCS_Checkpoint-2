<?php


namespace App\Controller;

use App\Model\BeastManager;
use App\Model\MovieManager;
use App\Model\PlanetManager;

/**
 * Class BeastController
 * @package Controller
 */
class MovieController extends AbstractController
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function list() : string
    {
        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();
        return $this->twig->render('Movie/list.html.twig', ['movies' => $movies]);
    }
}
