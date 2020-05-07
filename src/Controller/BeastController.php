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
        $beastsManager = new BeastManager();
        $beasts = $beastsManager->selectOneById($id);

        $beastsManager = new BeastManager();
        $movPlan = $beastsManager->selectPlanetMovie($id);

        return $this->twig->render('Beast/details.html.twig', [
            'beasts' => $beasts,
            'movPlan' => $movPlan
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST)) {
                $beastsManager = new BeastManager();
                $beast['name'] = $_POST['name'];
                $beast['area'] = $_POST['area'];
                $beast['picture'] = $_POST['picture'];
                $beast['size'] = $_POST['size'];
                $beast['id_planet'] = $_POST['planet'];
                $beast['id_movie'] = $_POST['movie'];
                $beastsManager->insert($beast);
            }
        }
        $beastsManager = new PlanetManager();
        $planets = $beastsManager->selectAll();

        $beastsManager = new MovieManager();
        $movies = $beastsManager->selectAll();

        return $this->twig->render('Beast/add.html.twig',[
            'planets' => $planets,
            'movies' => $movies
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
        $beastsManager = new PlanetManager();
        $planets = $beastsManager->selectAll();

        $beastsManager = new MovieManager();
        $movies = $beastsManager->selectAll();

        $beastsManager = new BeastManager();
        $beast = $beastsManager->selectOneById($id);

        $beastsManager = new BeastManager();
        $movPlan = $beastsManager->selectPlanetMovie($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST)) {
                $beast['planet'] = $_POST['planet'];
                $beast['movie'] = $_POST['movie'];
                $beastsManager->update($beast);
            }
            header('Location: /Beast/list');
        }

        return $this->twig->render('Beast/edit.html.twig', [
            'beasts' => $beast,
            'movPlan' => $movPlan,
            'planets' => $planets,
            'movies' => $movies
        ]);
    }
}
