<?php

require __DIR__ . '/../repository.php';

class RestaurantImageRepository extends Repository
{
    public function getImagesByRestaurantId($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT image FROM images WHERE restaurant_id = :restaurant_id');
            $stmt->execute([':restaurant_id' => $restaurantId]);

            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addImage($restaurantId, $imagePath)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image, restaurant_id) VALUES (:image, :restaurant_id)');
            $stmt->execute([
                ':image' => $imagePath,
                ':restaurant_id' => $restaurantId,
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteImage($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM images WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}