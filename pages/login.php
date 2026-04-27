<?php
session_start();
include "../includes/users.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    foreach ($users as $user) {
        if ($email == $user["email"] && $password == $user["password"]) {
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_role"] = $user["role"];

            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Email ose fjalëkalimi është i pasaktë.";
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Kyçja - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css"></head>
<body>
<div class="auth-page">
    <div class="auth-box">

        <a href="index.php" class="back-home">← Kthehu në Ballinë</a>

        <h1>Kyçu në NeuroCode</h1>

        <?php if ($error != ""): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Fjalëkalimi:</label>
            <input type="password" name="password" required>

            <button type="submit">Kyçu</button>
        </form>

        <p>Admin: admin@neurocode.com / admin123</p>
        <p>User: user@neurocode.com / user123</p>

        <p>Nuk ke llogari? <a href="register.php">Regjistrohu këtu</a></p>

    </div>
</div>
</body>
</html>
