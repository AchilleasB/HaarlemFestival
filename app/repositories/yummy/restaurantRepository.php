<?php

require_once(__DIR__ . '/sessionRepository.php');
require_once(__DIR__ . ' /../../models/yummy/restaurantBase.php');
require_once(__DIR__ . ' /../../models/yummy/restaurantRecommended.php');
require_once(__DIR__ . ' /../../models/yummy/restaurantDetailed.php');
require_once(__DIR__ . '/../../exceptions/baseException.php');
require_once(__DIR__ . '/../../exceptions/repositoryException.php');


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

            $restaurantsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $restaurants = [];
            foreach ($restaurantsData as $data) {
                $restaurant = new RestaurantBase($data['name'], $data['number_of_stars'], $data['banner'], []);
                $restaurant->setId($data['id']);
                $restaurants[] = $restaurant;
            }

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

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Instantiate RestaurantDetailed object
            $restaurant = new RestaurantBase($data['name'], $data['number_of_stars'], $data['banner'], []);
            $restaurant->setId($data['id']);

            return $restaurant;
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

            $restaurantsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $restaurants = [];
            foreach ($restaurantsData as $data) {
                $restaurant = new RestaurantRecommended($data['name'], $data['number_of_stars'], $data['banner'], [], $data['description']);
                $restaurant->setId($data['id']);
                $restaurants[] = $restaurant;
            }

            return $restaurants;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurants', $e->getCode(), $e);
        }
    }

    //Not used yet
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

            $restaurantsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $restaurants = [];
            foreach ($restaurantsData as $data) {
                $restaurant = new RestaurantDetailed($data['name'], $data['number_of_stars'], $data['banner'], [], $data['description'], $data['location'], $data['number_of_seats'], [], [], [], $data['is_recommended']);
                $restaurant->setId($data['id']);
                $restaurants[] = $restaurant;
            }

            return $restaurants;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurants', $e->getCode(), $e);
        }
    }

    public function getSeatsById($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                number_of_seats
            FROM 
                restaurants
            WHERE 
                id = ?
            LIMIT 1");
            $stmt->execute([$restaurantId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data['number_of_seats'];
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant', $e->getCode(), $e);
        }
    }

    public function getBannerById($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                banner
            FROM 
                restaurants
            WHERE 
                id = ?
            LIMIT 1");
            $stmt->execute([$restaurantId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data['banner'];
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant', $e->getCode(), $e);
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
                    r.is_recommended, 
                    i.image AS banner
                FROM 
                    restaurants r
                INNER JOIN 
                    images i ON r.banner = i.id
                WHERE 
                    r.id = ?
                LIMIT 1");
            $stmt->execute([$restaurantId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Instantiate RestaurantDetailed object
            $restaurant = new RestaurantDetailed(
                $data['name'],
                $data['number_of_stars'],
                $data['banner'],
                [], // Assuming you populate these fields later
                $data['description'],
                $data['location'],
                $data['number_of_seats'],
                [],
                [],
                [],
                $data['is_recommended']
            );
            $restaurant->setId($data['id']);

            return $restaurant;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant', $e->getCode(), $e);
        }
    }


    public function addRestaurant($name, $location, $description, $numberOfSeats, $numberOfStars, $banner, $isRecommended)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO restaurants (name, location, description, number_of_seats, number_of_stars, banner, is_recommended) VALUES (:name, :location, :description, :number_of_seats, :number_of_stars, :banner, :is_recommended)');
            $stmt->execute([
                ':name' => $name,
                ':location' => $location,
                ':description' => $description,
                ':number_of_seats' => $numberOfSeats,
                ':number_of_stars' => $numberOfStars,
                ':banner' => $banner,
                ':is_recommended' => $isRecommended ? 1 : 0
            ]);
            $lastInsertedId = $this->connection->lastInsertId();

            return $lastInsertedId;
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding restaurant', $e->getCode(), $e);
        }
    }

    public function updateRestaurant($id, $name, $location, $description, $number_of_seats, $number_of_stars, $banner, $isRecommended)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE restaurants SET name = :name, location = :location, description = :description, number_of_seats = :number_of_seats, number_of_stars = :number_of_stars, banner = :banner, is_recommended = :is_recommended WHERE id = :id');
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':location' => $location,
                ':description' => $description,
                ':number_of_seats' => $number_of_seats,
                ':number_of_stars' => $number_of_stars,
                ':banner' => $banner,
                ':is_recommended' => $isRecommended ? 1 : 0
            ]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException('Error updating restaurant', $e->getCode(), $e);
        }
    }

    public function deleteRestaurant($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurants WHERE id = :id');
            $stmt->execute([':id' => $restaurantId]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting restaurant', $e->getCode(), $e);
        }
    }

    public function updateSeats($id, $newSeatsAvailable)
    {
        try {

            $query = $this->connection->prepare("UPDATE restaurants SET number_of_seats=:number_of_seats WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->bindParam(":number_of_seats", $newSeatsAvailable);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }


    }


    public function getRestaurantIdByName($name)
    {
        try {

            $query = $this->connection->prepare("SELECT id FROM restaurants WHERE name=:name ");
            $query->bindParam(":name", $name);
            $query->execute();

            $query->setFetchMode(PDO::FETCH_ASSOC);
            $row = $query->fetch();
            return $row['id'];
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }
    }

    public function getRestaurantNameById($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT name FROM restaurants WHERE id = :id');
            $stmt->execute([':id' => $restaurantId]);

            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching restaurant name', $e->getCode(), $e);
        }
    }
}
