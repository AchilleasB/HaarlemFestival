<?php

require_once(__DIR__ . '/../repository.php');

class RestaurantCuisineRepository extends Repository
{
    public function addRestaurantCuisineRelation($restaurantId, $cuisineId)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO restaurants_cuisines (restaurant_id, cuisine_id) VALUES (?, ?)');
            $stmt->execute([$restaurantId, $cuisineId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding restaurant-cuisine relation', $e->getCode(), $e);
        }
    }

    public function deleteRestaurantCuisineRelation($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurants_cuisines WHERE restaurant_id = ?');
            $stmt->execute([$restaurantId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting restaurant-cuisine relation', $e->getCode(), $e);
        }
    }
}
