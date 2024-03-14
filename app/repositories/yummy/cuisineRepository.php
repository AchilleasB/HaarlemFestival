<?php

require_once __DIR__ . '/../repository.php';
require_once __DIR__ . '/../../models/yummy/cuisine.php';

class CuisineRepository extends Repository
{
    public function getAllCuisines()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM cuisines');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cuisine');
            $cuisines = $stmt->fetchAll();

            return $cuisines;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCuisineById($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM cuisines WHERE id = ?');
            $stmt->execute([$id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cuisine');
            $cuisine = $stmt->fetch();

            return $cuisine;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCuisinesByRestaurantId($restaurantId): array {
        try {
            $stmt = $this->connection->prepare("
                SELECT c.id, c.name
                FROM cuisines c
                JOIN restaurants_cuisines rc ON c.id = rc.cuisine_id
                WHERE rc.restaurant_id = ?
            ");
            $stmt->execute([$restaurantId]);
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cuisine');
            $cuisines = $stmt->fetchAll();	

            return $cuisines;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addCuisine($cuisine)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO cuisines (name) VALUES (?)');
            $stmt->execute([$cuisine->getName()]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateCuisine($cuisine)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE cuisines SET name = ? WHERE id = ?');
            $stmt->execute([$cuisine->getName(), $cuisine->getId()]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteCuisine($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM cuisines WHERE id = ?');
            $stmt->execute([$id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>