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
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneById($id);
        return $this->twig->render('Beast/details.html.twig', ['beast' => $beast]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add() : string
    {
      // TODO : A creation page where your can add a new beast.

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $movieManager = new MovieManager();
            $movie = [
                'title' => $_POST['movie']
            ];
            $id_movie = $movieManager->selectAll($movie);

            $planetManager = new PlanetManager();
            $planet = [
                'name' => $_POST['planet']
            ];
            $id_planet = $planetManager->selectAll($planet);

            if(isset($id_movie) && isset($id_planet)){
                $beastManager = new BeastManager();
                $beast = [
                    'name' => $_POST['name'],
                    'size' => $_POST['size'],
                    'area' => $_POST['area'],
                    'picture' => $_POST['picture'],
                    'planet_id' => $id_planet,
                    'movie_id' => $id_movie
                ];
                $beastManager->insert($beast);
                header('Location:/beast/list');
            }
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
      // TODO : An edition page where your can edit a beast.
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneById($id);

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beast = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'size' => $_POST['size'],
                'area' => $_POST['area'],
                'picture' => $_POST['picture'],
                'planet' => $_POST['planet'],
                'movie' => $_POST['movie']
            ];
            $beastManager->update($beast);
            header('Location:/beast/details/' . $id);
        }

        return $this->twig->render('Beast/edit.html.twig', [
            'beast' => $beast,
            'movies' => $movies,
            'planets' => $planets
        ]);
    }
}
