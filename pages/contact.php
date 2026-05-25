<?php
include "../includes/header.php";
require_once "../config/db.php";

$name = "";
$email = "";
$phone = "";
$message = "";

$nameError = "";
$emailError = "";
$phoneError = "";
$messageError = "";
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    if (empty($name)) {
        $nameError = "Emri kerkohet.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError = "Emri duhet te permbaje vetem shkronja";
    }

    if (empty($email)) {
        $emailError = "Email-i kerkohet.";
    } elseif (!preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email)) {
        $emailError = "Formati i email-it nuk eshte i sakte.";
    }

    if (empty($phone)) {
        $phoneError = "Numri i telefonit kerkohet.";
    } elseif (!preg_match("/^[0-9]{9}$/", $phone)) {
        $phoneError = "Telefoni duhet ti kete 9 shifra.";
    }

    if (empty($message)) {
        $messageError = "Mesazhi kerkohet.";
    }

    if (empty($nameError) && empty($emailError) && empty($phoneError) && empty($messageError)) {
          try {
            $stmt = $conn->prepare("
                INSERT INTO mesazhet (emri, email, mesazhi)
                VALUES (?, ?, ?)
            ");

            $stmt->execute([$name, $email, $message]);

        setcookie("visitor_name", $name, time() + 3600, "/");
        setcookie("visitor_email", $email, time() + 3600, "/");

        $successMessage = "Mesazhi u dergua me sukses!";
    } catch (Exception $e) {
            $errorMessage = "Gabim gjate ruajtjes se mesazhit.";
        }
}
}
?>

<div class="dashboard-container">
    <aside class="sidebar">
        <div>
            <h2>NeuroCode</h2>

            <div class="user-name">
                <?php
                if (isset($_COOKIE["visitor_name"])) {
                    echo "Mirë se u ktheve, " . htmlspecialchars($_COOKIE["visitor_name"]);
                } else {
                    echo "Faqja e kontaktit";
                }
                ?>
            </div>

            <nav class="sidebar-menu">
                <ul>
                    <li><a href="index.php">Ballina</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="contact.php" class="active">Kontakt</a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="main-content">
        <div class="content-box">
            <h1>Na kontaktoni</h1>

            <?php if (!empty($successMessage)) { ?>
                <p style="color: green;"><?php echo htmlspecialchars($successMessage); ?></p>
            <?php } ?>
            <?php if (!empty($errorMessage)) { ?>
    <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
<?php } ?>

            <form method="POST" class="project-form">

                <div class="project-group">
                    <label>Emri dhe Mbiemri</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <small style="color:red;"><?php echo htmlspecialchars($nameError); ?></small>
                </div>

                <div class="project-group">
                    <label>Email-i</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <small style="color:red;"><?php echo htmlspecialchars($emailError); ?></small>
                </div>

                <div class="project-group">
                    <label>Telefoni</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    <small style="color:red;"><?php echo htmlspecialchars($phoneError); ?></small>
                </div>

                <div class="project-group">
                    <label>Mesazhi</label>
                    <textarea name="message"><?php echo htmlspecialchars($message); ?></textarea>
                    <small style="color:red;"><?php echo htmlspecialchars($messageError); ?></small>
                </div>

                <button type="submit" class="project-btn">Dergo mesazhin</button>

            </form>
        </div>
    </main>
</div>
