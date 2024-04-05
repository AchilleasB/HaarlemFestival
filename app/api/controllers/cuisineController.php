<?php

require_once(__DIR__ . '/../../services/yummy/cuisineService.php');
require_once(__DIR__ . '/../../models/yummy/cuisine.php');
require_once(__DIR__ . '/apiController.php');


class CuisineController extends ApiController
{
    private $cuisineService;

    function __construct()
    {
        $this->cuisineService = new CuisineService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->handleGetAllRequest($this->cuisineService, 'getAllCuisines');
                break;
            case 'POST':
                $this->handlePostCuisineRequest();
                break;
            case 'PUT':
                $this->handlePutRequest($this->cuisineService, 'updateCuisine', 'getCuisineById', ['name']);
                break;
            case 'DELETE':
                $this->handleDeleteRequest($this->cuisineService, 'deleteCuisine');
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handlePostCuisineRequest()
    {
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode('Invalid JSON');
        }

        $cuisine = new Cuisine($object->name);
        $this->cuisineService->addCuisine($cuisine);
        echo json_encode(["message" => "Cuisine added successfully"]);
    }
}
