<?php

class Project {
    private $title;
    private $client;
    private $deadline;
    private $status;

    public function __construct($title, $client, $deadline, $status) {
        $this->title = $title;
        $this->client = $client;
        $this->deadline = $deadline;
        $this->status = $status;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getClient() {
        return $this->client;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function setDeadline($deadline) {
        $this->deadline = $deadline;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}