<?php
require_once(__DIR__ . '/Repository.php');

class HistoryTourRepository extends Repository
{
    function getAllHistoryTours()
    {
        try {
            $sql = "SELECT ht.date, ht.time, tg.name AS guide_name, tg.language FROM history_tours ht
                    INNER JOIN tour_guides tg ON ht.guide = tg.id
                    ORDER BY ht.date, ht.time";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $historyTours = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($historyTours as &$tour) {
                $tour['date'] = date('j F', strtotime($tour['date']));
            }

            return $historyTours;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
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

            // Format dates as 'Day Month Year'
            $formattedDates = array_map(function($date) {
                return date('j F', strtotime($date));
            }, $dates);

            return $formattedDates;
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

            // Format times as 'Hour:Minute AM/PM'
            $formattedTimes = array_map(function($time) {
                return date('H:i', strtotime($time));
            }, $times);

            return $formattedTimes;
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

}
?>