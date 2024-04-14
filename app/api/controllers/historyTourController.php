<?php

require_once(__DIR__ . '/../../services/locationService.php');
require_once(__DIR__ . '/../../services/historyTourService.php');
require_once(__DIR__ . '/../../services/eventPageService.php');
require_once(__DIR__ . '/../../repositories/eventPageRepository.php');
require_once(__DIR__ . '/../../models/locations.php');
require_once(__DIR__ . '/../../models/historyTour.php');
require_once(__DIR__ . '/../../models/Guide.php');
require_once(__DIR__ . '/../../models/ticket.php');
require_once(__DIR__ . '/../../models/eventPage.php');
require_once(__DIR__ . '/apiController.php');

use Ramsey\Uuid\Uuid;

class HistoryTourController extends ApiController
{
    protected $locationService;
    protected $historyTourService;

    public function __construct()
    {
        $this->historyTourService = new HistoryTourService();
        $this->locationService = new LocationService();
    }

    public function createGuide()
    {
        $this->createEntity("Guide", ["name" => "name", "language" => "language"], $this->historyTourService);
    }

    public function createTour()
    {
        $this->createEntity("HistoryTour", ["date" => "date", "time" => "time", "guide" => "guide", "seats" => "seats"], $this->historyTourService);
    }

    public function createLocation()
    {
        $this->createEntity("Location", ["locationName" => "location_name", "address" => "address", "description" => "description", "links" => "links"], $this->locationService);
    }

    public function updateGuide()
    {
        $this->updateEntity("guide", $_POST, $this->historyTourService);
    }

    public function updateTour()
    {
        $this->updateEntity("tour", $_POST, $this->historyTourService);
    }

    public function updateLocation()
    {
        $this->updateEntity("location", $_POST, $this->locationService);
    }

    public function deleteLocation()
    {
        $this->deleteEntities("location", "locationsToDelete", $this->locationService);
    }

    public function deleteTour()
    {
        $this->deleteEntities("tour", "toursToDelete", $this->historyTourService);
    }

    public function deleteGuide()
    {
        $this->deleteEntities("guide", "guidesToDelete", $this->historyTourService);
    }

    protected function updateEntity($entityType, $requestData, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        switch ($entityType) {
            case "guide":
                $entity = new Guide();
                $entity->setId($requestData["id"]);
                $entity->setName($requestData["name"]);
                $entity->setLanguage($requestData["language"]);
                $success = $service->updateGuide($entity);
                break;
            case "tour":
                $entity = new HistoryTour();
                $entity->setId($requestData["id"]);
                $entity->setDate($requestData["date"]);
                $entity->setTime($requestData["time"]);
                $entity->setGuide($requestData["guide"]);
                $entity->setSeats($requestData["seats"]);
                $success = $service->updateTour($entity);
                break;
            case "location":
                $entity = new Location();
                $entity->setId($requestData["id"]);
                $entity->setLocationName($requestData["location_name"]);
                $entity->setAddress($requestData["address"]);
                $entity->setDescription($requestData["description"]);
                $entity->setLinks($requestData["links"]);
                $success = $service->updateLocation($entity);
                break;
            default:
                return;
        }

        if ($success) {
            $this->redirectToHistoryManagement();
        } else {
            echo json_encode(["message" => "Failed to update $entityType."]);
        }
    }

    protected function createEntity($entity, $data, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $object = new $entity();

        foreach ($data as $key => $value) {
            $setter = "set" . ucfirst($key);
            if (method_exists($object, $setter)) {
                $object->$setter($_POST[$value]);
            }
        }

        $success = false;
        if ($service instanceof LocationService) {
            $success = $service->createLocation($object);
        } elseif ($service instanceof HistoryTourService) {
            if ($entity === "HistoryTour") {
                $success = $service->createTour($object);
            } elseif ($entity === "Guide") {
                $success = $service->createGuide($object);
            }
        }

        if ($success) {
            $this->redirectToHistoryManagement();
        } else {
            echo json_encode(["message" => "Failed to create $entity."]);
        }
    }

    protected function deleteEntities($entityType, $ids, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        if (!isset($_POST[$ids]) || !is_array($_POST[$ids])) {
            echo json_encode(["message" => "No $entityType selected for deletion."]);
            return;
        }

        foreach ($_POST[$ids] as $id) {
            switch ($entityType) {
                case "location":
                    $success = $service->deleteLocation($id);
                    break;
                case "tour":
                    $success = $service->deleteTour($id);
                    break;
                case "guide":
                    $success = $service->deleteGuide($id);
                    break;
                default:
                    $success = false;
                    break;
            }

            if (!$success) {
                echo json_encode(["message" => "Failed to delete $entityType with ID: $id."]);
                return;
            }
        }

        $this->redirectToHistoryManagement();
    }

    protected function redirectToHistoryManagement()
    {
        header("Location: /cms/historyManagement");
        exit();
    }


    public function generateTicket()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            return;
        }
    
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);
    
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid JSON']);
            return;
        }
    
        $language = $data['language'];
        $date = $data['date'];
        $time = $data['time'];
        $quantity = $data['quantity'];
        $ticketType = $data['ticketType'];
        $user_id = $data['user_id'];
    
        try {
            $this->processTicket($language, $date, $time, $quantity, $ticketType, $user_id);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
        }
    
    }
    private function processTicket($language, $date, $time, $quantity, $ticketType, $user_id)
{
    $historyTourID = $this->historyTourService->checkForMatchingTour($language, $date, $time);
    $isFamilyTicket = strpos(strtolower($ticketType), 'family') !== false;
    $availableSeats = $this->historyTourService->getAvailableSeats($language, $date, $time);
    $requiredSeats = ($isFamilyTicket ? 4 : 1) * $quantity;

    if (!$historyTourID) {
        $message = 'No tours found';
    } elseif ($availableSeats < $requiredSeats) {
        $message = 'Not enough seats available';
    } else {
        $ticket = $this->createTicket($historyTourID, $quantity, $ticketType, $user_id);
        $this->historyTourService->addTicketToCart($ticket);

        ///added by Maria to enable also adding history tour tickets to shopping cart by visitor
        if(!isset($_SESSION['user_id'])){
            if (!isset($_SESSION['selected_items_to_purchase'])){
                $_SESSION['selected_items_to_purchase']=[];
            }
            $_SESSION['selected_items_to_purchase'][count($_SESSION['selected_items_to_purchase'])]=$ticket;

        }
        //end of added by Maria 

        //$this->historyTourService->updateSeats($historyTourID, $requiredSeats);
        $message = 'Ticket(s) added to cart successfully';
    }

    echo json_encode(['message' => $message]);
}

    private function createTicket($historyTourID, $quantity, $ticketType, $user_id)
    {
        $ticket = new Ticket();
        $ticket->setId(Uuid::uuid4()->toString());
        $ticket->setAmount($quantity);
        $ticket->setHistoryTourId($historyTourID);
        $ticket->setUserId($user_id ?: null);
        $ticketPrice = $this->historyTourService->getTicketTypePrice($ticketType);
        $calc_price = $ticketPrice * $quantity;
        $ticket->setCalcPrice($calc_price);
        return $ticket;
    }
    
    
}
?>