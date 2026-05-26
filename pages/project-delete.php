<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

$id = $_GET["id"] ?? null;

if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    header("Location: projects.php");
    exit();
}

$id = (int) $id;

try {
    $projectObj = new Project($conn);
    $projectObj->deleteProject($id);

    header("Location: projects.php");
    exit();
} catch (Exception $e) {
    echo "Fshirja dështoi.";
}
