<?php

require_once __DIR__ . '/../repositories/yummy/cuisineRepository.php';
require_once __DIR__ . '/../../models/cuisine.php';

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

    public function getCuisineById($id)
    {
        return $this->cuisineRepository->getCuisineById($id);
    }

    public function getCuisinesByRestaurantId($restaurantId)
    {
        return $this->cuisineRepository->getCuisinesByRestaurantId($restaurantId);
    }
    
    public function addCuisine($name)
    {
        $cuisine = new Cuisine();
        $cuisine->setName($name);

        return $this->cuisineRepository->addCuisine($cuisine);
    }

    public function updateCuisine($id, $name)
    {
        $cuisine = $this->cuisineRepository->getCuisineById($id);

        if ($cuisine) {
            $cuisine->setName($name);
            return $this->cuisineRepository->updateCuisine($cuisine);
        }

        return false;
    }

    public function deleteCuisine($id)
    {
        $cuisine = $this->cuisineRepository->getCuisineById($id);

        if ($cuisine) {
            return $this->cuisineRepository->deleteCuisine($id);
        }

        return false;
    }
}

?>
