<?php
require_once "../includes/auth.php";
require_once "../config/db.php";

$totalProjects = 0;
$completedProjects = 0;
$inProgressProjects = 0;
$totalClients = 0;

try {
    $stmt = $conn->query("SELECT COUNT(*) FROM projektet");
    $totalProjects = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM projektet WHERE statusi = ?");
    $stmt->execute(["perfunduar"]);
    $completedProjects = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM projektet WHERE statusi = ?");
    $stmt->execute(["ne_proces"]);
    $inProgressProjects = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM klientet");
    $totalClients = $stmt->fetchColumn();

    $stmt = $conn->query("
        SELECT 
            projektet.titulli,
            klientet.emri AS klienti_emri,
            projektet.afati,
            projektet.statusi,
            projektet.prioriteti
        FROM projektet
        LEFT JOIN klientet ON projektet.klienti_id = klientet.id
        ORDER BY projektet.id DESC
        LIMIT 5
    ");
    $latestProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $latestProjects = [];
}
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
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?><br>
                <small><?php echo htmlspecialchars($_SESSION["user_role"]); ?></small>
            </div>

            <nav class="sidebar-menu">
                <ul>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="clients.php">Klientët</a></li>
                    <li><a href="projects.php">Projektet</a></li>
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
            <h1>Mirë se erdhe, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!</h1>
            <p>Email: <?php echo htmlspecialchars($_SESSION["user_email"]); ?></p>
            <p>Roli: <?php echo htmlspecialchars($_SESSION["user_role"]); ?></p>
        </div>

        <div class="content-box">
            <?php if ($_SESSION["user_role"] == "admin"): ?>
                <h2>Paneli i Adminit</h2>
                <p>Admini ka qasje në menaxhimin e klientëve, projekteve dhe mesazheve.</p>
            <?php else: ?>
                <h2>Paneli i Përdoruesit</h2>
                <p>Përdoruesi mund të shikojë projektet dhe informacionet bazë.</p>
            <?php endif; ?>
        </div>

        <div class="stats">
            <div class="stat-box">
                <h3><?php echo htmlspecialchars($totalProjects); ?></h3>
                <p>Totali i Projekteve</p>
            </div>

            <div class="stat-box">
                <h3><?php echo htmlspecialchars($completedProjects); ?></h3>
                <p>Të përfunduara</p>
            </div>

            <div class="stat-box">
                <h3><?php echo htmlspecialchars($inProgressProjects); ?></h3>
                <p>Në proces</p>
            </div>

            <div class="stat-box">
                <h3><?php echo htmlspecialchars($totalClients); ?></h3>
                <p>Klientë</p>
            </div>
        </div>

        <div class="content-box">
            <h2>Projektet e fundit</h2>

            <table class="report-table">
                <tr>
                    <th>Titulli</th>
                    <th>Klienti</th>
                    <th>Afati</th>
                    <th>Statusi</th>
                    <th>Prioriteti</th>
                </tr>

                <?php if (count($latestProjects) > 0): ?>
                    <?php foreach ($latestProjects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project["titulli"]); ?></td>
                            <td><?php echo htmlspecialchars($project["klienti_emri"] ?? "Pa klient"); ?></td>
                            <td><?php echo htmlspecialchars($project["afati"]); ?></td>
                            <td><?php echo htmlspecialchars($project["statusi"]); ?></td>
                            <td><?php echo htmlspecialchars($project["prioriteti"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Nuk ka projekte të regjistruara.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

    </main>

</div>

</body>
</html>
