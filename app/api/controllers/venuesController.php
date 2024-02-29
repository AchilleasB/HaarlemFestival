<?php
require __DIR__ . '/../../services/venueService.php';
require_once __DIR__ . '/../../models/venue.php';

class VenuesController {
    private $venueService;

    function __construct()
    {
        $this->venueService = new VenueService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $venues = $this->venueService->getAllVenues();
            header('Content-Type: application/json');
            echo json_encode($venues);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
            $venue_image = isset($_POST['venue_image']) ? htmlspecialchars($_POST['venue_image']) : '';

            if (!empty($_FILES['image']['name'])) {
                $uploadedImage = $_FILES['image'];
                $venue_image = '/../images/' . basename($uploadedImage['name']);
                move_uploaded_file($uploadedImage['tmp_name'], 'images/' . $uploadedImage['name']);
            }

            $venue = new Venue();
            $venue->setId($id);
            $venue->setName($name);
            $venue->setAddress($address);
            $venue->setVenueImage($venue_image);

            if ($id === 0) {
                if ($this->venueService->addVenue($venue)) {
                    $message = $venue.' venue added successfully';
                } else {
                    $message = 'An error occurred while adding a new venue';
                }
            } else {
                if ($this->venueService->updateVenue($venue)) {
                    $message = $venue->getName() . ' venue updated successfully';
                } else {
                    $message = 'An error occurred while updating the ' .$venue->getName().' venue';
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'venue' => $venue]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($this->venueService->deleteVenue($object->id)) {
                $message = 'Venue ' . $object->name . ' was deleted successfully';
            } else {
                $message = 'An error occurred while deleting venue' . $object->name;
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'recipe' => $object]);
        }
    }
}