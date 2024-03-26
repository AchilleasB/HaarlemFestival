<?php

require_once(__DIR__ . '/../../repositories/yummy/cuisineRepository.php');
require_once(__DIR__ . '/../../models/yummy/cuisine.php');

class CuisineService
{
    private $cuisineRepository;

    public function __construct()
    {
        $this->cuisineRepository = new CuisineRepository();
    }

    public function getAllCuisines()
    {
        return $this->cuisineRepository->getAllCuisines();
    }

    public function getCuisineById($cuisineId)
    {
        return $this->cuisineRepository->getCuisineById($cuisineId);
    }

    public function getCuisinesByRestaurantId($restaurantId)
    {
        return $this->cuisineRepository->getCuisinesByRestaurantId($restaurantId);
    }
    
    public function addCuisine($cuisine)
    {
        return $this->cuisineRepository->addCuisine($cuisine);
    }

    public function updateCuisine($cuisine)
    {
        return $this->cuisineRepository->updateCuisine($cuisine);
    }

    public function deleteCuisine($cuisineId)
    {
        return $this->cuisineRepository->deleteCuisine($cuisineId);
    }
}

?>