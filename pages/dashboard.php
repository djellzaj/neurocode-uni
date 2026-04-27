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
        <div class="sidebar-top">
            <h2>NeuroCode</h2>
            <p class="user-name">
                <?php echo $_SESSION["user_name"]; ?><br>
                <?php echo $_SESSION["user_role"]; ?>
            </p>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php">Dil</a></li>
            </ul>
        </nav>
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
                <p>Total Projects</p>
            </div>

            <div class="stat-box">
                <h3><?php echo countCompleted($projects); ?></h3>
                <p>Completed</p>
            </div>

            <div class="stat-box">
                <h3><?php echo countInProgress($projects); ?></h3>
                <p>In Progress</p>
            </div>
        </div>

        <div class="content-box">
            <h2>Lista e Projekteve</h2>

            <table class="report-table">
                <tr>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Priority</th>
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