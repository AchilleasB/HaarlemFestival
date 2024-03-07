<?php
require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../services/HistoryTourService.php');

class HistoryTourController extends Controller
{
    protected $historyTourService;
    
    public function __construct()
    {
        $this->historyTourService = new HistoryTourService();
    }

    public function index()
    {
        $historyTours = $this->historyTourService->getAllHistoryTours();
        require(__DIR__ . '/../views/history_tours/index.php');
    }
}
?>