<?php
require_once "../config/db.php";

$error = "";
$suksesi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $fjalekalimi = trim($_POST["password"]);
    $roli = $_POST["role"] ?? "perdorues";

    if (empty($emri) || empty($email) || empty($fjalekalimi)) {
        $error = "Ju lutem plotësoni të gjitha fushat.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email-i nuk është valid.";
    } elseif (strlen($fjalekalimi) < 6) {
        $error = "Fjalëkalimi duhet të ketë të paktën 6 karaktere.";
    } elseif (!in_array($roli, ["admin", "perdorues"])) {
        $error = "Roli nuk është valid.";
    } else {
        try {
            $kontrollo = $conn->prepare("SELECT id FROM perdoruesit WHERE email = ?");
            $kontrollo->execute([$email]);

            if ($kontrollo->rowCount() > 0) {
                $error = "Ky email ekziston tashmë.";
            } else {
                $fjalekalimiHash = password_hash($fjalekalimi, PASSWORD_DEFAULT);

                $query = $conn->prepare(
                    "INSERT INTO perdoruesit (emri, email, fjalekalimi, roli) VALUES (?, ?, ?, ?)"
                );

                $query->execute([$emri, $email, $fjalekalimiHash, $roli]);

                $suksesi = "Regjistrimi u krye me sukses. Tani mund të kyçeni.";
            }
        } catch (PDOException $e) {
            $error = "Ndodhi një gabim gjatë regjistrimit.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Regjistrimi - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="auth-page">
    <div class="auth-box">

        <a href="index.php" class="back-home">← Kthehu në Ballinë</a>
        
        <h1>Regjistrohu në NeuroCode</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if (!empty($suksesi)): ?>
            <p class="success"><?php echo htmlspecialchars($suksesi); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Emri:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Fjalëkalimi:</label>
            <input type="password" name="password" required>

            <label>Roli:</label>
            <select name="role" required>
                <option value="perdorues">Përdorues</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Regjistrohu</button>
        </form>

        <p>Ke llogari? <a href="login.php">Kyçu këtu</a></p>

    </div>
</div>
</body>
</html>
