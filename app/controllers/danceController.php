<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/artistService.php';
require __DIR__ . '/../models/dance.php';

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
            $artist_id = htmlspecialchars($_GET['id']);
            $artist = $this->artistService->getArtistById($artist_id);
            $this->displayView($artist);
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