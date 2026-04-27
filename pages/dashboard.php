<?php
include "../includes/auth.php";
include "../includes/project-data.php";
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - NeuroCode</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="dashboard-container">

<aside class="sidebar">
    <div>
        <h2>NeuroCode</h2>

        <div class="user-name">
            <?php echo $_SESSION["user_name"]; ?><br>
            <small><?php echo $_SESSION["user_role"]; ?></small>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="contact.php">Kontakt</a></li>
                <li><a href="index.php">Ballina</a></li>
            </ul>
        </nav>
    </div>

    <div class="sidebar-footer">
        <a href="logout.php" class="logout-btn">Dil</a>
    </div>
</aside>

    <main class="main-content">

        <div class="content-box">
            <h1>Mirë se erdhe, <?php echo $_SESSION["user_name"]; ?>!</h1>
            <p>Email: <?php echo $_SESSION["user_email"]; ?></p>
            <p>Roli: <?php echo $_SESSION["user_role"]; ?></p>
        </div>

        <div class="content-box">
            <?php if ($_SESSION["user_role"] == "admin"): ?>
                <h2>Paneli i Adminit</h2>
                <p>Admini ka qasje në menaxhimin e përdoruesve, projekteve dhe raporteve.</p>
            <?php else: ?>
                <h2>Paneli i Përdoruesit</h2>
                <p>Përdoruesi mund të shikojë projektet dhe informacionet bazë.</p>
            <?php endif; ?>
        </div>

       
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo countProjects($projects); ?></h3>
                <p>Totali i Projekteve</p>
            </div>

            <div class="stat-box">
                <h3><?php echo countCompleted($projects); ?></h3>
                <p>Të përfunduara</p>
            </div>

            <div class="stat-box">
                <h3><?php echo countInProgress($projects); ?></h3>
                <p>Në progres</p>
            </div>
        </div>

        <div class="content-box">
            <h2>Lista e Projekteve</h2>

            <table class="report-table">
                <tr>
                    <th>Titulli</th>
                    <th>Klienti</th>
                    <th>Afati</th>
                    <th>Statusi</th>
                    <th>Prioriteti</th>
                </tr>

                <?php foreach ($projects as $p) { ?>
                    <tr>
                        <td><?php echo $p->getTitle(); ?></td>
                        <td><?php echo $p->getClient(); ?></td>
                        <td><?php echo $p->getDeadline(); ?></td>
                        <td><?php echo $p->getStatus(); ?></td>
                        <td>
                            <?php
                            if ($p instanceof PriorityProject) {
                                echo $p->getPriority();
                            } else {
                                echo "Normal";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </main>
</div>

</body>
</html>
