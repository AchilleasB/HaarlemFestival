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
                $body = file_get_contents('php://input');
                $object = json_decode($body);

                if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                    header('Content-Type: application/json');
                    echo json_encode('Invalid JSON');
                }

                $this->restaurantService->addRestaurant($object);
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