<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

if (!isset($_GET["id"])) {
    header("Location: projects.php");
    exit();
}

$id = (int) $_GET["id"];

try {
    $projectObj = new Project($conn);
    $projectObj->deleteProject($id);

    header("Location: projects.php");
    exit();
} catch (Exception $e) {
    echo "Fshirja dështoi.";
}