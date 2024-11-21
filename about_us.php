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
        <title>Beranda - ADMIN</title>
    <?php elseif(isset($_SESSION["user"])):?>
        <title>Beranda - <?php echo $_SESSION["username"]?></title>
    <?php else:?>
        <title>Beranda</title>
    <?php endif;?>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/login_signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
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
        <h1>Tentang Kami</h1>
        <p>
            Selamat datang di HexaSync, 
            platform yang memudahkan Anda untuk mengunggah dan membagikan karya musik asli Anda. 
            Kami hadir untuk memberikan ruang bagi para musisi Indonesia agar dapat menunjukkan bakat dan kreativitas mereka kepada dunia. 
            Dengan antarmuka yang ramah pengguna dan fitur-fitur yang mendukung, kami berkomitmen untuk menjadi wadah bagi para pencipta musik dalam mengembangkan karya mereka serta menjangkau audiens yang lebih luas.
        </p>
        <img src="assets/logo.png" alt="logo" class="main-logo">
        <h1>Tentang Logo</h1>
        <p>
            Ikon bulat yang menyerupai vinyl record melambangkan musik dan suara, 
            sedangkan stylus turntable menambah konsep produksi musik, 
            membangkitkan perasaan kreativitas dan seni. 
            Skema warna hitam dan putih yang digunakan adalah klasik dan abadi, 
            mencerminkan elegansi dan kesederhanaan, 
            serta mewakili dualitas antara teknologi (hitam) dan kreativitas (putih). 
            Frasa "where technology meets melody" menangkap esensi perpaduan antara keahlian teknis dan ekspresi artistik, 
            menunjukkan ruang di mana teknologi inovatif (seperti Angular dalam pengembangan web) 
            dapat memperkaya atau berinteraksi dengan musik dan kreativitas. 
            Secara keseluruhan, gambar ini menyampaikan hubungan harmonis antara teknologi dan musik, 
            menekankan bagaimana kemajuan dalam teknologi dapat memperkaya pengalaman artistik dan sebaliknya.
        </p>
    </main>

    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>
