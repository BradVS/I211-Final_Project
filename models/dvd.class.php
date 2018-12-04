<?php

/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: dvd.class.php
 * Description: the Dvd class models a real-world dvd.
 */

class Dvd {

    //private data members
    private $id, $title, $runtime, $rating, $description, $release_date, $director, $price, $image, $available;

    //the constructor
    public function __construct($title, $runtime, $rating, $description, $release_date, $director, $price, $image, $available) {
        $this->title = $title;
        $this->rating = $rating;
        $this->release_date = $release_date;
        $this->director = $director;
        $this->image = $image;
        $this->description = $description;
        $this->available = $available;
        $this->runtime = $runtime;
        $this->price = $price;
    }
	
	//getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getRelease_date() {
        return $this->release_date;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }
    
    function getRuntime() {
        return $this->runtime;
    }

    function getAvailable() {
        return $this->available;
    }

    function getPrice(){
        return $this->price;
    }

    //set dvd id
    public function setId($id) {
        $this->id = $id;
    }

}