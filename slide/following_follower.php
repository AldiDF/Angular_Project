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

    <div class="list-fol" id="list-following">
        <p style="text-align:center;">Akun yang diikuti</p>
        <div class="list-follow">
        <?php foreach($mengikuti as $mengikuti):?>
            <a href="profile.php?user=<?= $mengikuti["objek"]?>" class="account-container" onclick="closep('following')">
                <?php $akun_mengikuti = select_akun($conn, $mengikuti["objek"])?>
                <?php if ($akun_mengikuti['foto'] == ""):?>
                    <img src="assets/default.jpg" alt="profile-picture">
                <?php else: ?>
                    <img src="databases/profile/<?php echo $akun_mengikuti['foto']?>" alt="profile-picture">
                <?php endif;?>
                <figcaption class="identifier-container">
                    <h1><?= $akun_mengikuti["username"]?></h1>
                    <h2 id="fullname"><?= $akun_mengikuti["nama_lengkap"]?></h2>
                </figcaption>
            </a>
        <?php endforeach;?>
        </div>
    </div>

    <div class="list-fol" id="list-follower">
        <p style="text-align:center;">Akun yang mengikuti</p>
        <div class="list-follow">
        <?php foreach($pengikut as $pengikut):?>
                <a href="profile.php?user=<?= $pengikut["subjek"]?>" class="account-container" onclick="closep('following')">
                    <?php $akun_pengikut = select_akun($conn, $pengikut["subjek"])?>
                    <?php if ($akun_pengikut['foto'] == ""):?>
                        <img src="assets/default.jpg" alt="profile-picture">
                    <?php else: ?>
                        <img src="databases/profile/<?php echo $akun_pengikut['foto']?>" alt="profile-picture">
                    <?php endif;?>
                    <figcaption class="identifier-container">
                        <h1><?= $akun_pengikut["username"]?></h1>
                        <h2 id="fullname"><?= $akun_pengikut["nama_lengkap"]?></h2>
                    </figcaption>
                </a>
            <?php endforeach;?>
        </div>
    
    </div>
</div>

<script>
    function overflow(selector, maxLength) {
        const elements = document.querySelectorAll(selector);
        elements.forEach((element) => {
        const text = element.textContent;
            if (text.length > maxLength) {
                element.textContent = text.substring(0, maxLength) + "...";
            }
        });
    }
    overflow("#fullname", 20);
</script>

<div class="followerpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('follower')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>Mengikuti</h1>
    </div>
</div>