<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Top Up Store</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav>
        <div>hamburger</div>
        <div>list</div>
        <div>akun</div>
    </nav>

    <main class="music-container">
        search bar
        <div class="list-music-container">
            <?php
                for ($i = 1; $i < 11; $i++){
                    echo "
                        <input type='radio' id='$i' name='lagu' value='$i'>
                        <label for='$i'>
                            <span class='list-music'>
                                <p>Lagu $i</p>
                            </span>
                        </label>
                    ";
                }
            ?>
        </div>
    </main>

    

    <footer>
        <p>Angular</p>
    </footer>

    <script src="scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
