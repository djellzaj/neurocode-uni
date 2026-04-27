<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <a href="../pages/index.php">Ballina</a>
    <a href="../pages/about.php">Rreth Nesh</a>
    <a href="../pages/services.php">Shërbimet</a>
    <a href="../pages/contact.php">Kontakt</a>
    <a href="../pages/help.php">Ndihmë</a>

     <a href="../pages/login.php" class="login-btn">Login</a>
</nav>