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
                    echo json_encode($this->imageService->getImagesByRestaurantId($restaurantId));
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing restaurantId parameter"]);
                }
                break;
            case 'POST':
                break;
            case 'DELETE':
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }
}
