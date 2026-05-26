<?php
include "../includes/auth.php";
require_once "../config/db.php";
require_once "../classes/Project.php";

$projectObj = new Project($conn);
$clients = $projectObj->getClients();

$id = $_GET["id"] ?? null;

if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    header("Location: projects.php");
    exit();
}

$id = (int) $id;
$project = $projectObj->getProjectById($id);

if (!$project) {
    echo "Projekti nuk u gjet.";
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klienti_id = (int) $_POST["klienti_id"];
    $titulli = trim($_POST["titulli"]);
    $pershkrimi = trim($_POST["pershkrimi"]);
    $afati = $_POST["afati"];
    $statusi = trim($_POST["statusi"]);
    $prioriteti = trim($_POST["prioriteti"]);
    $buxheti = (float) $_POST["buxheti"];

    $statuset = ["ne_pritje", "ne_proces", "perfunduar"];
    $prioritetet = ["ulet", "mesem", "larte"];

    if ($klienti_id <= 0) {
        $error = "Ju lutem zgjidhni një klient.";
    } elseif (empty($titulli)) {
        $error = "Titulli nuk mund të jetë i zbrazët.";
    } elseif (!in_array($statusi, $statuset)) {
        $error = "Statusi nuk është valid.";
    } elseif (!in_array($prioriteti, $prioritetet)) {
        $error = "Prioriteti nuk është valid.";
    } elseif ($buxheti < 0) {
        $error = "Buxheti nuk mund të jetë negativ.";
    }

    if (empty($error)) {
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
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndrysho Projekt</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="dashboard-container">
<?php include "../includes/sidebar.php"; ?>

    <main class="main-content">
        <div class="content-box">
            <h1>Ndrysho Projekt</h1>

            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>

            <form method="POST" class="project-form">
                <div class="project-group">
                    <label>Klienti</label>
                    <select name="klienti_id" required>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?php echo htmlspecialchars($client["id"]); ?>"
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
