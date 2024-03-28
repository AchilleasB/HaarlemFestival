<?php



//class that stores detailed information from the ticket 
//used in OrderItemRepository->getProductData($ticketId)

class EventData implements \JsonSerializable
{
    private string $date_time;

    private int $tickets_available;

    private ?float $ticket_price;

    private string $name;

    private ?string $artist_image;

    private ?string $history_tour_image;

    private ?string $ticket_type;

    private ?string $location_name;

    private ?string $address;


    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }



/**
 * @return string
 */
public function getDateTime(): string
{
    return $this->date_time;
}



public function setDateTime(string $value )
{
   $dateTimeData = preg_split("/[\s\t]/" , $value);
   $dayOfWeek = reset($dateTimeData);
   $day = next($dateTimeData);
   $month = next($dateTimeData);
   $time = next($dateTimeData);

   if ($dayOfWeek AND $day AND $month AND $time ){
   $dateTimeString = "{$dayOfWeek} {$day} {$month} {$time}";}
   else 
   {$dateTimeString = reset($dateTimeData) . " " . date("H:i", strtotime(next($dateTimeData)));
    
   }
    $this->date_time = $dateTimeString;
}  

/**
 * @return int
 */
public function getTicketsAvailable(): int
{
    return $this->tickets_available;
}


public function setTicketsAvailable(int $tickets_available): void
{
    $this->tickets_available = $tickets_available;
}


/**
 * @return float
 */
public function getTicketPrice(): ?float
{
    return $this->ticket_price;
}


public function setTicketPrice(?float $ticket_price): void
{
    $this->ticket_price = $ticket_price;
}



/**
 * @return string
 */
public function getName(): string
{
    return $this->name;
}


public function setName(string $name): void
{
    $this->name = $name;
}





/**
 * @return string
 */
public function getArtistImage(): ?string
{
    return $this->artist_image;
}



public function setArtistImage(?string $artist_image): void
{
    $this->artist_image = $artist_image;
}


/**
 * @return string
 */
public function getHistoryTourImage(): ?string
{
    return $this->history_tour_image;
}



public function setHistoryTourImage(?string $history_tour_image): void
{
    $this->history_tour_image = $history_tour_image;
}


/**
 * @return string
 */
public function getTicketType(): ?string
{
    return $this->ticket_type;
}



public function setTicketType(?string $ticket_type): void
{
    $this->ticket_type = $ticket_type;
}


/**
 * @return string
 */
public function getLocationName(): ?string
{
    return $this->location_name;
}

public function setLocationName(?string $location_name): void
{
    $this->location_name = $location_name;
}

/**
 * @return string
 */
public function getLocationAddress(): ?string
{
    return $this->address;
}


public function setLocationAddress(?string $location_address): void
{
    $this->address = $location_address;
}

}
?>