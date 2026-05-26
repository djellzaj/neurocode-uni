<?php
require_once "../includes/auth.php";
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"] ?? null;
    $statusi = trim($_POST["statusi"] ?? "");

    $allowedStatuses = ["ne_pritje", "ne_proces", "perfunduar"];

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        echo "ID nuk është valid.";
        exit();
    }

    if (!in_array($statusi, $allowedStatuses)) {
        echo "Statusi nuk është valid.";
        exit();
    }

    try {

        $stmt = $conn->prepare("
            UPDATE projektet
            SET statusi = ?
            WHERE id = ?
        ");

        $stmt->execute([$statusi, $id]);

        echo "Statusi u përditësua me sukses.";

    } catch (Exception $e) {

        echo "Gabim gjatë përditësimit të statusit.";

    }

} else {

    echo "Kërkesa nuk lejohet.";

}
