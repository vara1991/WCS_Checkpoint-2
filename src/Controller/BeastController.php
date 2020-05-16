<?php


namespace App\Controller;

use App\Model\BeastManager;
use App\Model\MovieManager;
use App\Model\PlanetManager;

/**
 * Class BeastController
 * @package Controller
 */
class BeastController extends AbstractController
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list() : string
    {
        $beastsManager = new BeastManager();
        $beasts = $beastsManager->selectAll();
        return $this->twig->render('Beast/list.html.twig', ['beasts' => $beasts]);
    }


    /**
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function details(int $id)  : string
    {
      // TODO : A page which displays all details of a specific beasts.
        $beastsManager = new BeastManager();
        $beast = $beastsManager->selectOneById($id);
        return $this->twig->render('Beast/details.html.twig',[
            'beast' => $beast
        ]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()  : string
    {
      // TODO : A creation page where your can add a new beast.

        return $this->twig->render('Beast/add.html.twig');
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id) : string
    {
      // TODO : An edition page where your can edit a beast.
        $beastsManager = new BeastManager();
        $beast = $beastsManager->selectOneById($id);

        $moviesManager = new MovieManager();
        $movies = $moviesManager->selectAll();

        $planetsManager = new PlanetManager();
        $planets = $planetsManager->selectAll();

        return $this->twig->render('Beast/edit.html.twig',[
            'beast' => $beast,
            'movies' => $movies,
            'planets' => $planets,
        ]);
    }
}
