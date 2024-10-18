<?php
    session_start();

    require "../crud/connection.php";
    
    if (isset($_SESSION["admin"]) || isset($_SESSION["login"])){
        if (isset($_SESSION["refresh"])) {
            if (isset($_SESSION["refresh"]) == 2){
                unset($_SESSION["refresh"]);
                echo "
                    <script>
                        document.location.href = '../index.php';
                    </script>
                    ";
                exit;
            }

        } else {
            if (isset($_SESSION["refresh"])){
                $_SESSION["refresh"] += 1;

            } else {
                $_SESSION["refresh"] = 1;
            }

        }

        if (isset($_POST["submit"])) {
            $userid = $_POST["ID"];
            $server = $_POST["serv"];
            $kategori = $_POST["kategori"];
            $jumlah = $_POST["top-up"];
            $metode = $_POST["pay"];
            $norek_telepon = $_POST["number"];
            
            $sql_select = mysqli_query($conn, "SELECT * FROM penjualan");
    
            $penjualan = [];
        
            while ($row = mysqli_fetch_assoc($sql_select)) {
                $penjualan[] = $row;
            }
    
            if ($jumlah == "WDP Rp30.000,00"){
                preg_match('/Rp([0-9.,]+)/', $jumlah, $matches);
                $harga = $matches[1];
    
                $harga = preg_replace('/[.,]/', '', $harga);
                $harga = substr($harga, 0, -2);
                
                if ($penjualan[1]["stok"] < 1){
                    echo "
                    <script>
                        alert('Maaf stok produk tidak mencukupi');
                        document.location.href = '../index.php';
                    </script>
                ";
                return;
                }
    
                $stok = (int) $penjualan[1]["stok"] - 1;
                $hasil_harga = (int) $penjualan[1]["omset"] + $harga;
    
                $sql_update = "UPDATE penjualan SET stok='$stok', omset='$hasil_harga' WHERE id=2"; 
                mysqli_query($conn, $sql_update);
                
            } elseif ($jumlah == "Twilight Pass Rp149.000,00"){
                preg_match('/Rp([0-9.,]+)/', $jumlah, $matches);
                $harga = $matches[1];
                
                $harga = preg_replace('/[.,]/', '', $harga);
                $harga = substr($harga, 0, -2);
    
                if ($penjualan[2]["stok"] < 1){
                    echo "
                    <script>
                        alert('Maaf stok produk tidak mencukupi');
                        document.location.href = '../index.php';
                    </script>
                ";
                return;
                }
                
                $stok = (int) $penjualan[2]["stok"] - 1;
                $hasil_harga = (int) $penjualan[2]["omset"] + $harga;
                
                $sql_update = "UPDATE penjualan SET stok='$stok', omset='$hasil_harga' WHERE id=3"; 
                mysqli_query($conn, $sql_update);
                
            } else {
                preg_match('/(\d+)\s/', $jumlah, $matches1);
                $jumlah_diamond = $matches1[1];
    
                if ($penjualan[0]["stok"] < $jumlah_diamond){
                    echo "
                    <script>
                        alert('Maaf stok produk tidak mencukupi');
                        document.location.href = '../index.php';
                    </script>
                ";
                return;
                }
    
                $stok = (int) $penjualan[0]["stok"] - $jumlah_diamond;
    
                preg_match('/Rp([0-9.,]+)/', $jumlah, $matches2);
                $harga = $matches2[1];
                
                $harga = preg_replace('/[.,]/', '', $harga);
                $harga = substr($harga, 0, -2);
                
                $hasil_harga = (int) $penjualan[0]["omset"] + $harga;
                
                $sql_update = "UPDATE penjualan SET stok='$stok', omset='$hasil_harga' WHERE id=1"; 
                mysqli_query($conn, $sql_update);
            }
    
            date_default_timezone_set("Asia/Makassar");
            $waktu = date("Y-m-d H:i:s");
    
            $sql_insert = "INSERT INTO pembelian VALUES (0, 'Mobile Legends: Bang Bang', '%COMING SOON%', '$userid ($server)', '$kategori', '$jumlah', '$metode', '$norek_telepon', '$waktu')";
    
            $result = mysqli_query($conn, $sql_insert);
    
            if ($result) {
                echo "
                    <script>
                        alert('Pembelian Berhasil');
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Pembelian Gagal');
                    </script>
                ";
            }
        }

    } else {
        echo "
            <script>
                alert('Anda harus login dulu');
                document.location.href = '../index.php';
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
    <title>Receipt MLBB - Top Up Store</title>
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
        <a href="../login.php" class="account">Login</a>
    </nav>

    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../index.php">Home</a>
        <a href="../about_me.php">About Me</a>
        <a href="../login.php">Login</a>
        <a href="../contact.php">Contact</a>
        <a href="../crud/history.php">History</a>
    </div>
    <main>
        <div class="box-result-form-top-up">
            <h3 class="title-register-form"><u>Bukti Pembayaran</u></h3>
            <div class="box-form">
                <figure class="game-logo">
                    <img src="../assets/mlbb-logo.png" alt="mlbb-logo" class="game" width="100px" height="100px">
                    <figcaption>
                        <p class="developer">Moonton</p>
                        Mobile Legends: Bang Bang
                    </figcaption>
                </figure>
                <div class="box-mail">
                    <p class="paragraph-form">User ID : <?php echo $_POST["ID"]; ?></p>
                    <p class="paragraph-form">Server ID : <?php echo $_POST["serv"]; ?></p>
                    <p class="paragraph-form">Category : <?php echo $_POST["kategori"]; ?></p>
                    <p class="paragraph-form" id="diff">
                        Amount : <?php if ($_POST["kategori"] == "Weekly Diamond Pass"){
                                            echo $_POST["kategori"]." Rp30.000.00";
                                        } elseif($_POST["kategori"] == "Twilight Pass"){
                                            echo $_POST["kategori"]." Rp149.000.00";
                                        } else {
                                            echo $_POST["top-up"];
                                        }?>
                    </p>
                    <p class="paragraph-form">Phone/Account Number : <?php echo $_POST["number"]; ?></p>
                    <p class="paragraph-form">Method : <?php echo $_POST["pay"]; ?></p>
                </div>
                <p style="color: #15292B; font-size: 20px; font-weight: 500;">Kembali Ke Home <br><br></p>
                <a href="../index.php">
                    <button class="register-button">
                        Home
                    </button>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>
    
    <script src="../scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
