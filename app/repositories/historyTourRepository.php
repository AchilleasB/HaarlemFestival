<?php
require_once(__DIR__ . '/Repository.php');

class HistoryTourRepository extends Repository
{
     function getAllHistoryTours()
    {
        try {
            $sql = "SELECT * FROM history_tours";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $historyTours = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $historyTours;
        } catch (PDOException $e) {
        
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
?>