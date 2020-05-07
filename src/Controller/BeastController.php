<?php


namespace App\Controller;

use App\Model\BeastManager;

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
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneBeast($id);

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
    public function add() : string
    {
        $selectPlanets = new BeastManager();
        $planets = $selectPlanets->selectAllPlanets();

        $selectMovies = new BeastManager();
        $movies = $selectMovies->selectAllMovies();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST)) {
                $beastManagerB = new BeastManager();
                $beast = [
                    'name' => $_POST['name'],
                    'picture' => $_POST['picture'],
                    'size' => $_POST['size'],
                    'area' => $_POST['area'],
                    'id_movie' => $_POST['movie'],
                    'id_planet' => $_POST['planet']

                ];
                $beastManagerB->insertBeast($beast);

                $beastManagerP = new BeastManager();
                $planet = [
                    'name' => $_POST['planet']
                ];
                $beastManagerP->insertPlanet($planet);

                $beastManagerM = new BeastManager();
                $movie = [
                    'title' => $_POST['movie']
                ];
                $beastManagerM->insertMovie($movie);
            }
        }

        return $this->twig->render('Beast/add.html.twig', [
            'planets' => $planets,
            'movies' => $movies
        ]);
    }


    /**
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id) : string
    {
        // PARTIE EDIT ET UPDATE NON ACHEVEE
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneBeast($id);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET)) {
                $planet['name'] = $_GET['planet_name'];
                $beastManager->updateBeast($beast);
            }
        }
        return $this->twig->render('Beast/details.html.twig', [
                'beast' => $beast
                ]);
    }
}
