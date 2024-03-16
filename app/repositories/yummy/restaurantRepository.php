<?php

require_once __DIR__ . '/sessionRepository.php';
require_once __DIR__ . ' /../../models/yummy/restaurantBase.php';
require_once __DIR__ . ' /../../models/yummy/restaurantRecommended.php';
require_once __DIR__ . ' /../../models/yummy/restaurantDetailed.php';
require_once __DIR__ . '/../../exceptions/baseException.php';
require_once __DIR__ . '/../../exceptions/repositoryException.php';


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
                i.image AS banner
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'RestaurantBase');
            $restaurants = $stmt->fetchAll();

            return $restaurants;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurants', $e->getCode(), $e);
        }
    }

    public function getRestaurantBaseInfoById($restaurantId) 
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                r.id, 
                r.name, 
                r.number_of_stars, 
                i.image AS banner
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id
            WHERE 
                r.id = ?
            LIMIT 1");
            $stmt->execute([$restaurantId]);

            return $stmt->fetchObject('RestaurantBase');

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant', $e->getCode(), $e);
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
                i.image AS banner
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id
            WHERE 
                r.is_recommended = 1");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'RestaurantRecommended');
            $restaurants = $stmt->fetchAll();

            return $restaurants;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurants', $e->getCode(), $e);
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
            throw new RepositoryException('Error fetching restaurants', $e->getCode(), $e);
        }
    }

    public function getRestaurantDetailedInfoById($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                r.id, 
                r.name, 
                r.number_of_stars,
                r.number_of_seats,
                r.description,
                r.location, 
                i.image AS banner
            FROM 
                restaurants r
            INNER JOIN 
                images i ON r.banner = i.id
            WHERE 
                r.id = ?
            LIMIT 1");
            $stmt->execute([$restaurantId]);

            return $stmt->fetchObject('RestaurantDetailed');

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant', $e->getCode(), $e);
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
            throw new RepositoryException('Error adding restaurant', $e->getCode(), $e);
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
            throw new RepositoryException('Error updating restaurant', $e->getCode(), $e);
        }
    }

    public function deleteRestaurant($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurants WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting restaurant', $e->getCode(), $e);
        }
    }
}