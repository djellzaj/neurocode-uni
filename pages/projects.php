<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

$projectObj = new Project($conn);
$projects = $projectObj->getAllProjects();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Projektet - NeuroCode</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-top">
            <h2>NeuroCode</h2>
            <p class="user-name">
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?><br>
                <?php echo htmlspecialchars($_SESSION["user_role"]); ?>
            </p>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="clients.php">Klientët</a></li>
                <li><a href="projects.php" class="active">Projektet</a></li>
                <li><a href="project-add.php">Shto Projekt</a></li>
                <li><a href="logout.php">Dil</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-box">
            <h1>Lista e Projekteve</h1>
            <p>Projektet janë të lidhura me klientët dhe përdoruesit në databazë.</p>
            <a href="project-add.php" class="project-btn">Shto Projekt</a>
        </div>

        <div class="content-box">
            <table class="report-table">
                <tr>
                    <th>Titulli</th>
                    <th>Klienti</th>
                    <th>Përshkrimi</th>
                    <th>Afati</th>
                    <th>Statusi</th>
                    <th>Prioriteti</th>
                    <th>Buxheti</th>
                    <th>Fajlli</th>
                    <th>Krijuar nga</th>
                    <th>Veprime</th>
                </tr>

                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project["titulli"]); ?></td>
                        <td><?php echo htmlspecialchars($project["klienti_emri"]); ?></td>
                        <td><?php echo htmlspecialchars($project["pershkrimi"]); ?></td>
                        <td><?php echo htmlspecialchars($project["afati"]); ?></td>
                        <td><?php echo htmlspecialchars($project["statusi"]); ?></td>
                        <td><?php echo htmlspecialchars($project["prioriteti"]); ?></td>
                        <td><?php echo htmlspecialchars($project["buxheti"]); ?> €</td>
                        <td>
                            <?php if (!empty($project["fajlli"])): ?>
                                <a href="../<?php echo htmlspecialchars($project["fajlli"]); ?>" target="_blank">Hape</a>
                            <?php else: ?>
                                Pa fajll
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($project["krijuesi_emri"] ?? "N/A"); ?></td>
                        <td>
                            <a class="edit-btn" href="project-edit.php?id=<?php echo htmlspecialchars($project["id"]); ?>">Ndrysho</a>
                            <a class="delete-btn" href="project-delete.php?id=<?php echo htmlspecialchars($project["id"]); ?>"
                            onclick="return confirm('A je i sigurt që do ta fshish këtë projekt?');">
                            Fshij
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
</div>

</body>
</html>
