<?php


namespace App\Controller;

use App\Model\BeastManager;
use App\Model\PlanetManager;
use App\Model\MovieManager;

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
        $beastsManager = new BeastManager();
        $beast = $beastsManager->selectOneById($id);
        return $this->twig->render('Beast/details.html.twig', [
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
        $beastManager = new BeastManager();
       
        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $item = [
            'name' => $_POST['name'],
            'picture' => $_POST['picture'],
            'area' => $_POST['area'],
            'size' => $_POST['size'],
            'planet' => $_POST['planet'],
            'movie' => $_POST['movie'],
          ];
          $id = $beastManager->insert($item);
          header('Location: /beast/details/'.$id);
        }

        return $this->twig->render('Beast/add.html.twig', [
          'movies' => $movies,
          'planets' => $planets
        ]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id) : string
    {
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneById($id);

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $item = [
            'id' => $id,
            'name' => $_POST['name'],
            'picture' => $_POST['picture'],
            'area' => $_POST['area'],
            'size' => $_POST['size'],
            'planet' => $_POST['planet'],
            'movie' => $_POST['movie'],
          ];
          $beastManager->update($item);
          header('Location: /beast/details/'.$id);
        }

        return $this->twig->render('Beast/edit.html.twig', [
          'beast' => $beast,
          'movies' => $movies,
          'planets' => $planets,
        ]);
    }

    public function delete(int $id)
    {
      $beastManager = new BeastManager();
      $beastManager->delete($id);
      header('Location: /beast/list');
    }
}
