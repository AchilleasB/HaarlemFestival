<?php

class Image{

    private int $id;
    private string $image;
    
	/**
	 * @return int
	 */
	public function geId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $image_id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getImage(): string {
		return $this->image;
	}
	
	/**
	 * @param string $image 
	 * @return self
	 */
	public function setImage(string $image): self {
		$this->image = $image;
		return $this;
	}
}