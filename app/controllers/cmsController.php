<?php

require_once __DIR__ . '/controller.php';

class CmsController extends Controller {

    
    public function index(){ 
        $this->displayView($this);
    }
    
}