<?php
    require "databases/connection.php";
?>

<div class="loginpg">    
    <div class="title-upper">
        <button class="back-page" id="close-login" onclick="closep('login')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1 style="text-align: center">Masuk</h1>
    </div>
    <div class="login-page">
        <img src="assets/wave.png" alt="LOGO" class="logo">
        <div class="login-line"></div>
        <div class="login-container">
            <form action="databases/query.php" class="login-form-container" method="POST" onsubmit="return closep('login')">
                <label for="username">Nama Pengguna:</label>
                <input type="text" id="username" name="username" class="form-login" required><br>
                <label for="password">Sandi:</label>
                <input type="password" id="password" name="password" class="form-login" required><br>
                <div class="submit-button-container">
                    <input type="submit" id="submit-login" name="login" value="Masuk" class="submit-button-login">
                </div><br>
            </form>
            <button class="button" onclick="open_slide('signup')">Daftar</button>
        </div>
    </div>
</div>