<?php

class Client {

    private $id;
    private $emri;
    private $email;
    private $telefoni;
    private $kompania;

    public function __construct($emri, $email, $telefoni, $kompania) {
        $this->emri = $emri;
        $this->email = $email;
        $this->telefoni = $telefoni;
        $this->kompania = $kompania;
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getEmri() {
        return $this->emri;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefoni() {
        return $this->telefoni;
    }

    public function getKompania() {
        return $this->kompania;
    }

    // SETTERS
    public function setEmri($emri) {
        $this->emri = $emri;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefoni($telefoni) {
        $this->telefoni = $telefoni;
    }

    public function setKompania($kompania) {
        $this->kompania = $kompania;
    }
}