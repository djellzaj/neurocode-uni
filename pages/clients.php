<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION["user_role"] != "admin") {
    die("Qasje e ndaluar");
}

// SEARCH / FILTER
$search = trim($_GET["search"] ?? "");

if ($search != "") {
    $stmt = $conn->prepare("
        SELECT * FROM klientet 
        WHERE emri LIKE ? 
        OR email LIKE ? 
        OR kompania LIKE ?
        ORDER BY id DESC
    ");
    $stmt->execute(["%$search%", "%$search%", "%$search%"]);
    $klientet = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->query("SELECT * FROM klientet ORDER BY id DESC");
    $klientet = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include("../includes/header.php"); ?>

<div class="main-content">

    <div class="clients-header">
        <h2>Klientët</h2>
        <a href="clients-add.php">+ Shto Klient</a>
    </div>

    <!-- 🔍 SEARCH FILTER -->
    <form method="GET" style="margin-bottom: 15px;">
        <input 
            type="text" 
            name="search" 
            placeholder="Kërko sipas emrit, email ose kompanisë..."
            value="<?= htmlspecialchars($search) ?>"
        >
        <button type="submit">Kërko</button>
    </form>

    <table class="clients-table">
        <tr>
            <th>Emri</th>
            <th>Email</th>
            <th>Nr.Tel</th>
            <th>Kompania</th>
            <th>Veprimet</th>
        </tr>

        <?php if (count($klientet) > 0) { ?>
            <?php foreach ($klientet as $k) { ?>
                <tr>
                    <td><?= htmlspecialchars($k["emri"]) ?></td>
                    <td><?= htmlspecialchars($k["email"]) ?></td>
                    <td><?= htmlspecialchars($k["telefoni"]) ?></td>
                    <td><?= htmlspecialchars($k["kompania"]) ?></td>
                    <td>
                        <a class="action-btn edit-btn" href="clients-edit.php?id=<?= $k["id"] ?>">Ndrysho</a>
                        <a class="action-btn delete-btn" href="clients-delete.php?id=<?= $k["id"] ?>" onclick="return confirm('A jeni i sigurt?')">Fshij</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5" style="text-align:center;">Nuk u gjet asnjë klient</td>
            </tr>
        <?php } ?>
    </table>

</div>

<?php include("../includes/footer.php"); ?>