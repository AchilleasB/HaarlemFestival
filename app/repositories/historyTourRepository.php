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

            // Format dates
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
                           MAX(CASE WHEN time = '10:00:00.00000' THEN CONCAT(g.name, ' (', g.language, ')') ELSE '' END) AS '10:00',
                           MAX(CASE WHEN time = '13:00:00.00000' THEN CONCAT(g.name, ' (', g.language, ')') ELSE '' END) AS '13:00',
                           MAX(CASE WHEN time = '16:00:00.00000' THEN CONCAT(g.name, ' (', g.language, ')') ELSE '' END) AS '16:00'
                    FROM history_tours ht
                    LEFT JOIN tour_guides g ON ht.guide = g.id
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
}
?>