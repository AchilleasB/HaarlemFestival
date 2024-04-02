<?php

class ImageRepository extends Repository
{
    public function getImagesByRestaurantId($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT image FROM images WHERE restaurant_id = :restaurant_id');
            $stmt->execute([':restaurant_id' => $restaurantId]);

            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching images', $e->getCode(), $e);
        }
    }

    public function addImageToRestaurant($restaurantId, $imagePath)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image, restaurant_id) VALUES (:image, :restaurant_id)');
            $stmt->execute([
                ':image' => $imagePath,
                ':restaurant_id' => $restaurantId,
            ]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding image', $e->getCode(), $e);
        }
    }

    public function addImage($imagePath)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image) VALUES (:image)');
            $stmt->execute([':image' => $imagePath]);

            $lastInsertedId = $this->connection->lastInsertId();

            return $lastInsertedId;

        } catch (PDOException $e) {
            throw new RepositoryException('Error adding image', $e->getCode(), $e);
        }
    }

    public function deleteImageFromRestaurant($restaurantId, $imageName)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM images WHERE restaurant_id = :restaurant_id AND image = :image');
            $stmt->execute([
                ':restaurant_id' => $restaurantId,
                ':image' => $imageName
            ]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting image', $e->getCode(), $e);
        }
    }

    public function deleteImage($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM images WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting image', $e->getCode(), $e);
        }
    }
}
