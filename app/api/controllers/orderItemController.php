<?php
require __DIR__ . '/../../services/orderItemService.php';
require __DIR__ . '/apiController.php';

class OrderItemController extends ApiController
{
    private $shoppingCartService;

    public function __construct()
    {
        $this->shoppingCartService = new OrderItemService();
    }

    public function getProductData()
    {

        try {
            $this->sendHeaders();
            $event = NULL;

            if (!empty($_GET['id'])) {
                $ticketId = htmlspecialchars($_GET['id']);

                $event = $this->shoppingCartService->getProductData($ticketId);
            }

            echo Json_encode($event);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }




}

?>