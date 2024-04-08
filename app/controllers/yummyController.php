<?php

use FontLib\Table\Type\head;

require_once(__DIR__ . '/controller.php');
require_once(__DIR__ . '/../services/yummy/restaurantService.php');
require_once(__DIR__ . '/../services/yummy/reservationService.php');
require_once(__DIR__ . '/../services/userService.php');
require_once(__DIR__ . '/../models/ticket.php');
require_once(__DIR__ . '/../services/ticketService.php');
require_once __DIR__ . '/../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class YummyController extends Controller
{
    private $restaurantService;
    private $reservationService;
    private $userService;

    public function __construct()
    {
        $this->restaurantService = new RestaurantService();
        $this->reservationService = new ReservationService();
        $this->userService = new UserService();
    }

    public function index()
    {
        $restaurants = $this->restaurantService->getAllRestaurantsBaseInfo();
        $restaurantsRecommended = $this->restaurantService->getAllRestaurantsRecommended();

        $data = [
            'restaurants' => $restaurants,
            'restaurantsRecommended' => $restaurantsRecommended
        ];


        $this->displayViewWithDataSet($this, $data);
    }

    public function restaurant()
    {
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

    public function reservationForm()
    {
        // if (isset($_SESSION['user_role'])) {
        $id = $_SESSION['restaurant_id'];
        try {
            $restaurant = $this->restaurantService->getRestaurantDetailedInfoById($id);
            $user = null;
            if (isset($_SESSION['user_id'])) {
                $user = $this->userService->getUserById($_SESSION['user_id']);
            }
            $data = [
                'restaurant' => $restaurant,
                'user' => $user
            ];
            $this->displayViewWithDataSet($this, $data);
        } catch (RepositoryException $e) {
            $this->handleException($e);
        }
        // } else {
        //     
        // }
    }

    public function reservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = new Reservation(
                $_SESSION['restaurant_id'],
                $_POST['session_id'],
                isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
                $_POST['guests'],
                $_POST['phone'],
                $_POST['remark'],
                false,
                false
            );
            try {
                $reservationId = $this->reservationService->addReservation($reservation);
                $reservation = $this->reservationService->getReservationById($reservationId);

                $price = $reservation->getNumberOfPeople() * 10;
                $reservationTicket = new Ticket();
                $reservationTicket->setId(Uuid::uuid4()->toString());
                $reservationTicket->setAmount($reservation->getNumberOfPeople());
                $reservationTicket->setReservationId($reservation->getId());
                $reservationTicket->setUserId($reservation->getUserId());
                $reservationTicket->setCalcPrice($price);
                $this->reservationService->addReservationToCart($reservationTicket);

                  //added by Maria to enable adding dance tickets to shopping cart by visitor

                  if(!isset($_SESSION['user_id'])){
                    if (!isset($_SESSION['selected_items_to_purchase'])){
                        $_SESSION['selected_items_to_purchase']=[];
                    }
                    $_SESSION['selected_items_to_purchase'][count($_SESSION['selected_items_to_purchase'])]=$reservationTicket;

                }
                //end of added by Maria

                header('Location: /yummy/restaurant?id=' . $_SESSION['restaurant_id']);
            } catch (RepositoryException $e) {
                //$this->handleException($e);
            }
        } else {
            echo "This is not a POST request";
        }
    }

    private function displayRestaurant($restaurant)
    {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];

        require __DIR__ . "/../views/$directory/$view.php";
    }
}
