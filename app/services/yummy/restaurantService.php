<?php

require_once __DIR__ . '/../../repositories/yummy/restaurantRepository.php';

class RestaurantService {
    private $restaurantRepository;

    public function __construct() {
        $this->restaurantRepository = new RestaurantRepository();
    }

    public function getAllRestaurants() {
        return $this->restaurantRepository->getAllRestaurants();
    }
    
    public function getAllRestaurantsBaseInfo() {
        return $this->restaurantRepository->getAllRestaurantsBaseInfo();
    }
    
    public function getAllRestaurantsRecommended() {
        return $this->restaurantRepository->getAllRestaurantsRecommended();
    }

    public function getAllRestaurantsDetailed() {
        return $this->restaurantRepository->getAllRestaurantsRecommended();
    }

    public function getRestaurantDetailedInfoById($id) {
        return $this->restaurantRepository->getRestaurantDetailedInfoById($id);
    }

    public function addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $banner) {
        $restaurant = new Restaurant();
        $restaurant->setName($name);
        $restaurant->setNumberOfStars($numberOfStars);
        $restaurant->setBanner($banner);
        
        return $this->restaurantRepository->addRestaurant($restaurant);
    }

    public function updateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $banner) {
        $restaurant = new Restaurant();
        $restaurant->setId($id);
        $restaurant->setName($name);
        $restaurant->setNumberOfStars($numberOfStars);
        $restaurant->setBanner($banner);
        
        return $this->restaurantRepository->updateRestaurant($restaurant);
    }

    public function deleteRestaurant($id) {
        return $this->restaurantRepository->deleteRestaurant($id);
    }

    private function convertImageToBase64($imageData) {
        return base64_encode($imageData);
    }

    private function processRestaurantImages(array $restaurants): array {
        foreach ($restaurants as $restaurant) {
            $imageData = $this->convertImageToBase64($restaurant->getBanner());
            $imageSrc = 'data:image/png;base64,' . $imageData;
            $restaurant->setBanner($imageSrc);
        }
    
        return $restaurants;
    }
}