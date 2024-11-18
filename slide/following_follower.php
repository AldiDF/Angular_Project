<?php 
    $mengikuti = select_follow($conn, $akun["username"], "following");
    $pengikut = select_follow($conn, $akun["username"], "follower");
?>

<div class="followingpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('following')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <div class="pripub-btn">
            <button class="private-btn" id="following-btn" onclick="follow('following')">Mengikuti</button>
            <button class="public-btn" id="follower-btn" onclick="follow('follower')">Pengikut</button>
        </div>
    </div>

    <div class="list-follow" id="list-following">
        <p>Akun yang diikuti</p>
    <?php foreach($mengikuti as $mengikuti):?>
        <a href="profile.php" class="account-container">
            <i class="fa-solid fa-circle-user"></i>
            <figcaption class="identifier-container">
                <h1><?= $mengikuti["objek"]?></h1>
            </figcaption>
        </a>
    <?php endforeach;?>
    </div>

    <div class="list-follow" id="list-follower">
        <p>Akun yang mengikuti</p>
    <?php foreach($pengikut as $pengikut):?>
        <a href="profile.php" class="account-container">
            <i class="fa-solid fa-circle-user"></i>
            <figcaption class="identifier-container">
                <h1><?= $pengikut["subjek"]?></h1>
            </figcaption>
        </a>
    <?php endforeach;?>
    </div>
</div>

<script>
    
</script>

<div class="followerpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('follower')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>Mengikuti</h1>
    </div>
</div>