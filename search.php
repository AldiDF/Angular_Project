<?php
    require "databases/connection.php";
    include "databases/query.php";
    include "databases/liveSearch.php";

    $searchResult = searchResult($_GET["navbar-search"]);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include("slide/signup.php")?>
    <?php include("slide/login.php")?>
    <?php include("slide/upload_content.php")?>
    <?php if (isset($_SESSION["user"])):?>
        <?php include("slide/settings.php")?>
        <?php include("slide/edit.php")?>
        <?php include("slide/user_music.php")?>
        <?php include("slide/following_follower.php")?>
        <?php include("slide/chat.php")?>
    <?php if (isset($_SESSION["admin"]))?>
        <?php include("slide/chat.php")?>
    <?php endif;?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <main class="search-container">
        <p><?= "Hasil penelusuran terkait " . $_GET["navbar-search"]?></p>
        <?php foreach($searchResult as $result):?>
            <?php if (isset($result["thumbnail"])):?>
                <a href="detail.php?lagu=<?= $result['lagu']?>" class="content-container">
                    <img src="<?= "databases/thumbnail/" . $result["thumbnail"];?>" alt="gambar-konten" class="thumbnail">
                    <figcaption class="caption-content">
                        <figure class="owner-content">
                            <i class="fa-solid fa-circle-user" style="font-size: 36px"></i>
                            <figcaption class="owner-name"><?= $result["user"]?></figcaption>
                        </figure>
                        <p><?= $result["judul"]?></p>
                        <p><?= $result["deskripsi"]?></p>
                    </figcaption>
                </a>
            <?php else:?>
                <a href="profile.php?user=<?= $result['username']?>" class="account-container">
                    <i class="fa-solid fa-circle-user"></i>
                    <figcaption class="identifier-container">
                        <h1><?= $result["username"]?></h1>
                    </figcaption>
                </a>
            <?php endif;?>
        <?php endforeach;?>
    </main>

    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>
