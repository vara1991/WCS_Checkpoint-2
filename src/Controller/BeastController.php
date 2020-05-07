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
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneBeastById($id);

        return $this->twig->render('Beast/details.html.twig', ['beast' => $beast]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()  : string
    {
        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['name']) && !empty($_POST['picture']) && !empty($_POST['size']) && !empty($_POST['area'])
            && !empty($_POST['planet']) && !empty($_POST['movie'])) {
                $itemManager = new BeastManager();
                $beast = [
                    'name' => $_POST['name'],
                    'picture' => $_POST['picture'],
                    'size' => $_POST['size'],
                    'area' => $_POST['area'],
                    'id_planet' => $_POST['planet'],
                    'id_movie' => $_POST['movie']
                ];
                $itemManager->insertBeast($beast);
                header('Location:/Beast/list');
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

        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneBeastById($id);

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $beast = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'area' => $_POST['area'],
                'size' => $_POST['size'],
                'picture' => $_POST['picture'],
                'id_planet' => $_POST['planet'],
                'id_movie' => $_POST['movie']
            ];
            $beastManager->updateBeast($beast);
            header('Location:/Beast/details/' . $id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $beastManager = new BeastManager();
            $beastManager->delete($id);
            header('Location:/Beast/list');
        }

        return $this->twig->render('Beast/edit.html.twig', [
            'beast' => $beast,
            'planets' => $planets,
            'movies' => $movies
        ]);
    }

    public function delete(int $id)
    {
        $beastManager = new BeastManager();
        $beastManager->delete($id);
        header('Location:/Beast/list');
    }
}
