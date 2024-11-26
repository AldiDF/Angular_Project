<?php
    require "databases/connection.php";
    include "databases/liveSearch.php";

    if (!isset($_GET["navbar-search"])) {
        header('Location: index.php'); 
        exit;
    }

    if (isset($_GET["navbar-search"])){
        if ($_GET["navbar-search"] == ""){
            header("Location: index.php");
        } else {
            $searchResult = searchResult($_GET["navbar-search"]);
        }
    }

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
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
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
        <?php include("slide/user_music.php")?>
        <?php include("slide/edit.php")?>
        <?php include("slide/chat.php")?>
    <?php if (isset($_SESSION["admin"]))?>
        <?php include("slide/chat.php")?>
    <?php endif;?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <p class="search-nav-result"><?= "Hasil penelusuran terkait " . $_GET["navbar-search"]?></p>
    <main class="search-container">
        <?php foreach($searchResult as $result):?>
            <?php if (isset($result["thumbnail"])):?>
                <?php
                    $akun_search = select_akun($conn, $result["user"]);                
                    $filename = $result['lagu'];
                    preg_match('/\d{4}-\d{2}-\d{2} \d{2}\.\d{2}\.\d{2}/', $filename, $matches);
                        // Format ulang menjadi hh:mm:ss
                    $time = str_replace('.', ':', $matches[0]);
                ?>
                <a href="detail.php?lagu=<?php echo $result['lagu'];?>">
                        <div class="content-container">
                            <img src="<?= "databases/thumbnail/" . $result["thumbnail"];?>" alt="gambar-konten" class="thumbnail">
                            <figcaption class="caption-content">
                                <figure class="owner-content">
                                <?php if ($akun_search["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akun_search["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                                    <figcaption class="owner-name"><?php echo $result["user"]?></figcaption>
                                </figure>
                                <div class="info-caption">
                                    <?php $jdl = overflow($result["judul"], 25);?>
                                    <?php $desk = overflow($result["deskripsi"], 36);?>
                                    <p id="text-overflow"><?php echo $jdl ?></p>
                                    <p id="text-overflow"><?php echo $desk?></p>
                                </div>
                                <p class="time-up"><?= timeAgo($time)?></p>
                            </figcaption>
                        </div>
                    </a>
            <?php else:?>
                <a href="profile.php?user=<?= $result['username']?>" class="account-container">
                <?php if ($result["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $result["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                    <figcaption class="identifier-container">
                        <h1><?= $result["username"]?></h1>
                        <h2 id="fullname"><?= $result["nama_lengkap"]?></h2>
                    </figcaption>
                </a>
            <?php endif;?>
        <?php endforeach;?>
    </main>

    <?php include("navfooter/footer.php")?>

    <script>
        function overflow(selector, maxLength) {
            const elements = document.querySelectorAll(selector);
            elements.forEach((element) => {
            const text = element.textContent;
                if (text.length > maxLength) {
                    element.textContent = text.substring(0, maxLength) + "...";
                }
            });
        }
        overflow("#fullname", 20);
    </script>
    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>
