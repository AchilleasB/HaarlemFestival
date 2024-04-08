<?php

require_once(__DIR__ . '/../../services/imageService.php');
require_once(__DIR__ . '/apiController.php');


class GalleryController extends ApiController
{
    private $imageService;

    function __construct()
    {
        $this->imageService = new ImageService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($_GET['restaurantId'])) {
                    $restaurantId = $_GET['restaurantId'];
                    echo json_encode($this->imageService->getImagesAndIdsByRestaurantId($restaurantId));
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing restaurantId parameter"]);
                }
                break;
            case 'POST':
                $restaurantId = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
                $fileInfo = isset($_FILES['restaurant-image']) ? $_FILES['restaurant-image'] : null;

                if ($restaurantId !== 0) {
                    $this->handleAddImage($restaurantId, $fileInfo);
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing restaurantId parameter"]);
                }
                break;
            case 'DELETE':
                $this->handleDeleteRequest($this->imageService, 'deleteImage');
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handleAddImage($restaurantId, $fileInfo)
    {
        if ($fileInfo !== null && $fileInfo['error'] === 0) {
            $this->imageService->addImageToRestaurant($restaurantId, $fileInfo);
            echo json_encode(["message" => "Image added successfully"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Missing image file"]);
        }
    }
}
