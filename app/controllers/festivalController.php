<?php

require_once __DIR__ . '/controller.php';

class FestivalController extends Controller
{

    function __construct()
    {
    }
    public function index()
    {
        $this->displayView($this);
    }

}