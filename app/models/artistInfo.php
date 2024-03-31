<?php

class ArtistInfo implements JsonSerializable
{
    private $artist_id;
    private $description;
    private $page_img;
    private $career_highlight_title;
    private $career_highlight_img;
    private $career_highlight_text;
    private $latest_releases;
    private $artist_name;

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    public function setArtistId(int $artist_id): void
    {
        $this->artist_id = $artist_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPageImg(): string
    {
        return $this->page_img;
    }

    public function setPageImg(string $page_img): void
    {
        $this->page_img = $page_img;
    }

    public function getCareerHighlightTitle(): string
    {
        return $this->career_highlight_title;
    }

    public function setCareerHighlightTitle(string $career_highlight_title): void
    {
        $this->career_highlight_title = $career_highlight_title;
    }

    public function getCareerHighlightImg(): string
    {
        return $this->career_highlight_img;
    }

    public function setCareerHighlightImg(string $career_highlight_img): void
    {
        $this->career_highlight_img = $career_highlight_img;
    }

    public function getCareerHighlightText(): string
    {
        return $this->career_highlight_text;
    }

    public function setCareerHighlightText(string $career_highlight_text): void
    {
        $this->career_highlight_text = $career_highlight_text;
    }

    public function getLatestReleases(): string
    {
        return $this->latest_releases;
    }

    public function setLatestReleases(string $latest_releases): void
    {
        $this->latest_releases = $latest_releases;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function setArtistName(string $artist_name): void
    {
        $this->artist_name = $artist_name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'artist_id' => $this->artist_id,
            'description' => $this->description,
            'page_img' => $this->page_img,
            'career_highlight_title' => $this->career_highlight_title,
            'career_highlight_img' => $this->career_highlight_img,
            'career_highlight_text' => $this->career_highlight_text,
            'latest_releases' => $this->latest_releases,
            'artist_name' => $this->artist_name
        ];
    }
}