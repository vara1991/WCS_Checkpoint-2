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
      // TODO : A page which displays all details of a specific beasts.
        $beastsManager = new BeastManager();
        $detailBeasts = $beastsManager->selectOneById($id);
        //var_dump($detailBeasts);die;
        return $this->twig->render('Beast/details.html.twig', ['detailBeasts' => $detailBeasts]);
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
        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beastsManager = new BeastManager();
            $beast = [
                'name' => $_POST['name'],
                'area' => $_POST['area'],
                'picture' => $_POST['picture'],
                'size' => $_POST['size'],
                'planet' => $_POST['planet'],
                'movie' => $_POST['movie']
            ];
            $id = $beastsManager->add($beast);
            header('Location:/beast/details/' . $id);
        }

        return $this->twig->render('Beast/add.html.twig',[
            'planets' => $planets,
            'movies' => $movies,
        ]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit($id) : string
    {
        // TODO : An edition page where your can edit a beast.
        $beastsManager = new BeastManager();
        $detailBeasts = $beastsManager->selectOneById($id);

        if (isset($_POST['delete'])) {
            $deleteBeasts = $beastsManager->delete($id);
            header('Location:/beast/list');
        }

        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();

        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();

        if (!isset($_POST['delete'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $detailBeasts = [
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
                    'area' => $_POST['area'],
                    'picture' => $_POST['picture'],
                    'size' => $_POST['size'],
                    'planet' => $_POST['planet'],
                    'movie' => $_POST['movie']
                ];

                $beastsManager->update($detailBeasts);
                header('Location:/beast/details/' . $id);
            }

        }

            return $this->twig->render('Beast/edit.html.twig', [
                'detailBeasts' => $detailBeasts,
                'planets' => $planets,
                'movies' => $movies,
            ]);

    }
}
