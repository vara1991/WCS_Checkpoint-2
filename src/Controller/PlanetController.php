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

}