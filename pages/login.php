<?php
session_start();
require_once "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $error = "Ju lutem plotësoni të gjitha fushat.";
    } else {
        try {
            $query = $conn->prepare("SELECT * FROM perdoruesit WHERE email = ?");
            $query->execute([$email]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["fjalekalimi"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["emri"];
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_role"] = $user["roli"];

                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Email ose fjalëkalimi është i pasaktë.";
            }
        } catch (PDOException $e) {
            $error = "Ndodhi një gabim gjatë kyçjes.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Kyçja - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="auth-page">
    <div class="auth-box">

        <a href="index.php" class="back-home">← Kthehu në Ballinë</a>

        <h1>Kyçu në NeuroCode</h1>

        <?php if ($error != ""): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Fjalëkalimi:</label>
            <input type="password" name="password" required>

            <button type="submit">Kyçu</button>
        </form>

        <p>Nuk ke llogari? <a href="register.php">Regjistrohu këtu</a></p>

    </div>
</div>
</body>
</html>
