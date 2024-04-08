<?php

class ApiController
{
    public function __construct() {
        $this->sendHeaders();
    }
    
    protected function sendHeaders(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");
        header('Content-Type: application/json');
    }

    protected function handleGetAllRequest($service, $getAllMethod)
    {        
        $objects = $service->$getAllMethod();
        echo json_encode($objects);
    }

    protected function handleGetRequest($service, $getMethod, $id)
    {        
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid ID"]);
            return;
        }
        
        $object = $service->$getMethod($id);
        if (!$object) {
            http_response_code(404);
            $objectType = $this->getServiceObjectType($service);
            echo json_encode(["error" => "$objectType not found"]);
            return;
        }
        
        echo json_encode($object);
    }

    protected function handleDeleteRequest($service, $deleteMethod)
    {
        $objectType = $this->getServiceObjectType($service);
        
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID parameter missing"]);
            return;
        }
        
        $id = $_GET['id'];
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid ID"]);
            return;
        }
        
        $object = $service->$deleteMethod($id);
        if (!$object) {
            http_response_code(404);
            echo json_encode(["error" => "$objectType not found"]);
            return;
        }

        echo json_encode(["message" => "$objectType deleted successfully"]);
    }

    protected function handlePutRequest($service, $updateMethod, $getByIdMethod, $expectedProperties = [])
    {        
        $json = file_get_contents('php://input');
        $object = json_decode($json);
        $objectType = $this->getServiceObjectType($service);
        
        if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "Invalid JSON"]);
            return;
        }

        // Validate if all expected properties are present
        foreach ($expectedProperties as $property) {
            if (!property_exists($object, $property)) {
                http_response_code(400); // Bad Request
                echo json_encode(["error" => "Missing property: $property"]);
                return;
            }
        }
        
        if (isset($object->id)) {
            $id = $object->id;
            $objectFromService = $service->$getByIdMethod($id);
            
            if ($objectFromService) {
                foreach ($expectedProperties as $property) {
                    $setterMethod = $this->constructSetterMethodName($property);
                    // Check if the setter method exists
                    if (method_exists($objectFromService, $setterMethod)) {
                        // Call the setter method dynamically
                        $objectFromService->$setterMethod($object->$property);
                    } else {
                        // Handle the case where the setter method does not exist
                        http_response_code(400); // Bad Request
                        echo json_encode(["error" => "Setter method for property '$property' does not exist"]);
                        return;
                    }
                }
                
                $service->$updateMethod($objectFromService);
                echo json_encode(["message" => "$objectType updated successfully"]);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "$objectType not found"]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "Missing ID"]);
        }
    }

    // Construct the setter method name based on the property name
    private function constructSetterMethodName($property)
    {
        $camelCaseProperty = lcfirst(str_replace('_', '', ucwords($property, '_')));

        return 'set' . $camelCaseProperty;
    }

    private function getServiceObjectType($service) {
        //Default
        $object = "Object";
        switch (true) {
            case $service instanceof CuisineService:
                $object = "Cuisine";
                break;
            case $service instanceof SessionService:
                $object = "Session";	
                break;
            case $service instanceof RestaurantService:
                $object = "Restaurant";
                break;
            case $service instanceof ImageService:
                $object = "Image";
                break;
            case $service instanceof MenuService:
                $object = "Menu item";
                break;
            default:
                break;
        }   
        
        return $object;
    }
}
