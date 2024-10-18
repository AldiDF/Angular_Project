<?php
    session_start();
    require "connection.php";

    $email;
    $account;
    $direktori;
    if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $sql_select = mysqli_query($conn, "SELECT * FROM akun WHERE email='$email'");
        $account = mysqli_fetch_assoc($sql_select);
        $direktori = "saves/" . $account["profil"];
    }

    if (isset($_POST["logout"])){
        unset($_SESSION["login"]);
        unset($_SESSION["email"]);
        unset($_SESSION["admin"]);
        session_destroy();
        echo "
            <script>
                alert('Anda telah logout');
                document.location.href = '../index.php';
            </script>
        ";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - Top Up Store</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/main-logo.jpg">
</head>
<body>
    <nav class="header-container">
        <div class="icon">
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <a href="../index.php"><img src="../assets/main-logo.jpg" class="title" alt="main-logo" width="50px" height="50px"></a>    
        </div>
        
        <menu class="header-list">
            <li>
                <button class="header-item"><a href="../index.php">Home</a></button>
            </li>
            
            <li>
                <button class="header-item"><a href="../about_me.php">About Me</a></button>
            </li>

            <li>
                <button class="dark-button" id="mode" onclick="mode()">Dark</button>
            </li>
            
        </menu>

        <a href='logout_account.php'>
            <button class="logout-button">
                <?php 
                    if (isset($_SESSION["admin"])){
                        echo "<img src='../assets/admin_profile.png' alt='profile-picture' class='profile'>";

                    } else if (isset($_SESSION["login"])){
                         if ($account['profil'] == ''){
                            echo "<img src='../assets/default.jpg' alt='profile-picture' class='profile'>";
                        } else {
                            echo "<img src='$direktori' alt='profile-picture' class='profile'>";
                        }
                    } else {
                        echo "<a href='login.php' class='account'>Login</a>";
                    }
                ?>
            </button>
        </a>
        
        
    </nav>

    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
        <a href="../index.php">Home</a>
        <a href="../about_me.php">About Me</a>
        <a href="../login.php">Login</a>
        <a href="../ontact.php">Contact</a>
        <?php
            if (isset($_SESSION["admin"])){
                echo "<a href='history.php'>History</a>";
            }
        ?>
    </div>

    <main class="logout-container">
        <div class="info-profile-container">
            <div class="profile-container">
                <b>Foto Profil</b>
                <?php
                    if (isset($_SESSION["admin"])){
                        echo "<img src='../assets/admin_profile.png' alt='profile-picture' class='picture' >";

                    } else if (isset($_SESSION["login"])){
                        if ($account["profil"] == ""){
                            echo "<img src='../assets/default.jpg' alt='profile-picture' class='picture' >";

                        } else {
                            echo "<img src='$direktori' alt='profile-picture' class='picture' >";
                        }
                        
                    }
                ?>
                
            </div>
        </div>
        <div class="info-account-container">
            <form action="" method="post">
                <input type="submit" value="Logout" name="logout" >
            </form>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>

    <script src="../scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
