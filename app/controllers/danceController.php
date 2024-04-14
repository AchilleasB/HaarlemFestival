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
            $artistId = $_GET['id'];
            $_SESSION['artist_id'] = $artistId;

            if ($this->artistService->artistPageExists($artistId)) {
                $artist = $this->artistService->getArtistById($_SESSION['artist_id']);

                $_SESSION['artist_name'] = $artist->getName();
                $_SESSION['artist_genre'] = $artist->getGenre();
                $_SESSION['artist_image'] = $artist->getArtistImage();

                $this->displayView($this);
            }
            else {
                require __DIR__ . "../../views/errors/404.php";
            }
            
        } else {
            header('Location: /dance');
            exit();
        }


    }

    public function tickets()
    {
        $this->displayView($this);
    }

 
    //added by Maria to display dance ticket page for visitor

    public function events()
    {
        require __DIR__ . '/../views/dance/tickets.php';
    }

    //end of added by Maria
}