<?php
require_once(__DIR__ . '/repository.php');

class HistoryTourRepository extends Repository
{
    public function getAllTours() {
        try {
            $sql = "SELECT tours.*, tour_guides.name AS guide_name
                    FROM history_tours AS tours
                    INNER JOIN tour_guides ON tours.guide = tour_guides.id
                     ORDER BY tours.id";
            $statement = $this->connection->query($sql);
            $tours = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $tours;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; 
        }
    }
      
    public function getAllGuides()
{
    try {
        $sql = "SELECT * FROM tour_guides";
        $statement = $this->connection->query($sql);
        $guides = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $guides;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
public function getOrganizedTours()
{
    try {
        $sql = "SELECT ht.date, ht.time, CONCAT(g.name, ' (', g.language, ')') AS guide
                FROM history_tours ht
                LEFT JOIN tour_guides g ON ht.guide = g.id
                ORDER BY ht.date, ht.time";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $tours = $statement->fetchAll(PDO::FETCH_ASSOC);

        $organizedTours = [];
        foreach ($tours as $tour) {
            $date = $tour['date'];
            $time = $tour['time'];
            $guide = $tour['guide'];

            if (!isset($organizedTours[$date])) {
                $organizedTours[$date] = [];
            }

            if (!isset($organizedTours[$date][$time])) {
                $organizedTours[$date][$time] = [];
            }
            $organizedTours[$date][$time][] = $guide;
        }

        return $organizedTours;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

    public function getLanguages()
    {
        try {
            $sql = "SELECT DISTINCT language FROM tour_guides";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $languages = $statement->fetchAll(PDO::FETCH_COLUMN);

            return $languages;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; 
        }
    }
    
    public function getDates()
    {
        try {
            $sql = "SELECT DISTINCT date FROM history_tours";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $dates = $statement->fetchAll(PDO::FETCH_COLUMN);

            
            return $dates;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; 
        }
    }
    
    public function getTimes()
    {
        try {
            $sql = "SELECT DISTINCT time FROM history_tours";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $times = $statement->fetchAll(PDO::FETCH_COLUMN);

          
            return $times;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; 
        }
    }
    public function getTicketTypes()
    {
        try {
            $sql = "SELECT * FROM ticket_types";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $ticketTypes = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $ticketTypes;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function checkForMatchingTour($language, $date, $time)
    {
    try {
        $sql = "SELECT ht.id
                FROM history_tours ht
                JOIN tour_guides g ON ht.guide = g.id
                WHERE g.language = :language
                AND ht.date = :date
                AND ht.time = :time";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':language', $language);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':time', $time);
        $statement->execute();
        $historyTourId = $statement->fetchColumn();

        return $historyTourId ? $historyTourId : null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
public function getAvailableSeats($language, $date, $time)
{
    try {

        $sql = "SELECT seats FROM history_tours ht
                JOIN tour_guides g ON ht.guide = g.id
                WHERE g.language = :language
                AND ht.date = :date
                AND ht.time = :time";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':language', $language);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':time', $time);
        $statement->execute();
        $seats = $statement->fetchColumn();

        return $seats;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0; 
    }
}
public function getTicketTypePrice($ticketType)
{
    try {
        $sql = "SELECT price FROM ticket_types WHERE ticket_type = :ticket_type";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':ticket_type', $ticketType);
        $statement->execute();
        $price = $statement->fetchColumn();

        return $price;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
function addTicketToCart($historyTicket)
{
    try {
        $stmt = $this->connection->prepare('INSERT INTO tickets (id, amount, calc_price, history_tour_id, user_id) 
                                            VALUES (:id, :amount, :calc_price, :history_tour_id, :user_id)');
        $stmt->execute([
            ':id' => $historyTicket->getId(),
            ':amount' => $historyTicket->getAmount(),
            ':calc_price' => $historyTicket->getCalcPrice(),
            ':history_tour_id' => $historyTicket->getHistoryTourId(),
            ':user_id' => $historyTicket->getUserId()            
        ]);
        
        return true;

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function createTour(HistoryTour $tour)
{
    try {
        $sql = "INSERT INTO history_tours (date, time, guide, seats) VALUES (:date, :time, :guide, :seats)"; 
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':date' => $tour->getDate(),
            ':time' => $tour->getTime(),
            ':guide' => $tour->getGuide(),
            ':seats' => $tour->getSeats()
        ]);

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
public function updateTour(HistoryTour $tour)
{
    try {
        $sql = "UPDATE history_tours SET date = :date, time = :time, guide = :guide, seats = :seats WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':id' => $tour->getId(),
            ':date' => $tour->getDate(),
            ':time' => $tour->getTime(),
            ':guide' => $tour->getGuide(),
            ':seats' => $tour->getSeats()
        ]);

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
    public function deleteTour($tourId)
    {
        try {
            $sql = "DELETE FROM history_tours WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':id' => $tourId]);

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function createGuide(Guide $guide)
    {
        try {
            $sql = "INSERT INTO tour_guides (name, language) VALUES (:name, :language)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':name' => $guide->getName(),
                ':language' => $guide->getLanguage()
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function updateGuide(Guide $guide)
    {
        try {
            $sql = "UPDATE tour_guides SET name = :name, language = :language WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':name' => $guide->getName(),
                ':language' => $guide->getLanguage(),
                ':id' => $guide->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function deleteGuide($id)
    {
        try {
            $sql = "DELETE FROM tour_guides WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

public function updateSeats($historyTourId, $seatsToDeduct)
{
    try {
        $sql = "UPDATE history_tours 
                SET seats = seats - :seatsToDeduct 
                WHERE id = :historyTourId";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':seatsToDeduct', $seatsToDeduct, PDO::PARAM_INT);
        $statement->bindParam(':historyTourId', $historyTourId, PDO::PARAM_INT);

        $statement->execute();

        return true;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}




}
?>