<?php

require_once __DIR__ . "/controller.php";
require_once __DIR__ . "/../services/orderService.php";
require_once __DIR__ . "/../services/festivalService.php";
require_once __DIR__ . "/../services/eventPageService.php";
require_once __DIR__ . "/../repositories/eventPageRepository.php";
require_once __DIR__ . "/../models/eventPage.php";
require_once __DIR__ . "/../models/locations.php";
require_once __DIR__ . "/../services/locationService.php";
require_once __DIR__ . "/../repositories/locationRepository.php";
require_once __DIR__ . "/../services/historyTourService.php";
require_once __DIR__ . "/../models/historyTour.php";
require_once __DIR__ . "/../models/Guide.php";

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
        $this->eventPageService = new EventPageService(
            new EventPageRepository(),
        );
        $this->locationService = new LocationService(new LocationRepository());
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
        $festivalService = new FestivalService();
        $events = $festivalService->getAllEvents();

        require_once __DIR__ . "/../views/cms/festivalManagement.php";
    }
    public function eventManagement()
    {
        $this->isAuthorized();
        $eventPages = $this->eventPageService->getAllEvents();
        require_once __DIR__ . "/../views/cms/eventManagement.php";
    }
    public function historyManagement()
    {
        $this->isAuthorized();
        $tours = $this->historyTourService->getAllTours();
        $locations = $this->locationService->getAllLocations();
        $guides = $this->historyTourService->getAllGuides();

        require_once __DIR__ . "/../views/cms/historyManagement.php";
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

    public function updateEventTitle()
    {
        $this->isAuthorized();
        $this->updateEventField('title');
    }

    public function yummyManagement()
    {
        $this->isAuthorized();
        $this->updateEventField('subTitle');
    }

    public function updateEventDetails()
    {
        $eventsData = $_POST["events"];

        foreach ($eventsData as $eventId => $eventDetails) {
            $id = $eventId;
            $title = isset($eventDetails["title"])
                ? $eventDetails["title"]
                : "";
            $subTitle = isset($eventDetails["subTitle"])
                ? $eventDetails["subTitle"]
                : "";
            $description = isset($eventDetails["description"])
                ? $eventDetails["description"]
                : "";
            $locations = isset($eventDetails["locations"])
                ? $eventDetails["locations"]
                : "";
            $schedule = isset($eventDetails["schedule"])
                ? $eventDetails["schedule"]
                : "";

            $event = new EventOverview();
            $event->setId($id);
            $event->setTitle($title);
            $event->setSubTitle($subTitle);
            $event->setDescription($description);
            $event->setLocations($locations);
            $event->setSchedule($schedule);

            $success = $this->festivalService->updateEventDetails($event);

            if ($success) {
                header("Location: /cms/festivalManagement");
                exit();
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }

    public function updateEventField($field)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventId = $_POST["event_id"];
            $value = $_POST[$field];

            $methodName = "updateEvent" . ucfirst($field);
            $success = $this->festivalService->$methodName($eventId, $value);

            if ($success) {
                header("Location: /cms/festivalManagement");
                exit();
            } else {
                echo "Failed to update event $field.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function createEventPage()
    {
        $this->isAuthorized();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventPage = new EventPage();
            $eventPage->setTitle($_POST['title']);
            $eventPage->setSubTitle($_POST['subtitle']);
            $eventPage->setDescription($_POST['description']);
            $eventPage->setInformation($_POST['information']);

            $success = $this->eventPageService->createEventPage($eventPage);
            if ($success) {
                $eventPhp = "<?php\n";
                $eventPhp .= "\$pageTitle = '{$eventPage->getTitleHumanFriendly()}';\n";
                $eventPhp .= "require_once(__DIR__ . '/../../views/header.php');\n";
                $eventPhp .= "echo '<link rel=\"stylesheet\" href=\"../../styles/main.css\">';\n";
                $eventPhp .= "echo '<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">';\n";
                $eventPhp .= "echo '<link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css\" rel=\"stylesheet\">';\n";
                $eventPhp .= "?>\n";
                $eventPhp .= "<h1><?php echo \$pageTitle; ?></h1>\n";
                $eventPhp .= "<h2>{$eventPage->getSubTitle()}</h2>\n";
                $eventPhp .= "<p>{$eventPage->getDescription()}</p>\n";
                $eventPhp .= "<p>{$eventPage->getInformation()}</p>\n";
                $eventPhp .= "<?php require_once(__DIR__ . '/../../views/footer.php'); ?>\n";

                $directory = __DIR__ . '/../views/customPage/';
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $eventFilename = $directory . $eventPage->getTitle() . '.php';

                file_put_contents($eventFilename, $eventPhp);

                // Redirect to the generic controller's method
                $pageName = $eventPage->getTitle(); // Ensure this is URL-friendly
                header("Location: /customPage/viewPage/{$pageName}");
                exit();
            } else {
                echo "Failed to create event page.";
            }
        }
    }

    public function updateEventPage()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventPage = new EventPage();
            $eventPage->setId($_POST["event_id"]);
            $eventPage->setTitle($_POST["title"]);
            $eventPage->setSubTitle($_POST["subtitle"]);
            $eventPage->setDescription($_POST["description"]);
            $eventPage->setInformation($_POST["information"]);

            $success = $this->eventPageService->updateEventPage($eventPage);
            if ($success) {
                header("Location: /cms/eventManagement");
                exit();
            } else {
                echo "Failed to update event page.";
            }
        }
    }

    public function deleteEventPage()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventId = $_POST["id"];

            $success = $this->eventPageService->deleteEventPage($eventId);
            if ($success) {
                header("Location: /cms/eventManagement");
                exit();
            } else {
                echo "Failed to delete event page.";
            }
        }
    }
    public function createGuide()
    {
        $this->createEntity(
            "Guide",
            ["name" => "name", "language" => "language"],
            $this->historyTourService,
        );
    }

    public function createTour()
    {
        $this->createEntity(
            "HistoryTour",
            [
                "date" => "date",
                "time" => "time",
                "guide" => "guide",
                "seats" => "seats",
            ],
            $this->historyTourService,
        );
    }
    public function createLocation()
    {
        $this->createEntity(
            "Location",
            [
                "locationName" => "location_name",
                "address" => "address",
                "description" => "description",
                "links" => "links",
            ],
            $this->locationService,
        );
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
        $this->deleteEntities(
            "location",
            "locationsToDelete",
            $this->locationService,
        );
    }

    public function deleteTour()
    {
        $this->deleteEntities(
            "tour",
            "toursToDelete",
            $this->historyTourService,
        );
    }

    public function deleteGuide()
    {
        $this->deleteEntities(
            "guide",
            "guidesToDelete",
            $this->historyTourService,
        );
    }
    public function updateEntity($entityType, $requestData, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
                header("Location: /cms/historyManagement");
                exit();
            } else {
                echo "Failed to update $entityType.";
            }
        }
    }
    public function createEntity($entity, $data, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
                header("Location: /cms/historyManagement");
                exit();
            } else {
                echo "Failed to create $entity.";
            }
        }
    }
    public function deleteEntities($entityType, $ids, $service)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST[$ids]) && is_array($_POST[$ids])) {
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
                        echo "Failed to delete $entityType with ID: $id.";
                        exit();
                    }
                }
                header("Location: /cms/historyManagement");
                exit();
            } else {
                echo "No $entityType selected for deletion.";
            }
        }
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
