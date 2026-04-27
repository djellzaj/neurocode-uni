<?php

require_once "Project.php";

class PriorityProject extends Project {
    private $priority;

    public function __construct($title, $client, $deadline, $status, $priority) {
        parent::__construct($title, $client, $deadline, $status);
        $this->priority = $priority;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }
}