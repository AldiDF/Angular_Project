<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Top Up Store</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/history.css?v=<?php echo time(); ?>">
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
        <a href="history.php">History</a>
    </div>

    <main class="login-container">
        <div class="box-login">
            <h3 class="login-title"><b>Register-Form</b></h3>
            <div class="box-form">
                <div class="box-mail">
                    <form action="../receipt/register_result.php" method="post" id="registerForm" enctype="multipart/form-data" onsubmit="return limit_number_forRegister()">
                        <div class="upload-container">
                            <b>Profile Picture:</b>
                            <label for="photo" class="input-picture">
                                <p class="title-pict" id="title-picture">Upload</p>
                                <img id="up-picture" alt="preview" class="picture-preview">
                            </label><br>
                            <input type="file" name="image" id="photo" onchange="limit_size(event)"><br>
                        </div>
                        
                        <label for="first-name" style="font-size: 20px;"><b>First Name:</b></label><br>
                        <input type="text" name="firstname" class="form-mail" id="first-name" required><br><br><br>
    
                        <label for="last-name" style="font-size: 20px;"><b>Last Name:</b></label><br>
                        <input type="text" name="lastname" class="form-mail" id="last-name" required><br><br><br>
    
                        <label for="region" style="font-size: 20px;"><b>Region:</b></label><br>
                        <select name="region" id="region" class="region-mail" required>
                            <option value=""></option readonly>
                            <option value="Argentina">Argentina</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Egypt">Egypt</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="Netherland">Netherland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Mexico">Mexico</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Russia">Russia</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="Spain">Spain</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="Vietnam">Vietnam</option>
                        </select><br><br><br>

                        
                        <label for="phone" style="font-size: 20px;"><b>Phone Number:</b></label><br>
                        <input type="text" min="0" name="phone" class="form-mail" id="num" pattern="\d*" maxlength="12" inputmode="numeric" title="Harus Masukkan Angka" required><br><br><br>

                        <label for="reg-mail" style="font-size: 20px;"><b>Email:</b></label><br>
                        <input type="email" name="email" class="form-mail" id="reg-mail" required><br><br><br>
    
                        <label for="reg-pw" style="font-size: 20px;"><b>Password:</b></label><br>
                        <input type="password" name="password" class="form-mail" id="reg-pw" required><br><br><br>
                        
                        <input type="submit" name="submit" class="submit-login" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>2309106017 Aldi Daffa Arisyi</p>
    </footer>
    <script src="../scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
