<?php
require_once(__DIR__ . '/repository.php');

class HistoryTourRepository extends Repository
{
   
    public function getOrganizedTours()
    {
        try {
            $sql = "SELECT date, 
                           DATE_FORMAT(date, '%e %M') as formatted_date,
                           MAX(CASE WHEN time = '10:00:00.00000' THEN guides ELSE '' END) AS '10:00',
                           MAX(CASE WHEN time = '13:00:00.00000' THEN guides ELSE '' END) AS '13:00',
                           MAX(CASE WHEN time = '16:00:00.00000' THEN guides ELSE '' END) AS '16:00'
                    FROM (
                        SELECT ht.date, ht.time, 
                               GROUP_CONCAT(CONCAT(g.name, ' (', g.language, ')') SEPARATOR '<br>') AS guides
                        FROM history_tours ht
                        LEFT JOIN tour_guides g ON ht.guide = g.id
                        GROUP BY ht.date, ht.time
                    ) AS subquery
                    GROUP BY date
                    ORDER BY date";

            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $organizedTours = $statement->fetchAll(PDO::FETCH_ASSOC);

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

}
?>