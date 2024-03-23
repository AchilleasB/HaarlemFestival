<?php

class DanceAppearance implements JsonSerializable
{
    private string $event_date;
    private string $event_start_time;
    private string $event_end_time;
    private string $venue_name;
    private string $venue_address;
    private string $venue_image;

    public function jsonSerialize(): mixed
    {
        return [
            'event_date' => $this->event_date,
            'event_start_time' => $this->event_start_time,
            'event_end_time' => $this->event_end_time,
            'venue_name' => $this->venue_name,
            'venue_address' => $this->venue_address,
            'venue_image' => $this->venue_image       
        ];
    }

}