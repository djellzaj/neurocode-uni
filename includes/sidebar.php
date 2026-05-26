<aside class="sidebar">
    <div>
        <h2>NeuroCode</h2>

        <div class="user-name">
            <?php echo htmlspecialchars($_SESSION["user_name"] ?? "Përdorues"); ?>,
            <?php echo htmlspecialchars($_SESSION["user_role"] ?? ""); ?>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="clients.php" class="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['clients.php','client-add.php','client-edit.php','client-delete.php']) ? 'active' : ''; ?>">Klientët</a></li>
                <li><a href="projects.php" class="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['projects.php','project-add.php','project-edit.php','project-delete.php']) ? 'active' : ''; ?>">Projektet</a></li>
                <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Kontakt</a></li>
            </ul>
        </nav>
    </div>

    <div class="sidebar-footer">
        <a href="logout.php" class="logout-btn">Dil</a>
    </div>
</aside>
