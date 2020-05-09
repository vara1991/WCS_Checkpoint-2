<?php


namespace App\Controller;

use App\Model\MovieManager;

/**
 * Class MovieController
 * @package Controller
 */
class MovieController extends AbstractController
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list() : string
    {
        $movieManager = new MovieManager();
        $movies = $movieManager->selectAll();
        return $this->twig->render('Movie/list.html.twig', ['movies' => $movies]);
    }

    public function details(int $id)  : string
    {
        $movieManager = new MovieManager();
        $movie = $movieManager->selectOneById($id);
        return $this->twig->render('Movie/details.html.twig', [
          'movie' => $movie
        ]);
    }

    public function edit(int $id) : string
    {
        $movieManager = new MovieManager();
        $movie = $movieManager->selectOneById($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $item = [
            'id' => $id,
            'title' => $_POST['title']
          ];
          $movieManager->update($item);
          header('Location: /movie/details/'.$id);
        }

        return $this->twig->render('Movie/edit.html.twig', [
          'movie' => $movie
        ]);
    }
}
