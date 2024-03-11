<?php

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/yummy/restaurantService.php';

class YummyController extends Controller
{
    private $restaurantService;

    public function __construct()
    {
        $this->restaurantService = new RestaurantService();
    }

    public function index()
    {
        $restaurants = $this->restaurantService->getAllRestaurantsBaseInfo();
        $restaurantsRecommended = $this->restaurantService->getAllRestaurantsRecommended();

        $data = [
            'restaurants' => $restaurants, 
            'restaurantsRecommended' => $restaurantsRecommended
        ];


        $this->displayView($this, $data);
    }

    public function restaurant() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $restaurant = $this->restaurantService->getRestaurantDetailedInfoById($id);
            $this->displayRestaurant($restaurant);
        } else {
            // TODO: handle error
        }
    } 
    
    private function displayRestaurant($restaurant) {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        require __DIR__ . "/../views/$directory/$view.php";
    }
}