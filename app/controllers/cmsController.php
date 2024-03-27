<?php

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/orderService.php';
require_once __DIR__ . '/../services/festivalService.php';


class CmsController extends Controller
{
    protected $festivalService;

    public function __construct() {
        $this->festivalService = new FestivalService();
    }
    public function index()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {
            $this->displayView($this);
        } else {
            header('Location: /login');
            exit();
        }
    }
    public function festivalManagement()
    {
        $festivalService = new FestivalService();
        $event = $festivalService->getEventDetails();

        require_once(__DIR__ . '/../views/cms/festivalManagement.php');
    }
    public function danceManagement()
    {
        $this->displayView($this);
    }

    public function userManagement()
    {
        $this->displayView($this);
    }
    public function historyManagement()
    {
        $this->displayView($this);
    }

    public function orderManagement()
    {
        $orderService = new OrderService();
        $orders = $orderService->getAllOrders();
        $data=[

            'orders' => $orders
        ];
        
        $this->displayOrders($this, $data);

    }
    public function updateEventDescription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $eventId = $_POST['event_id'];
            $description = $_POST['description'];

            $festivalService = new FestivalService();

            $success = $festivalService->updateEventDescription($eventId, $description);

            if ($success) {
                header("Location: /cms/festivalManagement");
                exit();
            } else {
                echo "Failed to update event description.";
            }
        } else {  
            echo "Invalid request method.";
        }
    }
    public function updateEventTitle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $eventId = $_POST['event_id'];
            $title = $_POST['title'];

            $festivalService = new FestivalService();

            $success = $festivalService->updateEventTitle($eventId, $title);

            if ($success) {
                header("Location: /cms/festivalManagement");
                exit();
            } else {
                echo "Failed to update event title.";
            }
        } else {  
            echo "Invalid request method.";
        }
    }
}

