<?php
require __DIR__ . '/../repository.php';
require_once __DIR__ . ' /../../models/yummy/cuisine.php';

class CuisineRepository extends Repository
{
    public function getAllRestaurants()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM restaurants');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addRestaurant($restaurant)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO restaurants (name, location, description, number_of_seats, number_of_stars, banner) VALUES (:name, :location, :description, :number_of_seats, :number_of_stars, :banner)');
            $stmt->execute([
                ':name' => $restaurant->getName(),
                ':location' => $restaurant->getLocation(),
                ':description' => $restaurant->getDescription(),
                ':number_of_seats' => $restaurant->getNumberOfSeats(),
                ':number_of_stars' => $restaurant->getNumberOfStars(),
                ':banner' => $restaurant->getBanner()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateRestaurant($restaurant)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE restaurants SET name = :name, location = :location, description = :description, number_of_seats = :number_of_seats, number_of_stars = :number_of_stars, banner = :banner WHERE id = :id');
            $stmt->execute([
                ':id' => $restaurant->getId(),
                ':name' => $restaurant->getName(),
                ':location' => $restaurant->getLocation(),
                ':description' => $restaurant->getDescription(),
                ':number_of_seats' => $restaurant->getNumberOfSeats(),
                ':number_of_stars' => $restaurant->getNumberOfStars(),
                ':banner' => $restaurant->getBanner()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteRestaurant($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurants WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}