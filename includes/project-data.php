<?php

require_once __DIR__ . "/../classes/Project.php";
require_once __DIR__ . "/../classes/PriorityProject.php";

/* 1. Numeric array */
$numbers = [1, 2, 3, 4];

/* 2. Associative array */
$user = [
    "name" => "Jona",
    "role" => "Manager"
];

/* 3. Multidimensional array */
$projectArray = [
    ["title" => "Website", "client" => "TechNova", "deadline" => "2026-05-10", "status" => "In Progress"],
    ["title" => "App", "client" => "SmartNet", "deadline" => "2026-05-02", "status" => "Completed"],
    ["title" => "Dashboard", "client" => "VisionX", "deadline" => "2026-05-15", "status" => "Pending"]
];

/* SORTIM (e detyrueshme) */
usort($projectArray, function($a, $b) {
    return strcmp($a["title"], $b["title"]);
});

/* OBJEKTE (OOP) */
$projects = [
    new Project("Website", "TechNova", "2026-05-10", "In Progress"),
    new Project("App", "SmartNet", "2026-05-02", "Completed"),
    new PriorityProject("Dashboard", "VisionX", "2026-05-15", "Pending", "High")
];

/* FUNKSIONE */
function countProjects($projects) {
    return count($projects);
}

function countCompleted($projects) {
    $count = 0;

    foreach ($projects as $p) {
        if ($p->getStatus() == "Completed") {
            $count++;
        }
    }

    return $count;
}

function countInProgress($projects) {
    $count = 0;

    foreach ($projects as $p) {
        if ($p->getStatus() == "In Progress") {
            $count++;
        }
    }

    return $count;
}