<?php
class Game {
    private $id;
    private $title;
    private $platform;
    private $genre;
    private $steamid;
    private $descriptie;
    private $image;

    // Getters and setters for all properties

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getPlatform() {
        return $this->platform;
    }

    public function setPlatform($platform) {
        $this->platform = $platform;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function getSteamid() {
        return $this->steamid;
    }

    public function setSteamid($steamid) {
        $this->steamid = $steamid;
    }

    public function getDescriptie() {
        return $this->descriptie;
    }

    public function setDescriptie($descriptie) {
        $this->descriptie = $descriptie;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
?>
