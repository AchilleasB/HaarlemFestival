<?php

class RestaurantDetailed extends RestaurantRecommended
{
    private string $location;
    private int $number_of_seats;
    private array $menu;
    private array $images;
    private array $sessions;
    private bool $isRecommended;

    /**
     * RestaurantDetailed constructor.
     * @param string $name
     * @param int $number_of_stars
     * @param string $banner
     * @param array $cuisines
     * @param string $description
     * @param string $location
     * @param int $number_of_seats
     * @param array $menu
     * @param array $images
     * @param array $sessions
     * @param bool $isRecommended
     */
    public function __construct(
        string $name,
        int $number_of_stars,
        string $banner,
        array $cuisines,
        string $description,
        string $location,
        int $number_of_seats,
        array $menu,
        array $images,
        array $sessions,
        bool $isRecommended
    ) {
        parent::__construct($name, $number_of_stars, $banner, $cuisines, $description);
        $this->location = $location;
        $this->number_of_seats = $number_of_seats;
        $this->menu = $menu;
        $this->images = $images;
        $this->sessions = $sessions;
        $this->isRecommended = $isRecommended;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getNumberOfSeats(): int
    {
        return $this->number_of_seats;
    }

    public function setNumberOfSeats(int $number_of_seats): void
    {
        $this->number_of_seats = $number_of_seats;
    }

    public function getMenu($key) {
        return $this->menu[$key] ?? null;
    }

    public function setMenu($key, $value) {
        $this->menu[$key] = $value;
    }

    public function getImages(): array {
        return $this->images;
    }

    public function setImages(array $images): void {
        foreach ($images as $image) {
            if (!is_string($image)) {
                throw new InvalidArgumentException('Each image must be a string');
            }
        }

        $this->images = $images;
    }

    public function getSessions(): array {
        foreach ($this->sessions as $session) {
            $sessionsData[] = [
                'id' => $session->getId(),
                'date' => $session->__toString()
            ];
        }
        return $sessionsData;
    }
    
    public function setSessions(array $sessions): void {
        $this->sessions = $sessions;
    }

    public function getIsRecommended(): bool
    {
        return $this->isRecommended;
    }

    public function setIsRecommended(bool $isRecommended): void
    {
        $this->isRecommended = $isRecommended;
    }

    public function addToImageArray(string $image): void {
        $this->images[] = $image;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['location'] = $this->getLocation();
        $data['numberOfSeats'] = $this->getNumberOfSeats();
        $data['menu'] = $this->menu;
        $data['images'] = $this->getImages();
        $data['sessions'] = $this->getSessions();
        $data['isRecommended'] = $this->getIsRecommended();

        return $data;
    }
} 