<?php
require __DIR__ . '/../../services/artistService.php';
require_once __DIR__ . '/../../models/artist.php';

class ArtistsController
{
    private $artistService;

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
            $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';

            if (!empty($_FILES['image']['name'])) {
                $uploadedImage = $_FILES['image'];
                $artist_image = '/../images/' . basename($uploadedImage['name']);
                move_uploaded_file($uploadedImage['tmp_name'], 'images/' . $uploadedImage['name']);
            }

            $artist = new Artist();
            $artist->setId($id);
            $artist->setName($name);
            $artist->setGenre($genre);
            $artist->setDescription($description);
            $artist->setArtistImage($artist_image);

            if ($id === 0) {
                if ($this->artistService->addArtist($artist)) {
                    $message = 'A new artist added successfully';
                } else {
                    $message = 'An error occurred while adding a new artist';
                }
            } else {
                if ($this->artistService->updateArtist($artist)) {
                    $message = 'Artist '.$artist->getName().' updated successfully';
                } else {
                    $message = 'An error occurred while updating artist' .$artist->getName();
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'artist' => $artist]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($this->artistService->deleteArtist($object->id)) {
                $message = 'Artist ' . $object->name . ' was deleted successfully';
            } else {
                $message = 'An error occurred while deleting artist' . $object->name;
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'recipe' => $object]);
        }
    }
}

