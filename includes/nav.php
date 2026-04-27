<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <div class="nav-container">
        <a href="index.php" class="logo">NeuroCode</a>

        <div class="nav-links">
            <a href="index.php">Ballina</a>
            <a href="login.php">Kyçu</a>
            <a href="register.php">Regjistrohu</a>
            <a href="contact.php">Kontakt</a>
        </div>

        <a href="login.php" class="login-btn">Kyçu</a>
    </div>
</nav>
