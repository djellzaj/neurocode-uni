
<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];
    $statusi = htmlspecialchars($_POST["statusi"]);

    $allowedStatuses = ["ne_pritje", "ne_proces", "perfunduar"];

    if (!in_array($statusi, $allowedStatuses)) {
        echo "Statusi nuk eshte valid.";
        exit();
    }

    try {
        $stmt = $conn->prepare("
            UPDATE projektet
            SET statusi = ?
            WHERE id = ?
        ");

        $stmt->execute([$statusi, $id]);

        echo "Statusi u perditesua me sukses.";

    } catch (Exception $e) {
        echo "Gabim gjate perditesimit te statusit.";
    }
}