<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Top Up Store</title>
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

    <main class="login-container">
        <div class="box-login">
            <h3 class="login-title"><b>Login-Form</b></h3>
            <div class="box-form">
                <div class="box-mail">
                    
                    <form action="/submit" id="loginForm">
                        <label for="gmail" style="font-size: 20px;"><b>Gmail:</b></label><br>
                        <input type="email" name="email" class="form-mail-login" id="mail" required><br><br><br>

                        <label for="password" style="font-size: 20px;"><b>Password:</b></label><br>
                        <input type="password" name="password" class="form-mail-login" id="pw" required><br><br><br>
                        
                        <input type="submit" class="submit-login" value="Login">
                    </form>
                </div>
                <a href="crud/register.php">
                    <button class="register-button">
                        Register
                    </button>
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
