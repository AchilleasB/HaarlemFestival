<?php

class EventPage
{
    private $id;
    private $title;
    private $subTitle;
    private $description;
    private $information;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitleHumanFriendly()
    {
        return $this->makeHumanFriendly($this->title);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $this->makeUrlFriendly($title);
    }

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getInformation()
    {
        return $this->information;
    }

    public function setInformation($information)
    {
        $this->information = $information;
    }

    private function makeUrlFriendly($title) {
        $title = trim($title);
        $title = str_replace(' ', '-', $title);
        $title = strtolower($title);
        
        $title = preg_replace('/[^a-z0-9-]/', '', $title);
        
        return $title;
    }

    private function makeHumanFriendly($title) {
        $title = str_replace('-', ' ', $title);
        $title = ucwords($title);
    
        return $title;
    }
}