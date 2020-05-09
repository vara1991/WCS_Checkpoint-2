<?php


namespace App\Controller;

use App\Model\PlanetManager;

/**
 * Class PlanetController
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
    public function list() : string
    {
        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();
        return $this->twig->render('Planet/list.html.twig', ['planets' => $planets]);
    }

    public function details(int $id)  : string
    {
        $planetManager = new PlanetManager();
        $planet = $planetManager->selectOneById($id);
        return $this->twig->render('Planet/details.html.twig', [
          'planet' => $planet
        ]);
    }

    public function edit(int $id) : string
    {
        $planetManager = new PlanetManager();
        $planet = $planetManager->selectOneById($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $item = [
            'id' => $id,
            'name' => $_POST['name']
          ];
          $planetManager->update($item);
          header('Location: /planet/details/'.$id);
        }

        return $this->twig->render('Planet/edit.html.twig', [
          'planet' => $planet
        ]);
    }
}
