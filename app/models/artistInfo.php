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

    public function jsonSerialize(): mixed
    {
        return [
            'artist_id' => $this->artist_id,
            'description' => $this->description,
            'page_img' => $this->page_img,
            'career_highlight_title' => $this->career_highlight_title,
            'career_highlight_img' => $this->career_highlight_img,
            'career_highlight_text' => $this->career_highlight_text,
            'latest_releases' => $this->latest_releases
        ];
    }
}