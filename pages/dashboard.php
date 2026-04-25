<?php
include "../includes/auth.php";
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h1>Mirë se erdhe, <?php echo $_SESSION["user_name"]; ?>!</h1>

<p>Email: <?php echo $_SESSION["user_email"]; ?></p>
<p>Roli: <?php echo $_SESSION["user_role"]; ?></p>

<hr>

<?php if ($_SESSION["user_role"] == "admin"): ?>
    <h2>Paneli i Adminit</h2>
    <p>Admini ka qasje në menaxhimin e përdoruesve, projekteve dhe raporteve.</p>

    <ul>
        <li>Menaxhimi i përdoruesve</li>
        <li>Menaxhimi i projekteve</li>
        <li>Shikimi i raporteve</li>
    </ul>

<?php else: ?>
    <h2>Paneli i Përdoruesit</h2>
    <p>Përdoruesi mund të shikojë projektet dhe informacionet bazë.</p>

    <ul>
        <li>Shikimi i projekteve</li>
        <li>Shikimi i profilit</li>
    </ul>
<?php endif; ?>

<br>

<a href="logout.php">Dil</a>

</body>
</html>