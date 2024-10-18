<?php
    session_start();
    require "crud/connection.php";

    $sesi_login = isset($_SESSION["login"]);
    $sesi_admin = isset($_SESSION["admin"]);

    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql_select = mysqli_query($conn, "SELECT id, email, pasword FROM akun");

        if ($email == "ADMIN@gmail.com" && $password == "ADMIN#123"){
            $_SESSION["admin"] = true;
            echo "
                <script>
                    alert('Login Berhasil');
                    document.location.href = 'index.php';
                </script>
            ";

            exit;
        }

        $count = 0;
        while ($row = mysqli_fetch_assoc($sql_select)){
            $account[] = $row;
            if ($account[$count]["email"] == $email && password_verify($password, $account[$count]["pasword"])){
                $_SESSION["login"] = true;
                $_SESSION["email"] = $account[$count]["email"];
                echo "
                    <script>
                        alert('Login Berhasil');
                        document.location.href = 'index.php';
                    </script>
                ";

                exit;
                
            } 
            $count ++;
        }

        echo "
            <script>
                alert('Gagal Login, email atau password salah');
                document.location.href = 'login.php';
            </script>
        ";
        exit;
    }
?>

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

    <main class="login-container">
        <div class="box-login">
            <h3 class="login-title"><b>Login-Form</b></h3>
            <div class="box-form">
                <div class="box-mail">
                    <form action="" id="loginForm" method="post">
                        <label for="mail" style="font-size: 20px;"><b>Gmail:</b></label><br>
                        <input type="email" name="email" class="form-mail-login" id="mail" required><br><br><br>

                        <label for="pw" style="font-size: 20px;"><b>Password:</b></label><br>
                        <input type="password" name="password" class="form-mail-login" id="pw" required><br><br><br>
                        
                        <input type="submit" class="submit-login" name="submit" value="Login">
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
