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
    public function list(): string
    {
        $beastManager = new BeastManager();
        $beasts = $beastManager->selectAll();
        return $this->twig->render('Beast/list.html.twig', ['beasts' => $beasts]);
    }


    /**
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function details(int $id): string
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
    public function add(): string
    {
        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();
        // TODO : A creation page where your can add a new beast.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beastManager = new BeastManager();
            $item = [
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'area' => $_POST['area'],
                'size' => $_POST['size'],
                'movie' => $_POST['movie'],
                'planet' => $_POST['planet']
            ];
            $id = $beastManager->insert($item);
            header('Location:/beast/details/' . $id);
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
    public function edit(int $id): string
    {
        // TODO : An edition page where your can edit a beast.
        $beastManager = new BeastManager();
        $beast = $beastManager->selectOneById($id);

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beastManager = new BeastManager();
            $item = [
                'id' => $id,
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'area' => $_POST['area'],
                'size' => $_POST['size'],
                'movie' => $_POST['movie'],
                'planet' => $_POST['planet']
            ];
            $beastManager->update($item);
            header('Location:/beast/details/' . $id);
        }

        return $this->twig->render('Beast/edit.html.twig', [
            'beast' => $beast,
            'planets' => $planets,
            'movies' => $movies
        ]);
    }

    /**
     * Handle beast deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $itemManager = new BeastManager();
        $itemManager->delete($id);
        header('Location:/beast/list');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function fullcreate(): string
    {
        // TODO : An edition page where your can edit a beast.
        $beastManager = new BeastManager();
        $movieManager = new MovieManager();
        $planetManager = new PlanetManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planet = [
                'name' => $_POST['planet']
            ];
            $movie = [
                'title' => $_POST['movie']
            ];

            $idPlanet = $planetManager->insert($planet);
            $idMovie = $movieManager->insert($movie);

            $beast = [
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'area' => $_POST['area'],
                'size' => $_POST['size'],
                'planet'=> $idPlanet,
                'movie' => $idMovie
            ];
            $id = $beastManager->insert($beast);
            header('Location:/beast/details/' . $id);
        }

        return $this->twig->render('Beast/full_edit.html.twig');
    }
}
