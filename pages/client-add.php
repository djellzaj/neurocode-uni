<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri = trim($_POST["emri"]);
    $email = trim($_POST["email"]);
    $telefoni = trim($_POST["telefoni"]);
    $kompania = trim($_POST["kompania"]);

    // VALIDIMI
    if (!preg_match("/^[a-zA-Z\s]{3,}$/", $emri)) {
        $error = "Emri nuk është i vlefshëm!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email nuk është i vlefshëm!";
    } else {

        $stmt = $conn->prepare("INSERT INTO klientet (emri, email, telefoni, kompania, krijuar_nga) VALUES (?, ?, ?, ?, ?)");

        $stmt->execute([
            $emri,
            $email,
            $telefoni,
            $kompania,
            $_SESSION["user_id"] ?? null
        ]);

        header("Location: clients.php");
        exit;
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="main-content">

    <h2>Shto Klient</h2>

    <div class="form-container">

        <?php if ($error != "") echo "<p class='error'>$error</p>"; ?>

        <form method="POST">

            <label>Emri</label>
            <input type="text" name="emri" required>

            <label>Email</label>
            <input type="text" name="email" required>

            <label>Nr.Tel</label>
            <input type="text" name="telefoni">

            <label>Kompania</label>
            <input type="text" name="kompania">

            <button type="submit">Ruaj Klientin</button>

        </form>

    </div>

</div>

<?php include("../includes/footer.php"); ?>