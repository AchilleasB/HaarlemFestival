<?php

require_once __DIR__ . '/../../repositories/imageRepository.php';

class ImageService
{
    private $imageRepository;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository();
    }

    public function getImagesByRestaurantId($restaurantId)
    {
        return $this->imageRepository->getImagesByRestaurantId($restaurantId);
    }

    public function addImageToRestaurant($restaurantId, $restaurantName)
    {
        $images = $this->imageRepository->getImagesByRestaurantId($restaurantId);
        $imageName = $this->generateImageName($restaurantName, count($images) + 1);

        return $this->imageRepository->addImageToRestaurant($restaurantId, $imageName);
    }

    public function deleteImageFromRestaurant($restaurantId, $imageName)
    {
        return $this->imageRepository->deleteImageFromRestaurant($restaurantId, $imageName);
    }

    public function deleteImage($id)
    {
        return $this->imageRepository->deleteImage($id);
    }

    private function generateImageName($restaurantName, $imageNumber)
    {
        $imageName = strtolower(str_replace(' ', '-', $restaurantName));

        $imageName .= '-' . $imageNumber . '.png';

        return $imageName;
    }
}