<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/artistService.php';

class DanceController extends Controller
{
    private $artistService;

    function __construct()
    {
        $this->artistService = new ArtistService();
    }
    public function index()
    {
        $this->displayView($this);
    }

    public function artist()
    {
        if (isset($_GET['id'])) {
            $_SESSION['artist_id'] = $_GET['id'];
            $artist = $this->artistService->getArtistById($_SESSION['artist_id']);

            $_SESSION['artist_name'] = $artist->getName();
            $_SESSION['artist_genre'] = $artist->getGenre();
            $_SESSION['artist_description'] = $artist->getDescription();
            $_SESSION['artist_image'] = $artist->getArtistImage();

            $this->displayView($this);

        } else {
            header('Location: /dance');
            exit();
        }


    }

    public function tickets()
    {
        if (isset($_SESSION['user_id'])) {
            $this->displayView($this);
        } else {
            header('Location: /login');
            exit();
        }
    }

}