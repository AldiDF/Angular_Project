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
    <div class="off-screen-menu">
        <ul>
            <li>Profil</li>
            <li>Home</li>
            <li>Upload</li>
        </ul>
    </div>

    <nav>
        <div class="sidebar-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    
    <main class="main-container">
        search bar123
        <div class="list-music-container">
            <?php
                for ($i = 1; $i < 11; $i++){
                    echo "
                        <input type='radio' id='$i' name='lagu' value='$i'>
                        <label for='$i'>
                            <span class='list-music'>
                                <script></script>
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
