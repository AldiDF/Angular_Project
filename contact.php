<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact - Top Up Store</title>
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
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">Home</a>
        <a href="about_me.php">About Me</a>
        <a href="login.php">Login</a>
        <a href="contact.php">Contact</a>
        <a href="crud/history.php">History</a>
    </div>

    <main>
        <h3 style="transition: 0.5s;"><u>Contact Me</u></h3>
        <div class="contact-container">
            <div class="contact-box">
                <a href="https://wa.me/+6281294702230" target="_blank">
                    <img src="assets/whatapp.png" alt="whatapp" class="contact-logo" width="200px" height="200px">
                </a>
            </div>
            <div class="contact-box">
                <a href="mailto:aldidaffaarisyi@gmail.com" target="_blank">
                    <img src="assets/email.png" alt="email" class="contact-logo" width="200px" height="200px">
                </a>
            </div>
            <div class="contact-box">
                <a href="https://www.instagram.com/aldidaffaa" target="_blank">
                    <img src="assets/instagram.png" alt="instagram" class="contact-logo" width="200px" height="200px">
                </a>
            </div>
            <div class="contact-box">
                <a href="https://www.youtube.com/@aldidaffaarisyi1869" target="_blank">
                    <img src="assets/youtube.png" alt="youtube" class="contact-logo" width="200px" height="200px">
                </a>
            </div>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>

    <script src="scripts/scripts.js"></script>
</body>
</html>
