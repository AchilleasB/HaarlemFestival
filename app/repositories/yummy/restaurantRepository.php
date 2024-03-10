<?php
require __DIR__ . '/../repository.php';
require_once __DIR__ . ' /../../models/yummy/restaurant.php';
require_once __DIR__ . ' /../../models/yummy/restaurantRecommended.php';

class RestaurantRepository extends Repository
{
    public function getAllRestaurantsBaseInfo()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                r.id, 
                r.name, 
                r.number_of_stars,
                i.image AS banner,
                GROUP_CONCAT(c.name ORDER BY c.name SEPARATOR ', ') AS cuisines
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id
            INNER JOIN 
                restaurants_cuisines rc ON r.id = rc.restaurant_id
            INNER JOIN 
                cuisines c ON rc.cuisine_id = c.id
            GROUP BY 
                r.id, r.name, r.number_of_stars, i.image");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getAllRestaurantsRecommended()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                r.id, 
                r.name, 
                r.description,
                r.number_of_stars,
                i.image AS banner,
                GROUP_CONCAT(c.name ORDER BY c.name SEPARATOR ', ') AS cuisines
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id
            INNER JOIN 
                restaurants_cuisines rc ON r.id = rc.restaurant_id
            INNER JOIN 
                cuisines c ON rc.cuisine_id = c.id
            WHERE 
                r.is_recommended = 1
            GROUP BY 
                r.id, r.name, r.number_of_stars, i.image");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'RestaurantRecommended');
            $restaurants = $stmt->fetchAll();

            return $restaurants;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getAllRestaurantsDetailed()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT *
            FROM 
                restaurants r
            JOIN 
                restaurants_cuisines rc ON r.id = rc.restaurant_id
            JOIN 
                cuisines c ON rc.cuisine_id = c.id
            WHERE 
                r.is_recommended = 1
            GROUP BY 
                r.id, r.name, r.banner");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'RestaurantRecommended');
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