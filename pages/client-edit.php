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

$stmt = $conn->prepare("SELECT * FROM klientet WHERE id = ?");
$stmt->execute([$id]);
$klienti = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$klienti) {
    die("Klienti nuk u gjet");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri = trim($_POST["emri"]);
    $email = trim($_POST["email"]);
    $telefoni = trim($_POST["telefoni"]);
    $kompania = trim($_POST["kompania"]);

    if (!preg_match("/^[a-zA-Z\s]{3,}$/", $emri)) {
        $error = "Emri nuk është i vlefshëm!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email nuk është i vlefshëm!";
    } else {

        $stmt = $conn->prepare("UPDATE klientet SET emri=?, email=?, telefoni=?, kompania=? WHERE id=?");

        $stmt->execute([$emri, $email, $telefoni, $kompania, $id]);

        header("Location: clients.php");
        exit;
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="main-content">

    <h2>Ndrysho Klientin</h2>

    <div class="form-container">

        <?php if ($error != "") echo "<p class='error'>$error</p>"; ?>

        <form method="POST">

            <label>Emri</label>
            <input type="text" name="emri" value="<?= htmlspecialchars($klienti["emri"]) ?>" required>

            <label>Email</label>
            <input type="text" name="email" value="<?= htmlspecialchars($klienti["email"]) ?>" required>

            <label>Nr.Tel</label>
            <input type="text" name="telefoni" value="<?= htmlspecialchars($klienti["telefoni"]) ?>">

            <label>Kompania</label>
            <input type="text" name="kompania" value="<?= htmlspecialchars($klienti["kompania"]) ?>">

            <button type="submit">Përditëso</button>

        </form>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
