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
    public function list(): string
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

        $beastsManager = new BeastManager();
        $moviePlanet = $beastsManager->selectPlanetMovie($id);

        return $this->twig->render('Beast/details.html.twig', [
            'beast' => $beast,
            'moviePlanet' => $moviePlanet
        ]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add(): string
    {
        // TODO : A creation page where your can add a new beast.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beastsManager = new BeastManager();
            $beast = [
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'size' => $_POST['size'],
                'area' => $_POST['area'],
                'movie' => $_POST['movie'],
                'planet' => $_POST['planet'],
            ];
            $id = $beastsManager->insert($beast);
        }
        return $this->twig->render('Beast/add.html.twig');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $beastsManager = new BeastManager();
        $beast = $beastsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beast['name'] = $_POST['name'];
            $beast['picture'] = $_POST['picture'];
            $beast['size'] = $_POST['size'];
            $beast['area'] = $_POST['area'];
            $beast['movie'] = $_POST['movie'];
            $beast['planet'] = $_POST['planet'];

            $beastsManager->update($beast);
        }

        // TODO : An edition page where your can edit a beast.
        return $this->twig->render('Beast/edit.html.twig',
        ['beast' => $beast]);
    }
}
