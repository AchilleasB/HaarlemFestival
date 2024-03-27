<?php

class HistoryTour {
    public $id;
    public $date;
    public $time;
    public $guide;

    public function __construct($id, $date, $time, $guide) {
        $this->id = $id;
        $this->date = $date;
        $this->time = $time;
        $this->guide = $guide;
    }
}
