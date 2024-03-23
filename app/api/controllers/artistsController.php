<?php
require __DIR__ . '/../../services/artistService.php';
require_once __DIR__ . '/../../models/artist.php';
require_once __DIR__ . '/../../models/artistInfo.php';

class ArtistsController
{
    private $artistService;
    private $danceService;

    function __construct()
    {
        $this->artistService = new ArtistService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $artists = $this->artistService->getAllArtists();
            header('Content-Type: application/json');
            echo json_encode($artists);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
            $artist_image = isset($_POST['artist_image']) ? htmlspecialchars($_POST['artist_image']) : '';

            if (!empty($_FILES['image']['name'])) {
                $uploadedImage = $_FILES['image'];
                $artist_image = 'artists/' . basename($uploadedImage['name']);
                $destinationFile = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $artist_image;
                move_uploaded_file($uploadedImage['tmp_name'], $destinationFile);
            }

            $artist = new Artist();
            $artist->setId(htmlspecialchars($id));
            $artist->setName(htmlspecialchars($name));
            $artist->setGenre(htmlspecialchars($genre));
            $artist->setArtistImage(htmlspecialchars($artist_image));

            if ($id === 0) {

                if ($this->artistService->addArtist($artist)) {
                    $message = 'Artist ' . $artist->getName() . ' added successfully';
                } else {
                    $message = 'An error occurred while adding' . $artist->getName();
                }
            } else {

                if ($this->artistService->updateArtist($artist)) {
                    $message = 'Artist ' . $artist->getName() . ' updated successfully';
                } else {
                    $message = 'An error occurred while updating artist' . $artist->getName();
                }

            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'artist' => $artist]);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                header('Content-Type: application/json');
                echo json_encode('Invalid JSON');
            }

            if ($this->artistService->deleteArtist($object->id)) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $object->image;
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
                $message = 'Artist ' . $object->name . ' was deleted successfully';
            } else {
                $message = 'An error occurred while deleting artist' . $object->name;
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'artist' => $object->name]);
        }
    }


    public function artistPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);

                $artistsInfo = $this->artistService->getArtistInfo($id);
                
                header('Content-Type: application/json');
                echo json_encode([$artistsInfo]);
            }

        }
    }


    public function artistAppearances()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);

                $appearances = $this->artistService->getArtistDanceAppearances($id);
                
                header('Content-Type: application/json');
                echo json_encode($appearances);
            }

        }
    }
}

