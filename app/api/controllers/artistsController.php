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
            $id = isset ($_POST['id']) ? (int) $_POST['id'] : 0;
            $name = isset ($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $genre = isset ($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
            $artist_image = isset ($_POST['artist_image']) ? htmlspecialchars($_POST['artist_image']) : '';

            if (!empty ($_FILES['image']['name'])) {
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

            if (isset ($_GET['id'])) {
                $id = intval($_GET['id']);

                //TODO add a check if the artistInfp record exists otherwise display message 'artist page unavailable'
                $artistsInfo = $this->artistService->getSingleArtistInfo($id);

                header('Content-Type: application/json');
                echo json_encode([$artistsInfo]);
            } else {
                // Retrieve all artists information
                $artistsInfo = $this->artistService->getAllArtistsInfo();
                header('Content-Type: application/json');
                echo json_encode($artistsInfo);
            }
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $artist_id = isset ($_POST['artist_id']) ? (int) $_POST['artist_id'] : 0;
            $description = isset ($_POST['description']) ? $_POST['description'] : '';
            $page_img = isset ($_POST['page_img']) ? $_POST['page_img'] : '';
            $career_highlight_title = isset ($_POST['career_highlight_title']) ? $_POST['career_highlight_title'] : '';
            $career_highlight_img = isset ($_POST['career_highlight_img']) ? $_POST['career_highlight_img'] : '';
            $career_highlight_text = isset ($_POST['career_highlight_text']) ? $_POST['career_highlight_text'] : '';
            $latest_releases = isset ($_POST['latest_releases']) ? $_POST['latest_releases'] : '';

            if (!empty ($_FILES['page_img']['name'])) {
                $uploadedImage = $_FILES['page_img'];
                $page_img = 'artists/' . basename($uploadedImage['name']);
                $destinationFile = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $page_img;
                move_uploaded_file($uploadedImage['tmp_name'], $destinationFile);
            } else {
                $page_img = isset( $_POST['page_img_path']) ? $_POST['page_img_path'] : '';
            }

            if (!empty ($_FILES['career_highlight_img']['name'])) {
                $uploadedImage = $_FILES['career_highlight_img'];
                $career_highlight_img = 'artists/' . basename($uploadedImage['name']);
                $destinationFile = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $career_highlight_img;
                move_uploaded_file($uploadedImage['tmp_name'], $destinationFile);
            } else {
                $career_highlight_img = isset( $_POST['career_highlight_img_path']) ? $_POST['career_highlight_img_path'] : '';
            }

            $artistInfo = new ArtistInfo();
            $artistInfo->setArtistId($artist_id);
            $artistInfo->setDescription($description);
            $artistInfo->setPageImg($page_img);
            $artistInfo->setCareerHighlightTitle($career_highlight_title);
            $artistInfo->setCareerHighlightImg($career_highlight_img);
            $artistInfo->setCareerHighlightText($career_highlight_text);
            $artistInfo->setLatestReleases($latest_releases);

            if (!$this->artistService->artistPageExists($artist_id)) {

                if ($this->artistService->createArtistPage($artistInfo)) {
                    $message = 'Artist page created successfully';
                } else {
                    $message = 'An error occurred while creating artist page';
                }
            } else {

                if ($this->artistService->updateArtistPageContent($artistInfo)) {
                    $message = 'Artist page content updated successfully';
                } else {
                    $message = 'An error occurred while updating artist page content';
                }

            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'artist' => $artistInfo]);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                header('Content-Type: application/json');
                echo json_encode('Invalid JSON');
            }

            if ($this->artistService->deleteArtistPage($object->artist_id)) {

                $pageImagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $object->page_img;
                if (file_exists($pageImagePath) && is_file($pageImagePath)) {
                    unlink($pageImagePath);
                }

                $careerHighlightImagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $object->career_highlight_img;
                if (file_exists($careerHighlightImagePath) && is_file($careerHighlightImagePath)) {
                    unlink($careerHighlightImagePath);
                }

                $message = 'Artist page was deleted successfully';
            } else {
                $message = 'An error occurred while deleting artist page';
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'artist' => $object->artist_id]);
        }
    }


    public function artistAppearances()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset ($_GET['id'])) {
                $id = intval($_GET['id']);

                $appearances = $this->artistService->getArtistDanceAppearances($id);

                header('Content-Type: application/json');
                echo json_encode($appearances);
            }

        }
    }
}

