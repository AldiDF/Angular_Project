<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link rel="stylesheet" href="styles/login_signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <div>
        <a href="index.php" class="back-page"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></a>
        <h1 style="text-align: center">Masuk</h1>
    </div>
    <main class="login-page">
        <img src="assets/LOGO.jpg" alt="LOGO" class="logo">
        <div class="login-container">
            <form action="" class="login-form-container" method="POST">
                <label for="username">Nama Pengguna:</label>
                <input type="text" id="username" name="username" class="form-login"><br><br>
                <label for="password">Sandi:</label>
                <input type="password" id="password" name="password" class="form-login"><br><br>
                <div class="submit-button-container">
                    <input type="submit" id="submit-login" name="submit" value="Masuk" class="submit-button-login">
                </div><br>
            </form>

        <a href="crud/signup.php"><button class="button">Daftar</button></a>
        </div>
    </main>

    <script src="scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
