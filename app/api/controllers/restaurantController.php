<?php

require_once(__DIR__ . '/../../services/yummy/restaurantService.php');
require_once(__DIR__ . '/../../models/yummy/restaurantBase.php');
require_once(__DIR__ . '/apiController.php');


class RestaurantController extends ApiController
{
    private $restaurantService;

    function __construct()
    {
        $this->restaurantService = new restaurantService();
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
                // $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
                // $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
                // $banner = isset($_POST['restaurant_image']) ? htmlspecialchars($_POST['restaurant_image']) : '';
                // $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';

                

                // if (!empty($_FILES['image']['name'])) {
                //     $uploadedImage = $_FILES['image'];
                //     $banner = 'yummy/' . basename($uploadedImage['name']);
                //     $destinationFile = $_SERVER['DOCUMENT_ROOT'] . '/images/yummy' . $banner;
                //     move_uploaded_file($uploadedImage['tmp_name'], $destinationFile);
                // }

                // $restaurant = new RestaurantDetailed();
                // $restaurant->setId($id);
                // $restaurant->setName($name);
                // $restaurant->setLocation($address);
                // $restaurant->setBanner($banner);
                break;
            case 'PUT':
                //$this->handlePutRequest($this->restaurantService, 'updateRestaurant', 'getRestaurantDetailedInfoById', ['start_date', 'end_date']);
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
}
