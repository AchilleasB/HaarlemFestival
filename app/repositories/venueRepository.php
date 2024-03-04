<?
require __DIR__ . '/repository.php';
require_once __DIR__ . ' /../models/venue.php';

class VenueRepository extends Repository
{
    public function getAllVenues()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM venues');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addVenue($venue)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO venues (name, address, venue_image) VALUES (:name, :address, :venue_image)');
            $stmt->execute([
                ':name' => $venue->getName(),
                ':address' => $venue->getAddress(),
                ':venue_image' => $venue->getVenueImage()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateVenue($venue)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE venues SET name = :name, address = :address, venue_image = :venue_image WHERE id = :id');
            $stmt->execute([
                ':id' => $venue->getId(),
                ':name' => $venue->getName(),
                ':address' => $venue->getAddress(),
                ':venue_image' => $venue->getVenueImage()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteVenue($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM venues WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}