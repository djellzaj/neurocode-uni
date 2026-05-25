<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

$projectObj = new Project($conn);
$clients = $projectObj->getClients();

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klienti_id = (int) $_POST["klienti_id"];
    $titulli = htmlspecialchars(trim($_POST["titulli"]));
    $pershkrimi = htmlspecialchars(trim($_POST["pershkrimi"]));
    $afati = $_POST["afati"];
    $statusi = htmlspecialchars(trim($_POST["statusi"]));
    $prioriteti = htmlspecialchars(trim($_POST["prioriteti"]));
    $buxheti = (float) $_POST["buxheti"];

    $fajlli = "";

    if (!empty($_FILES["fajlli"]["name"])) {
        $allowedTypes = ["pdf", "jpg", "jpeg", "png", "doc", "docx"];
        $fileName = basename($_FILES["fajlli"]["name"]);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedTypes)) {
            $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $fileName);
            $targetPath = "../uploads/" . $newFileName;
            $dbPath = "uploads/" . $newFileName;

            if (move_uploaded_file($_FILES["fajlli"]["tmp_name"], $targetPath)) {
                $fajlli = $dbPath;
            } else {
                $error = "Ngarkimi i fajllit dështoi.";
            }
        } else {
            $error = "Ky tip fajlli nuk lejohet.";
        }
    }

    if (empty($error)) {
        try {
            $projectObj->addProject(
                $klienti_id,
                $titulli,
                $pershkrimi,
                $afati,
                $statusi,
                $prioriteti,
                $buxheti,
                $fajlli,
                $_SESSION["user_id"]
            );

            $message = "Projekti u shtua me sukses.";
        } catch (Exception $e) {
            $error = "Gabim gjatë shtimit të projektit.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Shto Projekt</title>
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
                <li><a href="project-add.php" class="active">Shto Projekt</a></li>
                <li><a href="logout.php">Dil</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="content-box">
            <h1>Shto Projekt</h1>

            <p style="color:green;"><?php echo htmlspecialchars($message); ?></p>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>

            <form method="POST" enctype="multipart/form-data" class="project-form">
                <div class="project-group">
                    <label>Klienti</label>
                    <select name="klienti_id" required>
                        <option value="">Zgjedh klientin</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?php echo $client["id"]; ?>">
                                <?php echo htmlspecialchars($client["emri"] . " - " . $client["kompania"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="project-group">
                    <label>Titulli</label>
                    <input type="text" name="titulli" required>
                </div>

                <div class="project-group">
                    <label>Përshkrimi</label>
                    <textarea name="pershkrimi"></textarea>
                </div>

                <div class="project-group">
                    <label>Afati</label>
                    <input type="date" name="afati" required>
                </div>

                <div class="project-group">
                    <label>Statusi</label>
                    <select name="statusi">
                        <option value="ne_pritje">Në pritje</option>
                        <option value="ne_proces">Në proces</option>
                        <option value="perfunduar">Përfunduar</option>
                    </select>
                </div>

                <div class="project-group">
                    <label>Prioriteti</label>
                    <select name="prioriteti">
                        <option value="ulet">I ulët</option>
                        <option value="mesem">Mesëm</option>
                        <option value="larte">I lartë</option>
                    </select>
                </div>

                <div class="project-group">
                    <label>Buxheti</label>
                    <input type="number" step="0.01" name="buxheti" required>
                </div>

                <div class="project-group">
                    <label>Fajlli i Projektit</label>
                    <input type="file" name="fajlli">
                </div>

                <button type="submit" class="project-btn">Ruaj Projektin</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>