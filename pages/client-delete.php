<?php
require_once "../config/db.php";
require_once "../includes/auth.php";

$id = $_GET["id"] ?? null;

if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID nuk është valide");
}

if (!$id) {
    die("ID nuk është valide");
}

$stmt = $conn->prepare("DELETE FROM klientet WHERE id = ?");
$stmt->execute([$id]);

header("Location: clients.php");
exit;
