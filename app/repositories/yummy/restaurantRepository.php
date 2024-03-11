<?php

require_once __DIR__ . '/restaurantImageRepository.php';
require_once __DIR__ . '/sessionRepository.php';
require_once __DIR__ . ' /../../models/yummy/restaurant.php';
require_once __DIR__ . ' /../../models/yummy/restaurantRecommended.php';
require_once __DIR__ . ' /../../models/yummy/restaurantDetailed.php';
require_once __DIR__ . ' /../../models/yummy/menuItem.php';
require_once __DIR__ . ' /../../models/yummy/drinkItem.php';

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

    private function getRestaurantBaseInfoById($restaurantId) {
        $stmt = $this->connection->prepare("
        SELECT 
            r.id, r.name, r.number_of_stars, i.image AS banner, 
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
            r.id = ?
        GROUP BY 
            r.id, r.name, r.number_of_stars, i.image
        LIMIT 1");
        $stmt->execute([$restaurantId]);

        return $stmt->fetchObject('Restaurant');
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

    public function getRestaurantDetailedInfoById($restaurantId)
    {
        $restaurantBaseInfo = $this->getRestaurantBaseInfoById($restaurantId);
        $imageRepository = new RestaurantImageRepository();
        $sessionRepository = new SessionRepository();

        if (!$restaurantBaseInfo) {
            // TODO: Throw an exception
            return null;
        }

        $restaurantDetailed = new RestaurantDetailed();
        $restaurantDetailed->setId($restaurantBaseInfo->getId());
        $restaurantDetailed->setName($restaurantBaseInfo->getName());
        $restaurantDetailed->setNumberOfStars($restaurantBaseInfo->getNumberOfStars());
        $restaurantDetailed->setBanner($restaurantBaseInfo->getBanner());
        $restaurantDetailed->setCuisines($restaurantBaseInfo->getCuisines());

        $location = $this->fetchLocationForRestaurant($restaurantId);
        $number_of_seats = $this->fetchNumberOfSeatsForRestaurant($restaurantId);
        $menu = $this->fetchMenuForRestaurant($restaurantId);
        $images = $imageRepository->getImagesByRestaurantId($restaurantId);
        $sessions = $sessionRepository->fetchSessionsForRestaurant($restaurantId);
        $restaurantDetailed->setSessions($sessions);

        $restaurantDetailed->setLocation($location);
        $restaurantDetailed->setNumberOfSeats($number_of_seats);
        $restaurantDetailed->setDescription($this->fetchDesriptionForRestaurant($restaurantId));
        $restaurantDetailed->setImages($images);
        foreach ($menu as $category => $items) {
            $restaurantDetailed->setMenu($category, $items);
        }        

        return $restaurantDetailed;
    }

    private function fetchLocationForRestaurant($restaurantId) {
        $stmt = $this->connection->prepare("SELECT location FROM restaurants WHERE id = ?");
        $stmt->execute([$restaurantId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['location'];
        }

        //TODO: Throw an exception
        return null;
    }

    private function fetchNumberOfSeatsForRestaurant($restaurantId) {
        $stmt = $this->connection->prepare("SELECT number_of_seats FROM restaurants WHERE id = ?");
        $stmt->execute([$restaurantId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['number_of_seats'];
        }

        //TODO: Throw an exception
        return null;
    }

    private function fetchDesriptionForRestaurant($restaurantId) {
        $stmt = $this->connection->prepare("SELECT description FROM restaurants WHERE id = ?");
        $stmt->execute([$restaurantId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['description'];
        }

        //TODO: Throw an exception
        return null;
    }

    private function fetchMenuForRestaurant($restaurantId) {
        $menuItems = [];
        $stmt = $this->connection->prepare("
            SELECT mi.*, d.price_bottle 
            FROM menu_items mi
            LEFT JOIN drinks d ON mi.id = d.id
            WHERE mi.restaurant_id = ?");
        $stmt->execute([$restaurantId]);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (is_null($row['price_bottle'])) {
                // It's a regular menu item (food), not a drink
                $menuItem = new MenuItem();
                $menuItem->setId($row['id']);
                $menuItem->setName($row['name']);
                $menuItem->setDescription($row['description']);
                $menuItem->setPricePerPortion($row['price_per_portion']);
                $menuItems['food'][] = $menuItem;
            } else {
                // It's a drink
                $drinkItem = new DrinkItem();
                $drinkItem->setId($row['id']);
                $drinkItem->setName($row['name']);
                $drinkItem->setDescription($row['description']);
                $drinkItem->setPricePerPortion($row['price_per_portion']);
                $drinkItem->setPriceBottle($row['price_bottle']);
                $menuItems['drinks'][] = $drinkItem;
            }
        }

        return $menuItems;
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