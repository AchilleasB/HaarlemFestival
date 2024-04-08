<?php

require_once(__DIR__ . '/../../services/yummy/menuService.php');
require_once(__DIR__ . '/apiController.php');


class MenuController extends ApiController
{
    private $menuService;

    function __construct()
    {
        $this->menuService = new MenuService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($_GET['restaurantId'])) {
                    $restaurantId = $_GET['restaurantId'];
                    echo json_encode($this->menuService->getMenuForRestaurant($restaurantId));
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing restaurantId parameter"]);
                }
                break;
            case 'POST':
                $restaurantId = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
                $itemType = isset($_POST['item-type']) ? htmlspecialchars($_POST['item-type']) : '';
                $itemName = isset($_POST['item-name']) ? htmlspecialchars($_POST['item-name']) : '';
                $itemDescription = isset($_POST['item-description']) ? htmlspecialchars($_POST['item-description']) : '';
                $itemPricePerPortion = isset($_POST['price-per-portion']) ? htmlspecialchars($_POST['price-per-portion']) : null;
                $itemPricePerBottle = isset($_POST['price-per-bottle']) ? htmlspecialchars($_POST['price-per-bottle']) : 0;
                $this->handleAddMenuItem($restaurantId, $itemType, $itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle);
                break;
            case 'PUT':
                $this->handlePutMenuItemRequest();
                break;
            case 'DELETE':
                $this->handleDeleteRequest($this->menuService, 'deleteMenuItem');
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handleAddMenuItem($restaurantId, $itemType, $itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle)
    {
        $itemPricePerPortion = $itemPricePerPortion == 0 ? null : $itemPricePerPortion;
        try {
            $this->menuService->addMenuItemToRestaurant($restaurantId, $itemType, $itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle);
            echo json_encode(["message" => "Item added successfully"]);
        } catch (Exception $e) {
            http_response_code(403);
            echo json_encode(["error" => "Failed to add item to restaurant"]);
        }
    }

    private function handlePutMenuItemRequest()
    {
        $this->sendHeaders();
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        try {
            $this->menuService->updateMenuItem($object->id, $object->name, $object->description, $object->pricePerPortion, $object->priceBottle, $object->itemType);
            echo json_encode(["message" => "Menu item updated successfully"]);
        } catch (Exception $e) {
            http_response_code(403);
            echo json_encode(["error" => "Failed to update menu item"]);
        }
    }
}
