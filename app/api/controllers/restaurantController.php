<?php

require_once(__DIR__ . '/../../services/yummy/restaurantService.php');
require_once(__DIR__ . '/../../services/imageService.php');
require_once(__DIR__ . '/../../models/yummy/restaurantBase.php');
require_once(__DIR__ . '/apiController.php');


class RestaurantController extends ApiController
{
    private $restaurantService;
    private $imageService;

    function __construct()
    {
        $this->restaurantService = new restaurantService();
        $this->imageService = new ImageService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $queryParams = $_GET;
                if (isset($queryParams['id'])) {
                    $id = $queryParams['id'];
                    $this->handleGetRequest($this->restaurantService, 'getRestaurantDetailedInfoById', $id);
                } else {
                    $this->handleGetAllRequest($this->restaurantService, 'getAllRestaurantsBaseInfo');
                }
                break;
            case 'POST':
                $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
                $restaurantName = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
                $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
                $stars = isset($_POST['stars']) ? htmlspecialchars($_POST['stars']) : '';
                $seats = isset($_POST['seats']) ? htmlspecialchars($_POST['seats']) : '';
                $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
                $fileInfo = isset($_FILES['restaurant-banner']) ? $_FILES['restaurant-banner'] : null;
                $isRecommended = isset($_POST['is_recommended']) ? ($_POST['is_recommended'] === 'true' ? true : false) : false;

                if ($id === 0) {
                    $this->handleAddRestaurant($restaurantName, $location, $description, $seats, $stars, $fileInfo);
                } else {
                    $this->handleUpdateRestaurant($id, $restaurantName, $location, $description, $seats, $stars, $fileInfo, $isRecommended);
                }
                break;
            case 'DELETE':
                $this->handleDeleteRequest($this->restaurantService, 'deleteRestaurant');
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handleAddRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $fileInfo)
    {
        $bannerId = null;
        if ($fileInfo !== null && $fileInfo['error'] === 0) {
            $this->handleBannerUpload($fileInfo, $name);
            $bannerId = $this->imageService->addRestaurantBannerToDatabase($name);
        }
        $this->restaurantService->addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $bannerId);

        echo json_encode(["message" => "Restaurant added successfully"]);
    }

    private function handleUpdateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $fileInfo, $isRecommended)
    {
        $bannerId = null;
        if ($fileInfo !== null && $fileInfo['error'] === UPLOAD_ERR_NO_FILE) {
            // No file was uploaded, keep the current banner
            $bannerId = $this->restaurantService->getBannerById($id);
        } elseif ($fileInfo !== null && $fileInfo['error'] === 0) {
            // A new file was uploaded, handle the banner update
            $this->handleCurrentBannerDeletion($id);
            $this->handleBannerUpload($fileInfo, $name);
            $bannerId = $this->imageService->addRestaurantBannerToDatabase($name);
        }
        $this->restaurantService->updateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $bannerId, $isRecommended);

        echo json_encode(["message" => "Restaurant updated successfully"]);
    }

    private function handleBannerUpload($fileInfo, $restaurantName)
    {
        $result = $this->imageService->uploadRestaurantBannerToDirectory($fileInfo, $restaurantName);
        if (!$result) {
            throw new Exception('Failed to upload banner');
        } 
    }

    private function handleCurrentBannerDeletion($restaurantId)
    {
        //Delete from directory
        $currentBanner = isset($_POST['current-banner']) ? htmlspecialchars($_POST['current-banner']) : '';
        $this->imageService->deleteRestaurantBannerFromDirectory($currentBanner);

        //Delete from database
        $this->imageService->deleteRestaurantBannerFromDatabase($restaurantId);

    }

    public function GetRestaurantIdByName()
    {
        try {

            $res = $this->restaurantService->getRestaurantIdByName($_GET['name']);

            echo json_encode($res);


        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }
}
