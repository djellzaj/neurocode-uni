<?php
// register.php
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Regjistrimi - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h1>Regjistrohu në NeuroCode</h1>

<p>Kjo faqe është vetëm demonstrim për Fazën I. Përdoruesit ruhen statikisht në kod.</p>
    
<form method="POST" action="">
    <label>Emri:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Fjalëkalimi:</label>
    <input type="password" name="password" required>

    <button type="submit">Regjistrohu</button>
</form>

<p>Ke llogari? <a href="login.php">Kyçu këtu</a></p>

</body>
</html>
