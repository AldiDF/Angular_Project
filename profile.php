<?php
    require "databases/connection.php";
    include "databases/query.php";

    $lagu = select_lagu($conn, "ACCEPT", $_GET["user"]);
    $akun = select_akun($conn, $_GET["user"]);
    $jumlah_lagu = count($lagu);
    $jumlah_follower = num_row($conn,"follow", "objek", $akun["username"]);
    $jumlah_following = num_row($conn, "follow", "subjek", $akun["username"]);
    $jumlah_like = total_like($conn, $akun["username"]);
    $isFollow = checkFollow($conn ,$akun["username"] ,$_SESSION["username"]);
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include("slide/settings.php")?>
    <?php include("slide/edit.php")?>
    <?php include("slide/user_music.php")?>
    <?php $akun = select_akun($conn, $_GET["user"]); ?>
    <?php include("slide/following_follower.php")?>
    <?php include("slide/chat.php")?>
    <?php include("slide/upload_content.php")?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>

    <?php $akun = select_akun($conn, $_GET["user"]); ?>
    <main>
        <div class="biography-container">
            <div class="biography-upper">
                <div class="profile-picture">
                    <?php if ($akun['foto'] == ""):?>
                        <i class="fa-regular fa-circle-user" style="font-size: 200px"></i>
                    <?php else: ?>
                        <img src="databases/profile_picture/<?php echo $akun['foto']?>" alt="profile-picture" class="picture">
                    <?php endif;?>
                </div>
                <div class="biography">
                    <h2><?php echo $akun['username']?></h2>
                    <h2><?php echo $akun['nama_lengkap']?></h2>
                    <h3><?php echo $akun['deskripsi']?></h3>
                </div>
            </div>
            <div class="biography-lower">
                <div class="follow-container">
                    <button class="button-follow" onclick="open_slide('following'), follow('following')">Mengikuti</button>
                    <p><?= $jumlah_following?></p>
                </div>
                <div class="mid-action">
                    <?php if ($akun["username"] == $_SESSION["username"]):?>
                        <button class="button-setting" onclick="open_slide('setting')">Pengaturan</button>
                    <?php else:?>
                        <button class="button-setting" onclick="open_slide('chat')">Pesan</button>
                        <?php if ($isFollow == 1):?>
                            <a href="databases/query.php?follow=false&objek=<?= $akun["username"]?>&subjek=<?= $_SESSION["username"]?>"><button class="button-setting">Berhenti</button></a>
                        <?php else:?>
                            <a href="databases/query.php?follow=true&objek=<?= $akun["username"]?>&subjek=<?= $_SESSION["username"]?>"><button class="button-setting">Ikuti</button></a>
                        <?php endif;?>
                    <?php endif;?>
                </div>
                <div class="follow-container">
                    <button class="button-follow" onclick="open_slide('following'), follow('follower')">Pengikut</button>
                    <p><?= $jumlah_follower?></p>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <div class="profile-content-container">
            <div class="total-owned">
                <div class="total-likes">
                    <i class="fa-solid fa-heart"></i>
                    <p><?= $jumlah_like . " Total Like"?></p>
                </div>
                <div class="total-content">
                    <p><?= $jumlah_lagu . " Total Lagu"?></p>
                    <i class="fa-solid fa-music total-content"></i>
                </div>
            </div>
            <div class="profile-content">
                <?php if ($akun["stats"] == "PRIVATE" && $akun["username"] != $_SESSION["username"]):?>
                    <p>Akun Ini Privat</p>
                <?php else:?>
                <p>Lagu yang diunggah</p>
                <?php $i = 0; foreach ($lagu as $lagu):?>
                    <?php $direktori = "databases/thumbnail/" . $lagu['thumbnail'];?>
                    <a href="detail.php?lagu=<?php echo $lagu['lagu'];?>">
                        <figure class="content-container">
                            <img src="<?php echo $direktori?>" alt="gambar-konten" class="thumbnail">
                            <figcaption class="caption-content">
                                <figure class="owner-content">
                                    <i class="fa-solid fa-circle-user" style="font-size: 36px"></i>
                                    <figcaption class="owner-name"><?php echo $lagu["user"]?></figcaption>
                                </figure>
                                <p><?php echo $lagu["judul"] ?></p>
                                <p><?php echo $lagu["deskripsi"]?></p>
                            </figcaption>
                        </figure>
                    </a>
                <?php $i++; endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </main>
    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>