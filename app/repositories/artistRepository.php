<?
require __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/artist.php';
require_once __DIR__ . '/../models/artistInfo.php';
require_once __DIR__ . '/../models/danceAppearance.php';

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

    public function getArtistInfo($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT *
                                                FROM artists_info WHERE artist_id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ArtistInfo');

            $artistInfo = $stmt->fetch();
            return $artistInfo;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getArtistDanceAppearances($id){
        try {
            $stmt = $this->connection->prepare('SELECT dance_events.date AS event_date, 
                                                        dance_events.start_time AS event_start_time, 
                                                        dance_events.end_time AS event_end_time, 
                                                        venues.name AS venue_name, 
                                                        venues.address AS venue_address, 
                                                        venues.venue_image
                                                FROM dance_events
                                                INNER JOIN event_artists
                                                ON dance_events.id = event_artists.event_id
                                                INNER JOIN venues
                                                ON dance_events.venue_id = venues.id
                                                WHERE event_artists.artist_id = :id'
            );
    
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'DanceAppearance');

            $appearances = $stmt->fetchAll();
    
            return $appearances;
    
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}