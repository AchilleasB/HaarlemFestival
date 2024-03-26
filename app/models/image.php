<?php

class Image{

    private int $id;
    private string $image;
    
	public function geId(): int {
		return $this->id;
	}
	
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}

	public function getImage(): string {
		return $this->image;
	}
	
	public function setImage(string $image): self {
		$this->image = $image;
		return $this;
	}
}