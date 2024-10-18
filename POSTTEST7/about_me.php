<?php
    session_start();

    $sesi_login = isset($_SESSION["login"]);
    $sesi_admin = isset($_SESSION["admin"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Me - Top Up Store</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/main-logo.jpg">
</head>
<body>
    <nav class="header-container" id="header">
        <div class="icon">
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <a href="index.php"><img src="assets/main-logo.jpg" class="title" alt="main-logo" width="50px" height="50px"></a>    
        </div>
        
        <menu class="header-list" id="head-list">
            <li>
                <a href="index.php"><button class="header-item">Home</button></a>
            </li>
            
            <li>
                <a href="about_me.php"><button class="header-item">About Me</button></a>
            </li>

            <li>
                <button class="dark-button" id="mode" onclick="mode()">Dark</button>
            </li>
            
        </menu>

        <a href='crud/logout_account.php' class="logout-button">
                <?php 
                    if (isset($_SESSION["admin"])){
                        echo "<img src='assets/admin_profile.png' alt='profile-picture' class='profile'>";

                    } else if (isset($_SESSION["login"])){
                         if ($account['profil'] == ''){
                            echo "<img src='assets/default.jpg' alt='profile-picture' class='profile'>";
                            
                        } else {
                            echo "<img src='$direktori' alt='profile-picture' class='profile'>";
                        }
                    } else {
                        echo "<a href='login.php' class='account' onchange=''>Login</a>";
                    }
                ?>
        </a>
    </nav>

    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
        <a href="index.php">Home</a>
        <a href="about_me.php">About Me</a>
        <a href="login.php">Login</a>
        <a href="contact.php">Contact</a>
        <?php
            if (isset($_SESSION["admin"])){
                echo "<a href='crud/history.php'>History</a>";
            }
        ?>
    </div>

    <main class="about-me-container">
        <h1 class="about-me-title">Tentang Webite Ini</h1>
        <p class="paragraph">
            Saya disini menyediakan layanan top-up game online terpercaya yang berdedikasi untuk memberikan pengalaman transaksi yang cepat, aman, dan nyaman. Dengan harga kompetitif dan berbagai metode pembayaran, saya hadir untuk memenuhi kebutuhan top-up Anda, dari game mobile hingga game PC.
        </p>
        <h2 class="about-me-title">Misi Saya</h2>
        <p class="paragraph">
            Misi saya disini memberikan kemudahan bagi setiap gamer untuk mengakses konten premium dalam game favorit mereka tanpa hambatan. Saya berkomitmen untuk menghadirkan layanan yang dapat diandalkan dengan harga yang bersahabat dan layanan pelanggan yang responsif.
        </p>
        <h2 class="about-me-title">Keunggulan Layanan</h2>
            <li class="paragraph">
                Proses top-up cepat dan aman
            </li>
            <li class="paragraph">
                Metode pembayaran lengkap dan mudah 
            </li>
            <li class="paragraph">
                Layanan pelanggan 24/7 
            </li>
            <li class="paragraph">
                Harga yang kompetitif
            </li>
        <h2 class="about-me-title">Keamanan dan Kepercayaan</h2>
        <p class="paragraph">
            Saya mengutamakan keamanan dalam setiap transaksi. Dengan menggunakan teknologi enkripsi terbaru dan bekerja sama dengan penyedia layanan pembayaran yang tepercaya, saya memastikan setiap transaksi Anda terlindungi.
        </p>
        <h2 class="about-me-title">Biodata</h2>
        <li class="paragraph">
            Aldi Daffa Arisyi
        </li>
        <li class="paragraph">
            2309106017
        </li>
        <li class="paragraph">
            A'23
        </li>
    </main>

    <footer id="footer">
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>

    <script>
        const session_admin = <?php echo json_encode($sesi_admin); ?>;
        const session_login = <?php echo json_encode($sesi_login); ?>;

        const marginlist = document.getElementById("head-list");

        if (session_admin){
            marginlist.style.marginLeft = "0"
            marginlist.style.marginRight = "36px"
        } else if (session_login){
            marginlist.style.marginLeft = "0"
            marginlist.style.marginRight = "36px"
        } else {
            marginlist.style.marginLeft = "180px"
        }
    </script>

    <script src="scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
