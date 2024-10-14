<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Top Up Store</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/main-logo.jpg">
</head>
<body>
    <nav class="header-container">
        <div class="icon">
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <a href="index.php"><img src="assets/main-logo.jpg" class="title" alt="main-logo" width="50px" height="50px"></a>    
        </div>
        
        <menu class="header-list">
            <li>
                <button class="header-item"><a href="index.php">Home</a></button>
            </li>
            
            <li>
                <button class="header-item"><a href="about_me.php">About Me</a></button>
            </li>

            <li>
                <button class="dark-button" id="mode" onclick="mode()">Dark</button>
            </li>
            
        </menu>
        <a href="login.php" class="account">Login</a>
    </nav>

    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
        <a href="index.php">Home</a>
        <a href="about_me.php">About Me</a>
        <a href="login.php">Login</a>
        <a href="contact.php">Contact</a>
        <a href="crud/history.php">History</a>
    </div>

    <main>
        <h2 style="transition: 0.5s;">Selamat Datang</h2>
        <p style="transition: 0.5s;">Top-Up In-Game Terpercaya</p><br><br>
        <h3 style="transition: 0.5s;"><u>Pilih Game Seluler</u></h3>
        
        <div class="main-container">
            <div class="game-container">
                <img src="assets/mlbb-logo.png" alt="mlbb-logo" class="game" width="100px" height="100px">
                <p style="text-align: center; font-size: 10px;">Moonton</p>
                <p style="text-align: center;">Mobile Legends: <br>Bang Bang</p>
                <a href="topup/topupmlbb.php"><button class="top-up-button">Top Up</button></a>

            </div>
            <div class="game-container">
                <img src="assets/ff-logo.png" alt="ff-logo" class="game" width="100px" height="100px">
                <p style="text-align: center; font-size: 10px;">Garena</p>
                <p style="text-align: center;">Free Fire <p style="color: transparent; font-size: 2px;">p</p></p>
                <a href="topup/topupff.php"><button class="top-up-button">Top-Up</button></a>
                
            </div>
            <div class="game-container">
                <img src="assets/mla-logo.png" alt="mla-logo" class="game" width="100px" height="100px">
                <p style="text-align: center; font-size: 10px;">Moonton</p>
                <p style="text-align: center;">Mobile Legends: <br>Adventure</p>
                <a href="topup/topupmla.php"><button class="top-up-button">Top Up</button></a>
                
            </div>
            <div class="game-container">
                <img src="assets/pubg-logo.png" alt="pubg-logo" class="game" width="100px" height="100px">
                <p style="text-align: center; font-size: 10px;">Tencent</p>
                <p style="text-align: center;">PUBG Mobile <br> (Global)</p>
                <a href="topup/topuppubg.php"><button class="top-up-button">Top Up</button></a>
            </div>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>

    <script src="scripts/scripts.js"></script>
</body>
</html>
