<?php
    require "databases/connection.php";
    include "databases/query.php";

    $Recomendation = recomendation($conn);
    if (isset($_SESSION["username"])){
        $currentSession = select_akun($conn, $_SESSION["username"]);
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
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/login_signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/responsive.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <style>
        .header-banner {
            width: 100%;
            height: calc(100vh - 70px); /* Full height untuk viewport */
            overflow: hidden;
            position: relative;
        }

        .banner-slide {
            width: 100%;
            height: calc(100vh - 70px);
            background-size: cover;
            background-position: center;
            position: absolute; /* Supaya semua slide saling menumpuk */
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
        }

        .banner-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 1; /* Supaya yang aktif muncul di atas */
        }

        .footer-banner {
            width: 100%;
            height: calc(100vh - 57px); /* Full height untuk viewport */
            overflow: hidden;
            position: relative;
            margin-bottom: 0;
            padding: 0;
        }

        .footer-banner-slide {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: absolute; /* Supaya semua slide saling menumpuk */
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
        }

        .footer-banner-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 1; /* Supaya yang aktif terlihat di atas */
        }

    </style>
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
    <?php elseif (isset($_SESSION["admin"])):?>
        <?php include("slide/chat.php")?>
    <?php endif;?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <main class="main-container" id="main">
        <section class="header-banner">
            <div class="banner-slide" style="background-image: url('assets/welcome.jpg');">
                <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) :?>
                    <button class="button-banner" onclick="open_slide('signup')">Buat Akun</button>
                <?php endif;?>
            </div>
            <div class="banner-slide" style="background-image: url('assets/welcome2.jpg');">
                <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) :?>
                    <button class="button-banner" onclick="open_slide('signup')">Buat Akun</button>
                <?php endif;?>
            </div>
            <div class="banner-slide" style="background-image: url('assets/welcome3.jpg');">
                <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) :?>
                    <button class="button-banner" onclick="open_slide('signup')">Buat Akun</button>
                <?php endif;?>
            </div>
            <div class="banner-slide" style="background-image: url('assets/welcome4.jpg');">
                <?php if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) :?>
                    <button class="button-banner" onclick="open_slide('signup')">Buat Akun</button>
                <?php endif;?>
            </div>
        </section>
        
        <p class="recomend">Dengarkan apa yang sedang tren secara gratis di komunitas HexaSync</p>
        <section class="list-content-container">        
            <?php $i = 0; foreach ($Recomendation as $rec):?>
                <?php
                    $filename = $rec['lagu'];
                    preg_match('/\d{4}-\d{2}-\d{2} \d{2}\.\d{2}\.\d{2}/', $filename, $matches);
                        // Format ulang menjadi hh:mm:ss
                    $time = str_replace('.', ':', $matches[0]);
                ?>
                <?php $foto_akun = select_akun($conn, $rec['user'])?>
                    <a href="detail.php?lagu=<?php echo $rec['lagu'];?>">
                        <div class="content-container">
                            <img src="<?= "databases/thumbnail/" . $rec["thumbnail"];?>" alt="gambar-konten" class="thumbnail">
                            <figcaption class="caption-content">
                                <figure class="owner-content">
                                <?php if ($foto_akun["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $foto_akun["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                                    <figcaption class="owner-name"><?php echo $rec["user"]?></figcaption>
                                </figure>
                                <div class="info-caption">
                                    <?php $jdl = overflow($rec["judul"], 25);?>
                                    <?php $desk = overflow($rec["deskripsi"], 36);?>
                                    <p id="text-overflow"><?php echo $jdl ?></p>
                                    <p id="text-overflow"><?php echo $desk?></p>
                                </div>
                                <p class="time-up"><?= timeAgo($time)?></p>
                            </figcaption>
                        </div>
                    </a>
                <?php $i++; endforeach;?>
        </section>
        <section class="footer-banner">
            <div class="footer-banner-slide" style="background-image: url('assets/p.jpg');">
                <?php if (!isset($_SESSION["admin"])) :?>
                    <button class="button-banner" onclick="open_slide('upload')">Upload Lagu</button>
                <?php endif;?>
            </div>
            <div class="footer-banner-slide" style="background-image: url('assets/p1.jpg');">
                <?php if (!isset($_SESSION["admin"])) :?>
                    <button class="button-banner" onclick="open_slide('upload')">Upload Lagu</button>
                <?php endif;?>
            </div>
        </section>
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

    <script>
        let currentSlide = 0; // Awal slide
        const slides = document.querySelectorAll('.banner-slide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.add('active'); // Tampilkan slide aktif
                } else {
                    slide.classList.remove('active'); // Sembunyikan slide lainnya
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length; // Loop ke slide berikutnya
            showSlide(currentSlide);
        }

        // Tampilkan slide pertama
        showSlide(currentSlide);

        // Ganti slide setiap 5 detik
        setInterval(nextSlide, 5000);

    </script>

    <script>
        let currentFooterSlide = 0; // Mulai dari slide pertama
        const footerSlides = document.querySelectorAll('.footer-banner-slide');

        function showFooterSlide(index) {
            footerSlides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.add('active'); // Tampilkan slide aktif
                } else {
                    slide.classList.remove('active'); // Sembunyikan slide lainnya
                }
            });
        }

        function nextFooterSlide() {
            currentFooterSlide = (currentFooterSlide + 1) % footerSlides.length; // Loop ke slide berikutnya
            showFooterSlide(currentFooterSlide);
        }

        // Tampilkan slide pertama
        showFooterSlide(currentFooterSlide);

        // Ganti slide setiap 5 detik
        setInterval(nextFooterSlide, 5000);
    </script>
</body>
</html>
