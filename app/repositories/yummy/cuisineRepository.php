<?php

require_once(__DIR__ . '/../repository.php');
require_once(__DIR__ . '/../../models/yummy/cuisine.php');

class CuisineRepository extends Repository
{
    public function getAllCuisines()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM cuisines');
            $stmt->execute();

            $cuisinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cuisines = [];
            foreach ($cuisinesData as $data) {
                $cuisine = new Cuisine($data['name']);
                $cuisine->setId($data['id']);
                $cuisines[] = $cuisine;
            }

            return $cuisines;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching cuisines', $e->getCode(), $e);
        }
    }

    public function getCuisineById($cuisineId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM cuisines WHERE id = ?');
            $stmt->execute([$cuisineId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $cuisine = new Cuisine($data['name']);
            $cuisine->setId($data['id']);

            return $cuisine;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching cuisine', $e->getCode(), $e);
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
    
            $cuisinesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cuisines = [];
            foreach ($cuisinesData as $data) {
                $cuisine = new Cuisine($data['name']);
                $cuisine->setId($data['id']);
                $cuisines[] = $cuisine;
            }

            return $cuisines;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching cuisines', $e->getCode(), $e);
        }
    }

    public function addCuisine($cuisine)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO cuisines (name) VALUES (?)');
            $stmt->execute([$cuisine->getName()]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error adding cuisine', $e->getCode(), $e);
        }
    }

    public function updateCuisine($cuisine)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE cuisines SET name = ? WHERE id = ?');
            $stmt->execute([$cuisine->getName(), $cuisine->getId()]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error updating cuisine', $e->getCode(), $e);
        }
    }

    public function deleteCuisine($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM cuisines WHERE id = ?');
            $stmt->execute([$id]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting cuisine', $e->getCode(), $e);
        }
    }
}
?>