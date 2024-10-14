<?php
    require "connection.php";

    $sql_forAkun = mysqli_query($conn, "SELECT * FROM akun");

    $akun = [];

    while ($row = mysqli_fetch_assoc($sql_forAkun)) {
        $akun[] = $row;
    }

    $sql_forPembelian = mysqli_query($conn, "SELECT * FROM pembelian");

    $pembelian = [];

    while ($row = mysqli_fetch_assoc($sql_forPembelian)) {
        $pembelian[] = $row;
    }

    $sql_forPenjualan = mysqli_query($conn, "SELECT * FROM penjualan");

    $penjualan = [];
    
    while ($row = mysqli_fetch_assoc($sql_forPenjualan)) {
        $penjualan[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History - Top Up Store</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/history.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <a href="history.php">History</a>
    </div>

    <main class="">
        <h3 style="transition: 0.5s;"><u>HISTORY</u></h3>
        <div class="button-container">
            <button class="button-history-left" id="left-button" onclick="hover_button('left')">Pembelian</button>
            <button class="button-history-mid" id="mid-button" onclick="hover_button('mid')">Produk</button>
            <button class="button-history-right" id="right-button" onclick="hover_button('right')">Akun</button>
        </div>
        <div id="if-empty">
            <div class="empty">
                <h1 class="title-empty"><br><br>Silahkan Pilih Menu Riwayat</h1>
            </div>
        </div>
        <div id="list-container">
            <div id="buy" class="payment-container">
                <h3 style="transition: 0.5s;">Purchase History</h3>
                <search>
                    <form action="" class="search-bar">
                        <input type="text" placeholder="Masukkan Nama Game Atau ID User" class="input-search">
                        <button type="submit" class="search-button">
                            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                        </button>
                    </form>
                </search>
                <table class="table-purchase" border=1>
                    <thead>
                        <tr class="account-table-row">
                            <th class="header-table">No</th>
                            <th class="header-table">Top Up Game</th>
                            <th class="header-table">Nama Pembeli</th>
                            <th class="header-table">ID Account</th>
                            <th class="header-table">Category</th>
                            <th class="header-table">Amount</th>
                            <th class="header-table">Method</th>
                            <th class="header-table">Phone/Account</th>
                            <th class="header-table">Tanggal Pembelian</th>
                            <th class="header-table">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($pembelian as $beli) : ?>
                        <tr class="account-table-row">
                            <td class="data-table"><?= $i ?></td>
                            <td class="data-table"><?php echo $beli["nama_game"];?></td>
                            <td class="data-table"><?php echo $beli["nama_pembeli"];?></td>
                            <td class="data-table"><?php echo $beli["id_akun"];?></td>
                            <td class="data-table"><?php echo $beli["kategori"];?></td>
                            <td class="data-table"><?php echo $beli["jumlah"];?></td>
                            <td class="data-table"><?php echo $beli["metode"];?></td>
                            <td class="data-table"><?php echo $beli["norek_telepon"];?></td>
                            <td class="data-table"><?php echo $beli["tgl_pembelian"];?></td>
                            <td class="data-table" style="text-align: center">
                                <div class="action-button">
                                    <a href="delete_purchase.php?id=<?= $beli['id'] ?>" onclick="return confirm('Yakin ingin menghapus bukti pembelian ini?');">
                                        <button class="delete-data">
                                            <i class="fa-solid fa-trash-can" style="color: lavender;"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach ?>
                    </tbody>
                </table>
            </div>
            <div id="selling" class="sale-container">
            <h3 style="transition: 0.5s;">Selling History</h3>
                <search>
                    <form action="" class="search-bar">
                        <input type="text" placeholder="Masukkan Nama Produk" class="input-search">
                        <button type="submit" class="search-button">
                            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                        </button>
                    </form>
                </search>
                <table class="table-selling" border=1>
                    <thead>
                        <tr class="account-table-row">
                            <th class="header-table">No</th>
                            <th class="header-table">Nama Produk</th>
                            <th class="header-table">Jumlah Tersisa</th>
                            <th class="header-table">Omset Penjualan</th>
                            <th class="header-table">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($penjualan as $sale) : ?>
                        <tr class="account-table-row">
                            <td class="data-table"><?= $i ?></td>
                            <td class="data-table"><?php echo $sale["nama_produk"]; ?></td>
                            <td class="data-table"><?= $sale["stok"]; ?></td>
                            <td class="data-table"><?php echo "Rp". $sale["omset"]; ?></td>
                            <td class="data-table" style="text-align: center">
                                <div class="action-button">
                                    <a href="update_selling.php?id=<?= $sale['id'] ?>" onclick="return confirm('Dengan mengubah stok, maka akan menghapus omset. Lanjutkan?')">
                                        <button class="update-data">
                                            <i class="fa-solid fa-pen" style="color: lavender;"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach ?>
                    </tbody>
                </table>
            </div>
            <div id="account" class="account-container">
                <h3 style="transition: 0.5s;">Account History</h3>
                <search>
                    <form action="" class="search-bar">
                        <input type="text" placeholder="Masukkan Nama Akun" class="input-search">
                        <button type="submit" class="search-button">
                            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                        </button>
                    </form>
                </search>
                <table class="table-account" border=1>
                    <thead>
                        <tr class="account-table-row">
                            <th class="header-table">No</th>
                            <th class="header-table">Picture</th>
                            <th class="header-table">Name</th>
                            <th class="header-table">Region</th>
                            <th class="header-table">Phone Number</th>
                            <th class="header-table">Email</th>
                            <th class="header-table">Tanggal Bergabung</th>
                            <th class="header-table">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($akun as $acc) : ?>
                        <tr class="account-table-row">
                            <td class="data-table"><?= $i ?></td>
                            <?php $direktori = "saves/". $acc["profil"]?>
                            <td class="data-picture"><?php if ($acc["profil"] == ""){echo "Foto Belum Ada";} else {echo "<img src='$direktori' alt='profile-picture' width='60px' height='60px'>";} ?></td>
                            <td class="data-table"><?php echo $acc["nama_depan"]. " " . $acc["nama_belakang"]; ?></td>
                            <td class="data-table"><?= $acc["region"]; ?></td>
                            <td class="data-table"><?= $acc["telepon"] ?></td>
                            <td class="data-table"><?= $acc["email"] ?></td>
                            <td class="data-table"><?= $acc["tgl_bergabung"] ?></td>
                            <td class="data-table">
                                <div class="action-button">
                                    <a href="update_account.php?id=<?= $acc['id'] ?>">
                                        <button class="update-data">
                                            <i class="fa-solid fa-pen" style="color: lavender;"></i>
                                        </button>
                                    </a>
                                    <a href="delete_account.php?id=<?= $acc['id'] ?>" onclick="return confirm('Yakin ingin menghapus akun?');">
                                        <button class="delete-data">
                                            <i class="fa-solid fa-trash-can" style="color: lavender;"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>
    <script src="../scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
