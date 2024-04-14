<?php

require_once __DIR__ . "/controller.php";
require_once __DIR__ . "/../services/orderService.php";
require_once __DIR__ . "/../services/festivalService.php";
require_once __DIR__ . "/../services/eventPageService.php";
require_once __DIR__ . "/../services/locationService.php";
require_once __DIR__ . "/../services/historyTourService.php";

class CmsController extends Controller
{
    protected $festivalService;
    protected $eventPageService;
    protected $locationService;
    protected $historyTourService;

    public function __construct()
    {
        $this->festivalService = new FestivalService();
        $this->historyTourService = new HistoryTourService();
        $this->eventPageService = new EventPageService();
        $this->locationService = new LocationService();
    }
    public function index()
    {
        if (
            isset($_SESSION["user_role"]) &&
            $_SESSION["user_role"] === "Admin"
        ) {
            $this->displayView($this);
        } else {
            header("Location: /login");
            exit();
        }
    }
    public function festivalManagement()
    {
        $this->isAuthorized();
        $events = $this->festivalService->getAllEvents();
        $data = [

            'events' => $events
        ];

        $this->displayViewWithDataSet($this, $data);

    }
    public function eventManagement()
    {
        $this->isAuthorized();
        $events = $this->eventPageService->getAllEvents();
        $data = [

            'events' => $events
        ];

        $this->displayViewWithDataSet($this, $data);
    }
    public function historyManagement()
    {
        $this->isAuthorized();
        $tours = $this->historyTourService->getAllTours();
        $locations = $this->locationService->getAllLocations();
        $guides = $this->historyTourService->getAllGuides();
        $data = [

            'tours' => $tours,
            'locations' => $locations,
            'guides' => $guides
        ];

        $this->displayViewWithDataSet($this, $data);
    }

    public function danceManagement()
    {
        $this->isAuthorized();
        $this->displayView($this);
    }

    public function userManagement()
    {
        $this->isAuthorized();
        $this->displayView($this);
    }
    public function orderManagement()
    {
        $this->isAuthorized();
        $orderService = new OrderService();
        $orders = $orderService->getAllOrders();
        $data = [

            'orders' => $orders
        ];

        $this->displayOrders($this, $data);
    }
    public function yummyManagement()
    {
        $this->isAuthorized();
        $this->displayView($this);
    }
    private function isAuthorized()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {
            return true;
        } else {
            header('Location: /login?redirect=' . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }
    }
}
