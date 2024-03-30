<?php

require_once(__DIR__ . '/controller.php');
require_once(__DIR__ . '/../services/yummy/restaurantService.php');
require_once(__DIR__ . '/../services/yummy/reservationService.php');

class YummyController extends Controller
{
    private $restaurantService;
    private $reservationService;

    public function __construct()
    {
        $this->restaurantService = new RestaurantService();
        $this->reservationService = new ReservationService();
    }

    public function index()
    {
        $restaurants = $this->restaurantService->getAllRestaurantsBaseInfo();
        $restaurantsRecommended = $this->restaurantService->getAllRestaurantsRecommended();

        $data = [
            'restaurants' => $restaurants, 
            'restaurantsRecommended' => $restaurantsRecommended
        ];


        $this->displayYummyView($this, $data);
    }

    public function restaurant() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            try {
                $restaurant = $this->restaurantService->getRestaurantDetailedInfoById($id);
                $this->displayRestaurant($restaurant);
            } catch (RepositoryException $e) {
                $this->handleException($e);
            }
        } else {
            $this->handleError("No ID provided for the restaurant.");
        }
    }
    
    public function reservationForm() {
        $id = $_SESSION['restaurant_id'];
        try {
            $restaurant = $this->restaurantService->getRestaurantDetailedInfoById($id);
            $data = [
                'restaurant' => $restaurant,
                'availability' => $restaurant->getNumberOfSeats() - $this->reservationService->getAvailability(1, $id)
            ];
            $this->displayYummyView($this, $data);
        } catch (RepositoryException $e) {
            $this->handleException($e);
        }
    }

    public function reservation() {if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = new Reservation(
                $_SESSION['restaurant_id'],
                $_POST['session_id'],
                $_SESSION['user_id'],
                $_POST['guests'],
                $_POST['phone'],
                $_POST['remark'],
                false,
                false
            );
            try {
                $this->reservationService->addReservation($reservation);
            } catch (RepositoryException $e) {
                //$this->handleException($e);
                echo "problem";
            }
        } else {
            echo "This is not a POST request";
        }
    }
    
    private function displayRestaurant($restaurant) {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        require __DIR__ . "/../views/$directory/$view.php";
    }
}