<?php
require __DIR__ . '/../../services/shoppingCartService.php';
require __DIR__ . '/apiController.php';

class ShoppingCartController extends ApiController
{
    private $shoppingCartService;

    public function __construct()
    {
        $this->shoppingCartService = new ShoppingCartService();
    }

    public function getProductData(){

        try {
            $this->sendHeaders();
            $event = NULL;

            if (!empty($_GET['id'])) {
                $eventId= htmlspecialchars($_GET['id']);

                $event = $this->shoppingCartService->getProductData($eventId);
            }

            echo Json_encode($event);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }


}

?>
