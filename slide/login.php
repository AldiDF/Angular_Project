<?php
    require "databases/connection.php";

    if (isset($_POST["login"])){
        login($_POST["username"], $_POST["password"], $conn);
    }
?>

<div class="loginpg">    
    <div class="title-login">
        <button class="back-page" id="close-login" onclick="closep(1)"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1 style="text-align: center">Masuk</h1>
    </div>
    <div class="login-page">
        <img src="assets/LOGO.jpg" alt="LOGO" class="logo">
        <div class="login-container">
            <form action="" class="login-form-container" method="POST" onsubmit="return closep(1)">
                <label for="username">Nama Pengguna:</label>
                <input type="text" id="username" name="username" class="form-login" required><br><br>
                <label for="password">Sandi:</label>
                <input type="password" id="password" name="password" class="form-login" required><br><br>
                <div class="submit-button-container">
                    <input type="submit" id="submit-login" name="login" value="Masuk" class="submit-button-login">
                </div><br>
            </form>
            <button class="button" onclick="open_slide(2)">Daftar</button>
        </div>
    </div>
</div>