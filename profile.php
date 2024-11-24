<?php
    require "databases/connection.php";
    include "databases/query.php";
    
    $profile = $_GET["user"];
    if (isset($_GET["user"])){
        if (isset($_SESSION["username"])){
            $lagu = select_lagu($conn, "ACCEPT", $_GET["user"]);
            $akun = select_akun($conn, $_GET["user"]);
            $jumlah_lagu = count($lagu);
            $jumlah_follower = num_row($conn,"follow", "objek", $akun["username"]);
            $jumlah_following = num_row($conn, "follow", "subjek", $akun["username"]);
            $jumlah_like = total_like($conn, $akun["username"]);
            $isFollow = checkFollow($conn ,$akun["username"] ,$_SESSION["username"]);    
            $_SESSION["profile"] = $akun["username"];
        } else {
            $lagu = select_lagu($conn, "ACCEPT", $_GET["user"]);
            $akun = select_akun($conn, $_GET["user"]);
            $jumlah_lagu = count($lagu);
            $jumlah_follower = num_row($conn,"follow", "objek", $akun["username"]);
            $jumlah_following = num_row($conn, "follow", "subjek", $akun["username"]);
            $jumlah_like = total_like($conn, $akun["username"]);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - <?php echo $akun["username"];?></title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php if (isset($_SESSION["username"])):?>
    <?php include("slide/settings.php")?>
    <?php include("slide/user_music.php")?>
    <?php include("slide/edit.php")?>
    <?php $akun = select_akun($conn, $_GET["user"]); ?>
    <?php include("slide/following_follower.php")?>
    <?php include("slide/upload_content.php")?>
    <?php include("slide/chat.php")?>
    <?php else:?>
        <?php include("slide/chat.php")?>
        <?php include("slide/following_follower.php")?>    
    <?php endif;?>
        <?php include("navfooter/sidebar.php")?>
        <?php include("navfooter/navbar.php")?>

    <?php $akun = select_akun($conn, $_GET["user"]); ?>
    <?php $lagu = select_lagu($conn, "ACCEPT", $_GET["user"]); ?>
    <main>
        <div class="biography-container">
            <div class="biography-upper">
                <div class="profile-picture">
                    <?php if ($akun['foto'] == ""):?>
                        <img src="assets/default.jpg" alt="profile-picture" class="picture">
                    <?php else: ?>
                        <img src="databases/profile/<?php echo $akun['foto']?>" alt="profile-picture" class="picture">
                    <?php endif;?>
                    <div class="biography">
                        <h2><?php echo $akun['username']?></h2>
                        <h2><?php echo $akun['nama_lengkap']?></h2>
                        <h3><?php echo $akun['deskripsi']?></h3>
                    </div>
                </div>

                <div class="action-follow">
                    <div class="follow-container">
                        <button class="button-follow" onclick="open_slide('following'), follow('following')"><?= '<i class="fa-solid fa-user"></i>'. $jumlah_following . " diikuti"?></button>
                        <button class="button-follow" onclick="open_slide('following'), follow('follower')"><?= '<i class="fa-solid fa-user"></i>' . $jumlah_follower . " pengikut"?></button>
                    </div>
                    <?php if (isset($_SESSION["user"])):?>
                        <?php if($akun["username"] != $_SESSION["username"]):?>
                            <?php if ($isFollow == 1):?>
                                <a href="databases/query.php?follow=false&objek=<?= $akun["username"]?>&subjek=<?= $_SESSION["username"]?>"><button class="action-follow-btn">Berhenti Mengikuti</button></a>
                            <?php else:?>
                                <a href="databases/query.php?follow=true&objek=<?= $akun["username"]?>&subjek=<?= $_SESSION["username"]?>"><button class="action-follow-btn">Ikuti</button></a>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
            <div class="biography-lower">
                <div class="total-likes">
                    <i class="fa-solid fa-heart"></i>
                    <p><?= $jumlah_like . " Total Like"?></p>
                </div>
                <div class="total-content">
                    <i class="fa-solid fa-music total-content"></i>
                    <p><?= $jumlah_lagu . " Total lagu yang diunggah"?></p>
                </div>
                <div class="mid-action">
                    <?php if (isset($_SESSION["user"])):?>
                        <?php if ($akun["username"] == $_SESSION["username"]):?>
                            <button class="button-setting" onclick="open_slide('setting')">
                                <i class="fa-solid fa-gear"></i>
                                <p>Pengaturan</p>
                            </button>
                        <?php else:?>
                            <button class="button-setting" id="chat_<?= $akun["username"]?>" onclick="open_slide('chat')">
                                <i class="fa-solid fa-message"></i>
                                <p>Kirim Pesan</p>
                            </button>
                        <?php endif;?>
                    <?php else:?>
                        <button class="button-setting" id="chat_<?= $akun["username"]?>" onclick="open_slide('chat')">
                            <i class="fa-solid fa-message"></i>
                            <p>Kirim Pesan</p>
                        </button>
                    <?php endif;?>

                </div>
            </div>
        </div>
        <div class="profile-content-container">
            <?php if ($akun["stats"] == "PRIVATE" && $akun["username"] != $_SESSION["username"]):?>
                    <p>Akun Ini Privat</p>
            <?php else:?>
            <div class="profile-content">
                <?php $i = 0; foreach ($lagu as $lagu):?>
                    <?php
                        $filename = $lagu['lagu'];
                        preg_match('/\d{4}-\d{2}-\d{2} \d{2}\.\d{2}\.\d{2}/', $filename, $matches);
                            // Format ulang menjadi hh:mm:ss
                        $time = str_replace('.', ':', $matches[0]);
                    ?>
                    <?php $direktori = "databases/thumbnail/" . $lagu['thumbnail'];?>
                    <a href="detail.php?lagu=<?php echo $lagu['lagu'];?>">
                        <div class="content-container">
                            <img src="<?php echo $direktori?>" alt="gambar-konten" class="thumbnail">
                            <figcaption class="caption-content">
                                <figure class="owner-content">
                                    <?php if ($currentSession["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $currentSession["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                                    <figcaption class="owner-name"><?php echo $lagu["user"]?></figcaption>
                                </figure>
                                <div class="info-caption">
                                    <p id="text-overflow"><?php echo $lagu["judul"] ?></p>
                                    <p id="text-overflow"><?php echo $lagu["deskripsi"]?></p>
                                </div>
                                <p class="time-up"><?= timeAgo($time)?></p>
                            </figcaption>
                        </div>
                    </a>
                <?php $i++; endforeach;?>
            </div>
            <?php endif;?>
        </div>
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
        overflow("#text-overflow", 36);
    </script>
    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>