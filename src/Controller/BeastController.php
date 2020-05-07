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
    public function details($id)
    {
        $beastsManager = new BeastManager();
        $details = $beastsManager->selectOneById($id);
        return $this->twig->render('Beast/details.html.twig', ['details' => $details]);
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
        $beast = $beastManager->selectAll();
        return $this->twig->render('Beast/add.html.twig', ['beast' => $beast]);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beast = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'planet' => $_POST['planet'],
                'movie' => $_POST['movie']
            ];
            $beastManager->update($beast);
            header('Location:/beast/details/' . $id);
        }

        return $this->twig->render('beast/edit.html.twig', [
            'beast' => $beast,
            'movies' => $movies,
            'planets' => $planets
        ]);
        return $this->twig->render('Beast/edit.html.twig');
    }
}
