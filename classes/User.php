<?php

class User {
    private $name;
    private $email;
    private $role;

    public function __construct($name, $email, $role) {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}
