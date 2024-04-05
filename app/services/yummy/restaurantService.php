<?php

require_once(__DIR__ . '/../../repositories/yummy/restaurantRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/cuisineRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/menuRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/sessionRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/restaurantCuisineRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/restaurantSessionRepository.php');
require_once(__DIR__ . '/../../repositories/imageRepository.php');

class RestaurantService {
    private $restaurantRepository;
    private $cuisineRepository;
    private $menuRepository;
    private $imageRepository;
    private $sessionRepository;
    private $restaurantCuisineRepository;
    private $restaurantSessionRepository;

    public function __construct() {
        $this->restaurantRepository = new RestaurantRepository();
        $this->cuisineRepository = new CuisineRepository();
        $this->menuRepository = new MenuRepository();
        $this->imageRepository = new ImageRepository();
        $this->sessionRepository = new SessionRepository();
        $this->restaurantCuisineRepository = new RestaurantCuisineRepository();
        $this->restaurantSessionRepository = new RestaurantSessionRepository();
    }
    
    public function getAllRestaurantsBaseInfo() {
        $restaurants = $this->restaurantRepository->getAllRestaurantsBaseInfo();
        foreach ($restaurants as $restaurant) {
            $restaurant->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurant->getId()));
        }

        return $restaurants;
    }

    // Not used yet
    public function getRestaurantBaseInfoById($restaurantId){
        $restaurant = $this->restaurantRepository->getRestaurantBaseInfoById($restaurantId);
        $restaurant->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurant->getId()));

        return $restaurant;
    }
    
    public function getAllRestaurantsRecommended() {
        $restaurants = $this->restaurantRepository->getAllRestaurantsRecommended();
        foreach ($restaurants as $restaurant) {
            $restaurant->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurant->getId()));
        }

        return $restaurants;
    }

    public function getRestaurantDetailedInfoById($restaurantId) {
        $menu = $this->menuRepository->getMenuForRestaurant($restaurantId);
        $images = $this->imageRepository->getImagesByRestaurantId($restaurantId);
        $sessions = $this->sessionRepository->getSessionsByRestaurantId($restaurantId);

        $restaurantDetailedInfo = $this->restaurantRepository->getRestaurantDetailedInfoById($restaurantId);
        $restaurantDetailedInfo->setCuisines($this->cuisineRepository->getCuisinesByRestaurantId($restaurantId));
        $restaurantDetailedInfo->setImages($images);
        $restaurantDetailedInfo->setSessions($sessions);
        foreach ($menu as $category => $items) {
            $restaurantDetailedInfo->setMenu($category, $items);
        }

        return $restaurantDetailedInfo;
    }

    public function addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $banner, $isRecommended, $cuisines, $sessions) {
        $restaurantId = $this->restaurantRepository->addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $banner, $isRecommended);
        foreach ($cuisines as $cuisine) {
           $this->restaurantCuisineRepository->addRestaurantCuisineRelation($restaurantId, $cuisine);
        }
        foreach ($sessions as $session) {
            $this->restaurantSessionRepository->addRestaurantSessionRelation($restaurantId, $session);
        }
    }

    public function updateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $banner, $isRecommended, $cuisines, $sessions) {
        $this->restaurantCuisineRepository->deleteRestaurantCuisineRelation($id);
        $this->restaurantSessionRepository->deleteRestaurantSessionRelation($id);
        foreach ($cuisines as $cuisine) {
            $this->restaurantCuisineRepository->addRestaurantCuisineRelation($id, $cuisine);
         }
         foreach ($sessions as $session) {
             $this->restaurantSessionRepository->addRestaurantSessionRelation($id, $session);
         }
        return $this->restaurantRepository->updateRestaurant($id, $name, $location, $description, $numberOfSeats, $numberOfStars, $banner, $isRecommended);
    }

    public function deleteRestaurant($restaurantId) {
        return $this->restaurantRepository->deleteRestaurant($restaurantId);
    }

    public function getBannerById($restaurantId) {
        return $this->restaurantRepository->getBannerById($restaurantId);
    }

    public function updateSeats($id, $newSeatsAvailable){
        return $this->restaurantRepository->updateSeats($id, $newSeatsAvailable);
    }

    public function getRestaurantIdByName($name){

        return $this->restaurantRepository->getRestaurantIdByName($name);

    }
}