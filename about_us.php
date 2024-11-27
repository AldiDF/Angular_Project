<?php
    require "databases/connection.php";
    include "databases/query.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if (isset($_SESSION["admin"])):?>
        <title>Tentang Kamin - ADMIN</title>
    <?php elseif(isset($_SESSION["user"])):?>
        <title>Tentang Kamin - <?php echo $_SESSION["username"]?></title>
    <?php else:?>
        <title>Tentang Kamin</title>
    <?php endif;?>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/login_signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/about_us.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/responsive.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</head>

<body>
    <?php include("slide/signup.php")?>
    <?php include("slide/login.php")?>
    <?php include("slide/upload_content.php")?>
    <?php if (isset($_SESSION["user"])):?>
        <?php include("slide/settings.php")?>
        <?php include("slide/edit.php")?>
        <?php include("slide/user_music.php")?>
        <?php include("slide/chat.php")?>
    <?php if (isset($_SESSION["admin"]))?>
        <?php include("slide/chat.php")?>
    <?php endif;?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <main class="about-us">
        <div class="description">
            <div class="hexasync-title">HexaSync</div>
            <p>HexaSync adalah platform media sosial yang dikhususkan untuk para pecinta musik, menawarkan ruang bagi pengguna untuk mengunggah lagu favorit, berbagi pendapat, serta berinteraksi dengan sesama penggemar musik. Dengan kemudahan fitur streaming lagu, HexaSync memungkinkan semua orang menikmati musik kapan saja dan di mana saja.</p>
            <p>Kami berkomitmen untuk menghubungkan orang-orang melalui bahasa universal musik, menciptakan komunitas yang inklusif dan aktif, di mana setiap anggota dapat saling berbagi lagu, berdiskusi, dan menemukan musik yang menginspirasi. Bergabunglah dengan kami di HexaSync, dan rasakan pengalaman musik yang lebih terhubung dan menyenangkan!</p>
        </div>
        <h2>Our Team</h2>
        <div class="team">
            <div class="team-member">
                <img src="assets/Aldi.jpg" alt="Team Member 1">
                <div class="name">Aldi Daffa Arisyi</div>
                <div class="nim">2309106017</div>
            </div>
            <div class="team-member">
                <img src="assets/indi.jpeg" alt="Team Member 2">
                <div class="name">Oktaria Indi Cahyani</div>
                <div class="nim">2309106015</div>
            </div>
            <div class="team-member">
                <img src="assets/bintang.jpeg" alt="Team Member 3">
                <div class="name">Putra Bintang Pratama</div>
                <div class="nim">2309106016</div>
            </div>
            <div class="team-member">
                <img src="assets/agil.jpg" alt="Team Member 4">
                <div class="name">M. Agill Firmansyah</div>
                <div class="nim">2309106018</div>
            </div>
            <div class="team-member">
                <img src="assets/Andika.jpeg" alt="Team Member 5">
                <div class="name">Andhika Gagahrani E.</div>
                <div class="nim">2309106034</div>
            </div>
        </div>
    </main>

    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>
