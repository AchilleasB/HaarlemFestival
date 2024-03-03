<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/dance.php';

class DanceController extends Controller
{

    function __construct()
    {
    }
    public function index()
    {
        $this->displayView($this);
    }

    public function artist(){
        $this->displayView($this);
    } 

    public function tickets(){
        $this->displayView($this);
    }

}