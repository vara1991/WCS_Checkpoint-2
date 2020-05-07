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
        $planetManager = new PlanetManager();
        $planets = $planetManager->selectAll();
        return $this->twig->render('Planet/list.html.twig', ['planets' => $planets]);
    }

}