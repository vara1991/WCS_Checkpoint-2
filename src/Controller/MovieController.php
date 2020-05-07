<?php


namespace App\Controller;

use App\Model\MovieManager;

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
    public function list(): string
    {
        $movieManager = new movieManager();
        $movies = $movieManager->selectAll();
        return $this->twig->render('Movie/list.html.twig', ['movies' => $movies]);
    }

}