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

    // public function restaurant() {
    //     $restaurants = $this->restaurantService->getAllRestaurantsBaseInfo();
    //     $restaurantsRecommended = $this->restaurantService->getAllRestaurantsRecommended();
    //     $this->displayView($this, ['restaurants' => $restaurants], ['restaurantsRecommended' => $restaurantsRecommended]);
    // }
}