<?php
    require "databases/connection.php";
?>

<div class="signuppg">
    <div class="title-login">
        <button class="back-page" onclick="closep('signup')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1 style="text-align: center">Daftar</h1>
    </div>
    <div class="signup-page">
        <div class="signup-container">
            <form action="databases/query.php" class="login-form-container" method="POST" onsubmit="return closep('signup')">
                <label for="full-name">Nama Lengkap:</label>
                <input type="text" id="full-name" name="full-name" class="form-login" required><br>
                <label for="email">Surel:</label>
                <input type="email" id="email" name="email" class="form-login" required><br>
                <label for="username">Nama Pengguna:</label>
                <input type="text" id="username" name="username" class="form-login" required><br>
                <label for="password">Sandi:</label>
                <input type="password" id="password" name="password" class="form-login" required><br>
                <div class="submit-button-container">
                    <input type="submit" id="submit-login" name="signup" value="Daftar" class="submit-button-signup">
                </div><br>
            </form>

        </div>
    </div>
</div>
