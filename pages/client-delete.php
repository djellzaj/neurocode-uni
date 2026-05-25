<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID nuk është valide");
}

$stmt = $conn->prepare("DELETE FROM klientet WHERE id = ?");
$stmt->execute([$id]);

header("Location: clients.php");
exit;
