<?php


namespace App\Controller;

use App\Model\PlanetManager;

/**
 * Class BeastController
 * @package Controller
 */
class PlanetController extends AbstractController
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list(): string
    {
        $pm = new PlanetManager();
        $planets = $pm->selectAll();
        return $this->twig->render('Planet/list.html.twig', ['planets' => $planets]);
    }

    public function details(int $id): string
    {
        $planetManager = new PlanetManager();
        $planet = $planetManager->selectOneById($id);
        return $this->twig->render('Planet/details.html.twig', ['planet' => $planet]);
    }

    public function edit(int $id): string
    {
        // TODO : An edition page where your can edit a beast.
        $planetManager = new PlanetManager();
        $planet = $planetManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = [
                'id' => $id,
                'name' => $_POST['name'],
            ];
            $planetManager->update($item);
            header('Location:/planet/details/' . $id);
        }

        return $this->twig->render('Planet/edit.html.twig', [
            'planet' => $planet
        ]);
    }

}