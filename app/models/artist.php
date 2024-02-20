<?php

class Artist implements JsonSerializable
{
    private int $id;
    private string $name;
    private string $genre;
    private string $description;
    private string $artist_image;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getGenre(): string
    {
        return $this->genre;
    }
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getArtistImage(): string
    {
        return $this->artist_image;
    }
    public function setArtistImage(string $artist_image): void
    {
        $this->artist_image = $artist_image;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'genre' => $this->genre,
            'description' => $this->description,
            'artist_image' => $this->artist_image
        ];
    }
}