<?php

require_once(__DIR__ . '/../repository.php');

class RestaurantSessionRepository extends Repository
{
    public function addRestaurantSessionRelation($restaurantId, $sessionId)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO restaurants_sessions (restaurant_id, session_id) VALUES (?, ?)');
            $stmt->execute([$restaurantId, $sessionId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding restaurant-session relation', $e->getCode(), $e);
        }
    }

    public function deleteRestaurantSessionRelation($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurants_sessions WHERE restaurant_id = ?');
            $stmt->execute([$restaurantId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting restaurant-session relation', $e->getCode(), $e);
        }
    }
}
