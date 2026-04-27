<?php include "../includes/header.php"; ?>
<?php include "../includes/nav.php"; ?>

<section class="home-hero">
    <div class="home-box">
        <h1>Mirë se vini në NeuroCode</h1>
        <p>
            NeuroCode është një aplikacion web universitar i ndërtuar me PHP.
            Në Fazën I përdoren të dhëna statike, sesione, cookies, validime,
            OOP dhe vargje për të simuluar funksionimin e një platforme për menaxhimin e projekteve.
        </p>

        <div class="home-buttons">
            <a href="login.php" class="btn-primary">Kyçu</a>
            <a href="contact.php" class="btn-secondary">Na Kontaktoni</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="feature-card">
        <h3>Login me role</h3>
        <p>Përdoruesit kyçen me të dhëna statike dhe kanë qasje sipas rolit admin ose përdorues.</p>
    </div>

    <div class="feature-card">
        <h3>OOP dhe vargje</h3>
        <p>Projektet menaxhohen përmes klasave, objekteve, vargjeve dhe sortimeve.</p>
    </div>

    <div class="feature-card">
        <h3>Validim dhe Cookies</h3>
        <p>Format kontrollohen me RegEx dhe përdoren cookies për personalizim.</p>
    </div>
</section>

<?php include "../includes/footer.php"; ?>
