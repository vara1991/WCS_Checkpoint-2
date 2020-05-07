<?php


namespace App\Controller;

use App\Model\BeastManager;
use App\Model\MovieManager;
use App\Model\planetManager;

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



        return $this->twig->render('Beast/details.html.twig');
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
      $beasts = $$beastsManager -> selectOneById($id);

      $movieManager = new MovieManager();
      $movies = $movieManager->selectAll();

      $planetManager = new PlanetManager();
      $planets = $planetManager->selectAll();
      
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $beasts = [
            'id' => $_POST['id'],
            'beats' => $_POST['beats'],
            'planet' => $_POST['planet'],
            'movie' => $_POST['movie']
        ];  
    }
        return $this->twig->render('Beast/edit.html.twig');
    }
}
