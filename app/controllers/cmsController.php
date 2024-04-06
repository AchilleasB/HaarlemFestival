<?php

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/orderService.php';
require_once __DIR__ . '/../services/festivalService.php';
require_once __DIR__ . '/../services/eventPageService.php';
require_once __DIR__ . '/../repositories/eventPageRepository.php';
require_once(__DIR__ . '/../models/eventPage.php');

class CmsController extends Controller
{
    protected $festivalService;
    protected $eventPageService;

    public function __construct()
    {
        $this->festivalService = new FestivalService();
        $this->eventPageService = new EventPageService(new EventPageRepository());
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
        $events = $festivalService->getAllEvents();

        require_once(__DIR__ . '/../views/cms/festivalManagement.php');
    }
    public function eventManagement()
    {
        $eventPages = $this->eventPageService->getAllEvents();
        require_once(__DIR__ . '/../views/cms/eventManagement.php');
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
        $data = [

            'orders' => $orders
        ];

        $this->displayOrders($this, $data);
    }

    public function updateEventTitle()
    {
        $this->updateEventField('title');
    }

    public function updateEventSubTitle()
    {
        $this->updateEventField('subTitle');
    }

    public function updateEventDescription()
    {
        $this->updateEventField('description');
    }

    public function updateEventTitleOverview()
    {
        $this->updateEventField('titleOverview');
    }

    public function updateEventDescriptionOverview()
    {
        $this->updateEventField('descriptionOverview');
    }

    public function updateEventSchedule()
    {
        $this->updateEventField('schedule');
    }

    public function updateEventLocation()
    {
        $this->updateEventField('location');
    }

    public function updateEventField($field)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = $_POST['event_id'];
            $value = $_POST[$field];

            $methodName = 'updateEvent' . ucfirst($field);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventPage = new EventPage();
            $eventPage->setId($_POST['event_id']);
            $eventPage->setTitle($_POST['title']);
            $eventPage->setSubTitle($_POST['subtitle']);
            $eventPage->setDescription($_POST['description']);
            $eventPage->setInformation($_POST['information']);

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = $_POST['id'];

            $success = $this->eventPageService->deleteEventPage($eventId);
            if ($success) {
                header("Location: /cms/eventManagement");
                exit();
            } else {
                echo "Failed to delete event page.";
            }
        }
    }

    public function yummyManagement()
    {
        if (isset($_SESSION['user_role'])) {
            $this->displayView($this);
        } else {
            header('Location: /login');
            exit();
        }
    }
}
