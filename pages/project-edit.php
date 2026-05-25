<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

$projectObj = new Project($conn);
$clients = $projectObj->getClients();

if (!isset($_GET["id"])) {
    header("Location: projects.php");
    exit();
}

$id = (int) $_GET["id"];
$project = $projectObj->getProjectById($id);

if (!$project) {
    echo "Projekti nuk u gjet.";
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klienti_id = (int) $_POST["klienti_id"];
    $titulli = htmlspecialchars(trim($_POST["titulli"]));
    $pershkrimi = htmlspecialchars(trim($_POST["pershkrimi"]));
    $afati = $_POST["afati"];
    $statusi = htmlspecialchars(trim($_POST["statusi"]));
    $prioriteti = htmlspecialchars(trim($_POST["prioriteti"]));
    $buxheti = (float) $_POST["buxheti"];

    try {
        $projectObj->updateProject(
            $id,
            $klienti_id,
            $titulli,
            $pershkrimi,
            $afati,
            $statusi,
            $prioriteti,
            $buxheti
        );

        header("Location: projects.php");
        exit();
    } catch (Exception $e) {
        $error = "Përditësimi dështoi.";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edit Projekt</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-top">
            <h2>NeuroCode</h2>
            <p class="user-name"><?php echo htmlspecialchars($_SESSION["user_name"]); ?></p>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="projects.php">Projektet</a></li>
                <li><a href="logout.php">Dil</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-box">
            <h1>Edit Projekt</h1>

            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>

            <form method="POST" class="project-form">
                <div class="project-group">
                    <label>Klienti</label>
                    <select name="klienti_id" required>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?php echo $client["id"]; ?>"
                                <?php if ($project["klienti_id"] == $client["id"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($client["emri"] . " - " . $client["kompania"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="project-group">
                    <label>Titulli</label>
                    <input type="text" name="titulli" value="<?php echo htmlspecialchars($project["titulli"]); ?>" required>
                </div>

                <div class="project-group">
                    <label>Përshkrimi</label>
                    <textarea name="pershkrimi"><?php echo htmlspecialchars($project["pershkrimi"]); ?></textarea>
                </div>

                <div class="project-group">
                    <label>Afati</label>
                    <input type="date" name="afati" value="<?php echo htmlspecialchars($project["afati"]); ?>" required>
                </div>

                <div class="project-group">
                    <label>Statusi</label>
                    <select name="statusi">
                        <option value="ne_pritje" <?php if ($project["statusi"] == "ne_pritje") echo "selected"; ?>>Në pritje</option>
                        <option value="ne_proces" <?php if ($project["statusi"] == "ne_proces") echo "selected"; ?>>Në proces</option>
                        <option value="perfunduar" <?php if ($project["statusi"] == "perfunduar") echo "selected"; ?>>Përfunduar</option>
                    </select>
                </div>

                <div class="project-group">
                    <label>Prioriteti</label>
                    <select name="prioriteti">
                        <option value="ulet" <?php if ($project["prioriteti"] == "ulet") echo "selected"; ?>>I ulët</option>
                        <option value="mesem" <?php if ($project["prioriteti"] == "mesem") echo "selected"; ?>>Mesëm</option>
                        <option value="larte" <?php if ($project["prioriteti"] == "larte") echo "selected"; ?>>I lartë</option>
                    </select>
                </div>

                <div class="project-group">
                    <label>Buxheti</label>
                    <input type="number" step="0.01" name="buxheti" value="<?php echo htmlspecialchars($project["buxheti"]); ?>" required>
                </div>

                <button type="submit" class="project-btn">Përditëso Projektin</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>