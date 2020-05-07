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
    public function details(int $id): string
    {
        // TODO : A page which displays all details of a specific beasts.

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bst = new BeastManager();

            $beast = [
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'size' => $_POST['size'],
                'area' => $_POST['area'],
                'id_movie' => $_POST['id_movie'],
                'id_planet' => $_POST['id_planet'],
            ];
            $id = $bst->details($beast);
        }
        return $this->twig->render('Beast/details.html.twig');

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
            $bst = new BeastManager();

            $beasts = [
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'size' => $_POST['size'],
                'area' => $_POST['area'],
                'id_movie' => $_POST['id_movie'],
                'id_planet' => $_POST['id_planet'],
            ];
            $id = $bst->add($beasts);


        }
        return $this->twig->render('Beast/add.html.twig');
    }


    /**
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function update(int $id): string
    {
        // TODO : An edition page where your can edit a beast.
        $bst = new BeastManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beasts = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'picture' => $_POST['picture'],
                'size' => $_POST['size'],
                'area' => $_POST['area'],
                'id_movie' => $_POST['id_movie'],
                'id_planet' => $_POST['id_planet'],

            ];
            $bst->update($beasts);
            return $this->twig->render('Beast/edit.html.twig');
        }

    }
}



