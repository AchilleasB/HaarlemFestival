<?php

require_once __DIR__ . '/../../repositories/yummy/restaurantRepository.php';
require_once __DIR__ . '/../../repositories/yummy/cuisineRepository.php';

class RestaurantService {
    private $restaurantRepository;
    private $cuisineRepository;

    public function __construct() {
        $this->restaurantRepository = new RestaurantRepository();
        $this->cuisineRepository = new CuisineRepository();
    }
    
    public function getAllRestaurantsBaseInfo() {
        $restaurants = $this->restaurantRepository->getAllRestaurantsBaseInfo();
        foreach ($restaurants as $restaurant) {
            $restaurant->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurant->getId()));
        }

        return $restaurants;
    }
    
    public function getAllRestaurantsRecommended() {
        $restaurants = $this->restaurantRepository->getAllRestaurantsRecommended();
        foreach ($restaurants as $restaurant) {
            $restaurant->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurant->getId()));
        }

        return $restaurants;
    }

    // public function getAllRestaurantsDetailed() {
    //     return $this->restaurantRepository->getAllRestaurantsRecommended();
    // }

    public function getRestaurantDetailedInfoById($id) {
        $restaurantBaseInfo = $this->restaurantRepository->getRestaurantBaseInfoById($id);
        $restaurantBaseInfo->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($id));

        

        return $this->restaurantRepository->getRestaurantDetailedInfoById($id);
    }

    public function addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $banner) {
        $restaurant = new RestaurantBase();
        $restaurant->setName($name);
        $restaurant->setNumberOfStars($numberOfStars);
        $restaurant->setBanner($banner);
        
        return $this->restaurantRepository->addRestaurant($restaurant);
    }

    public function updateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $banner) {
        $restaurant = new RestaurantBase();
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