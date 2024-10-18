<?php
    session_start();
    require "../crud/connection.php";

    $email;
    $account;
    $direktori;
    if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $sql_select = mysqli_query($conn, "SELECT * FROM akun WHERE email='$email'");
        $account = mysqli_fetch_assoc($sql_select);
        $direktori = "../crud/saves/" . $account["profil"];
    }

    $sesi_login = isset($_SESSION["login"]);
    $sesi_admin = isset($_SESSION["admin"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FF - Top Up Store</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/topup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/main-logo.jpg">
</head>
<body>
    <nav class="header-container" id="header">
        <div class="icon">
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <a href="../index.php"><img src="../assets/main-logo.jpg" class="title" alt="main-logo" width="50px" height="50px"></a>    
        </div>
        
        <menu class="header-list" id="head-list">
            <li>
                <a href="../index.php"><button class="header-item">Home</button></a>
            </li>
            
            <li>
                <a href="../about_me.php"><button class="header-item">About Me</button></a>
            </li>

            <li>
                <button class="dark-button" id="mode" onclick="mode()">Dark</button>
            </li>
            
        </menu>
        <a href='../crud/logout_account.php' class="logout-button">
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
                    echo "<a href='../login.php' class='account' onchange=''>Login</a>";
                }
            ?>
        </a>
    </nav>

    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../index.php">Home</a>
        <a href="../about_me.php">About Me</a>
        <a href="../login.php">Login</a>
        <a href="../contact.php">Contact</a>
        <?php
            if (isset($_SESSION["admin"])){
                echo "<a href='../crud/history.php'>History</a>";
            }
        ?>
    </div>

    <main>
        <form action="../receipt/receipt_ff.php" class="top-up-container" id="topup-form" method="POST" onsubmit="return limit_number_forTopupff()">
        <div class="left-content">
            <div class="game-description">
                <figure class="game-logo">
                    <img src="../assets/ff-logo.png" alt="ff-logo" class="game" width="100px" height="100px">
                    <figcaption>
                        <p class="developer">Garena</p>
                        <p style="text-align: left;">Free Fire</p>
                    </figcaption>
                </figure>
                <p style="text-align: justify;">Dikembangkan oleh Garena, Free Fire adalah game battle royale yang bisa dimainkan via Android dan iOS. Popularitasnya sebagai game yang paling banyak diunduh menempatkan Free Fire sebagai “Best Popular Vote Game” dari Google Playstore tahun 2019 lalu.</p>
                <br>
                <p style="text-align: justify;">Cukup masukkan user ID anda, Pilih jumlah Diamond yang ingin anda beli, pilih metode pembayaran yang anda inginkan, selesaikan pembayaran, dan Diamonds anda akan segera ditambahkan ke akun Free Fire.</p>
            </div>
            <div class="payment-medhod">
                <div id="payment" class="menu-payment">
                    <h2>Pilih Metode Pembayaran</h2>
                    <div class="pay-radio" >
                        <input type="radio" id="pay-this1" name="pay" value="Bank BCA" onclick="method_payment(1)">
                        <label for="pay-this1">
                            <span class="pay-category">
                                Bank BCA <br>
                                <img src="../assets/bca.png" alt="bca" width="150px" height="100px">
                            </span>
                        </label> 

                        <input type="radio" id="pay-this2" name="pay" value="Bank BRI" onclick="method_payment(1)" >
                        <label for="pay-this2">
                            <span class="pay-category">
                                Bank BRI <br>
                                <img src="../assets/bri.png" alt="bri" width="150px" height="100px">                            
                            </span>
                        </label> 

                        <input type="radio" id="pay-this3" name="pay" value="Bank BNI" onclick="method_payment(1)" >
                        <label for="pay-this3">
                            <span class="pay-category">
                                Bank BNI <br>
                                <img src="../assets/bni.png" alt="bni" width="150px" height="100px">
                            </span>
                        </label>

                        <input type="radio" id="pay-this4" name="pay" value="Dana" onclick="method_payment(1)" >
                        <label for="pay-this4">
                            <span class="pay-category">
                                Dana <br>
                                <img src="../assets/dana.png" alt="dana" width="150px" height="100px">
                            </span>
                        </label> 

                        <input type="radio" id="pay-this5" name="pay" value="Gopay" onclick="method_payment(1)" >
                        <label for="pay-this5">
                            <span class="pay-category">
                                Gopay <br>
                                <img src="../assets/gopaay.png" alt="gopay" width="150px" height="100px">                            
                            </span>
                        </label> 

                        <input type="radio" id="pay-this6" name="pay" value="Shopee Pay" onclick="method_payment(1)" >
                        <label for="pay-this6">
                            <span class="pay-category">
                                ShoopePay <br>
                                <img src="../assets/shoopepay.png" alt="shoopepay" width="150px" height="100px">
                            </span> 
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-content">
            <div class="input-content">
                <h2>Masukkan:</h2>
                <div class="input-box-ff">
                    <input type="text" placeholder="Id Pengguna" pattern="\d*" maxlength="10" inputmode="numeric" title="Harus Masukkan Angka" class="input-form-ff" name="ID" id="user" required>
                </div>
            </div>
            <div class="category-content">
                <h2>Pilih Kategori</h2>
                <div class="radio-category-ff">
                    <input type="radio" id="radio1" name="kategori" value="Diamond" onclick="category(1)">
                    <label for="radio1">
                        <span class="category-specify">
                            <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">
                        </span> <br>  Diamond
                    </label>
                </div>
            </div>

            <div class="top-up-content">
                <div id="menu" class="menu-diamond-ff">
                    <div class="radio-top-up">
                        <input type="radio" id="radio1.1" value="50 FF-Diamond Rp7.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.1">
                            <span class="top-up-category">
                                50 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">
                            </span> <br> Rp7.000,00
                        </label> 

                        <input type="radio" id="radio1.2" value="140 FF-Diamond Rp18.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.2">
                            <span class="top-up-category">
                                140 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">                            
                            </span> <br> Rp18.000,00
                        </label> 

                        <input type="radio" id="radio1.3" value="720 FF-Diamond Rp90.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.3">
                            <span class="top-up-category">
                                720 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">
                            </span> <br> Rp90.000,00
                        </label>
                        
                        <input type="radio" id="radio1.4" value="2180 FF-Diamond Rp270.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.4">
                            <span class="top-up-category">
                                2180 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">
                            </span> <br> Rp270.000,00
                        </label> 

                        <input type="radio" id="radio1.5" value="7290 FF-Diamond Rp900.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.5">
                            <span class="top-up-category">
                                7290 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">                            
                            </span> <br> Rp900.000,00
                        </label> 

                        <input type="radio" id="radio1.6" value="73100 FF-Diamond Rp9.000.000,00" name="top-up" onclick="methodt(1)">
                        <label for="radio1.6">
                            <span class="top-up-category">
                                73100 Diamond <br>
                                <img src="../assets/diamond_ff.png" alt="diamond" width="100px" height="100px">
                            </span> <br> Rp9.000.000,00
                        </label>
                    </div>
                </div>
            </div>
            <div class="checkout-content" id="other">
                <h2>Konfirmasi Pembelian</h2><br>
                <button class="reset-button" type="button" onclick="reset_form_OneCategory()">Batalkan Semua Pilihan</button>
                <div class="input-box-payment" id="other-form">
                    Silahkan Masukkan: <br>
                    <input type="text" min="0" placeholder="Nomor Rekening/Telepon" pattern="\d*" maxlength="15" inputmode="numeric" title="Harus Masukkan Angka" class="payment-form" id="num" name="number"required><br>
                    <input type="submit" name="submit" value="Beli Sekarang" class="checkout-button">
                </div>
            </div>
        </div>
        </form>
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

    <script src="../scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
