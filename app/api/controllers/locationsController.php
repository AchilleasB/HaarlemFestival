<?php
require __DIR__ . '/../../services/locationService.php';
require_once __DIR__ . '/../../models/locations.php';

class LocationController
{
    private $locationService;

    function __construct()
    {
        $this->locationService = new LocationService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $locations = $this->locationService->getAllLocations();
            header('Content-Type: application/json');
            echo json_encode($locations);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $location_name = isset($_POST['location_name']) ? htmlspecialchars($_POST['location_name']) : '';
            $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
            $links = isset($_POST['links']) ? htmlspecialchars($_POST['links']) : '';
            $image = isset($_POST['images']) ? htmlspecialchars($_POST['images']) : '';

            if (!empty($_FILES['images']['location_name'])) {
                $uploadedImage = $_FILES['images'];
                $location_name = 'locations/' . basename($uploadedImage['location_name']);
                $image = isset($_POST['images']) ? htmlspecialchars($_POST['images']) : '';
                $destinationFile = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $image;
                move_uploaded_file($uploadedImage['tmp_name'], $destinationFile);
            }

            $location = new Location();
            $location->setId(htmlspecialchars($id));
            $location->setLocationName(htmlspecialchars($location_name));
            $location->setAddress(htmlspecialchars($address));
            $location->setDescription(htmlspecialchars($description));
            $location->setLinks(htmlspecialchars($links));
            $location->setImage(htmlspecialchars($image));
           

            if ($id === 0) {

                if ($this->locationService->addLocation($location)) {
                    $message = 'Location ' . $location->getLocationName() . ' added successfully';
                } else {
                    $message = 'An error occurred while adding' . $location->getLocationName();
                }
            } else {

                if ($this->locationService->updateLocation($location)) {
                    $message = 'Location ' . $location->getLocationName() . ' updated successfully';
                } else {
                    $message = 'An error occurred while updating locations' . $location->getLocationName();
                }

            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'location' => $location]);
        }


        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                header('Content-Type: application/json');
                echo json_encode('Invalid JSON');
            }

            if ($this->locationService->deleteLocation($object->id)) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $object->image;
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
                $message = 'Location ' . $object->name . ' was deleted successfully';
            } else {
                $message = 'An error occurred while deleting location' . $object->name;
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'Location' => $object->name]);
        }
    }

}