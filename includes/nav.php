<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <a href="../pages/index.php">Ballina</a>
    <a href="../pages/login.php">Kyçu</a>
    <a href="../pages/register.php">Regjistrohu</a>
    <a href="../pages/contact.php">Kontakt</a>

     <a href="../pages/login.php" class="login-btn">Login</a>
</nav>
