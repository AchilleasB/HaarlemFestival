<?
require __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/artist.php';

class ArtistRepository extends Repository
{
    public function getAllArtists()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artists');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getArtistById($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artists WHERE id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artist = $stmt->fetch();

            return $artist;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO artists (name, genre, description, artist_image) VALUES (:name, :genre, :description, :artist_image)');
            $stmt->execute([
                ':name' => $artist->getName(),
                ':genre' => $artist->getGenre(),
                ':description' => $artist->getDescription(),
                ':artist_image' => $artist->getArtistImage()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE artists SET name = :name, genre = :genre, description = :description, artist_image = :artist_image WHERE id = :id');
            $stmt->execute([
                ':id' => $artist->getId(),
                ':name' => $artist->getName(),
                ':genre' => $artist->getGenre(),
                ':description' => $artist->getDescription(),
                ':artist_image' => $artist->getArtistImage()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteArtist($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM artists WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}