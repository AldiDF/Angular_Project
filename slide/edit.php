<?php
    require "../databases/connection.php";
    include "../databases/query.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <link rel="stylesheet" href="../styles/edit.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- Edit Akun -->
    <div class="edit-userpg">
        <div class="title-upper">
            <button class="back-page" onclick="closep('userEdit')">
                <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
            </button>
            <h1>EDIT AKUN</h1>
        </div>
        <div class="edit-user-container">
            <form action="databases/query.php" method="POST" class="form-container" onsubmit="return closep('userEdit')">
                <label for="edit-full-name">Nama Lengkap:</label>
                <input type="text" id="edit-full-name" name="full-name" class="form-login" value="[Nama Lengkap]" required><br>

                <label for="edit-email">Surel:</label>
                <input type="email" id="edit-email" name="email" class="form-login" value="[Surel]" required><br>

                <label for="edit-username">Nama Pengguna:</label>
                <input type="text" id="edit-username" name="username" class="form-login" value="[Nama Pengguna]" required><br>

                <label for="edit-password">Sandi Baru:</label>
                <input type="password" id="edit-password" name="password" class="form-login"><br>

                <div class="submit-button-container">
                    <input type="submit" id="submit-edit" name="edit-account" value="Simpan Perubahan" class="submit-button">
                </div><br>
            </form>
        </div>
    </div>


</body>
</html>