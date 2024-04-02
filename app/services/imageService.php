<?php

require_once(__DIR__ . '/../repositories/imageRepository.php');
require_once(__DIR__ . '/../repositories/yummy/restaurantRepository.php');

class ImageService
{
    private $imageRepository;
    private $restaurantRepository;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository();
        $this->restaurantRepository = new RestaurantRepository();
    }

    public function getImagesByRestaurantId($restaurantId)
    {
        return $this->imageRepository->getImagesByRestaurantId($restaurantId);
    }

    public function addImageToRestaurant($restaurantId, $restaurantName)
    {
        $images = $this->imageRepository->getImagesByRestaurantId($restaurantId);
        $imageName = $this->generateRestaurantImageName($restaurantName, count($images) + 1);

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

    public function addImage($imagePath)
    {
        return $this->imageRepository->addImage($imagePath);
    }

    private function generareRestaurantBannerName($restaurantName)
    {
        return strtolower(str_replace(' ', '-', $restaurantName)) . '-banner.png';
    }

    public function deleteRestaurantBannerFromDirectory($restaurantBanner)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/images/yummy/banners/' . $restaurantBanner;

        // Check if file exists before attempting to delete
        if (file_exists($file)) {
            return unlink($file);
        } else {
           throw new Exception('File does not exist');
        }
    }

    public function deleteRestaurantBannerFromDatabase($restaurantId)
    {
        $bannerId = $this->restaurantRepository->getBannerById($restaurantId);
        return $this->imageRepository->deleteImage($bannerId);
    }

    public function uploadRestaurantBannerToDirectory($fileInfo, $restaurantName)
    {
        $bannerName = $this->generareRestaurantBannerName($restaurantName);
        $destinationDir = $_SERVER['DOCUMENT_ROOT'] . '/images/yummy/banners/';
        $destinationFile = $destinationDir . $bannerName;

        // Attempt to move the uploaded file to the designated directory with the new name
        return move_uploaded_file($fileInfo['tmp_name'], $destinationFile);
    }

    public function addRestaurantBannerToDatabase($restaurantName)
    {
        $bannerName = $this->generareRestaurantBannerName($restaurantName);
        return $this->imageRepository->addImage($bannerName);
    }

    private function generateRestaurantImageName($restaurantName, $imageNumber)
    {
        $imageName = strtolower(str_replace(' ', '-', $restaurantName));

        $imageName .= '-' . $imageNumber . '.png';

        return $imageName;
    }
}
