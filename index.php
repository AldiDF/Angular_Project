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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <style>
        .header-banner{
            width: 100%;
            height: 480px;
            background-size: cover;
            background: url("<?php if(isset($_SESSION["admin"])) {echo"assets/welcome.jpg";} else if (isset($_SESSION["user"])) {echo"assets/welcome.jpg";} else {echo"assets/join.jpg";}?>");
            background-size: cover;
            background-position: center;
            display: flex;
        }
    </style>
</head>
<body>
    <?php include("slide/signup.php")?>
    <?php include("slide/login.php")?>
    <?php if (isset($_SESSION["user"])):?>
        <?php include("slide/settings.php")?>
        <?php include("slide/edit.php")?>
        <?php include("slide/user_music.php")?>
    <?php endif;?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <main class="main-container" id="main">
        <section class="header-banner">
            <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) :?>
                <button class="button-banner" onclick="open_slide('signup')">Buat Akun</button>
            <?php endif;?>
        </section>
        
        <section class="list-content-container">
            <p>Rekomendasi Lagu</p>
            <?php for ($i = 1; $i < 4; $i++):?>
                <figure class="content-container">
                    <img src="assets/bag.png" alt="gambar-konten" class="thumbnail">
                    <figcaption class="caption-content">
                        <figure class="owner-content">
                            <i class="fa-solid fa-circle-user" style="font-size: 36px"></i>
                            <figcaption class="owner-name">Nama Akun</figcaption>
                        </figure>
                        <p>Judul</p>
                        <p>deskripsi</p>
                    </figcaption>
                </figure>
            <?php endfor;?>
        </section>
        <section class="footer-banner">
            <button class="button-banner">Upload Lagu</button>
        </section>
    </main>

    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>
