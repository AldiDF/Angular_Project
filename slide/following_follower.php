<div class="followingpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('following')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <div class="pripub-btn">
            <button class="private-btn" id="following-btn" onclick="follow('following')">Diikuti</button>
            <button class="public-btn" id="follower-btn" onclick="follow('follower')">Mengikuti</button>
        </div>
    </div>

    <div class="list-follow" id="list-following">
    <?php for ($i = 1; $i < 4; $i++):?>
        <a href="profile.php" class="account-container">
            <i class="fa-solid fa-circle-user"></i>
            <figcaption class="identifier-container">
                <h1>aldi</h1>
            </figcaption>
        </a>
    <?php endfor;?>
    </div>

    <div class="list-follow" id="list-follower">
    <?php for ($i = 1; $i < 4; $i++):?>
        <a href="profile.php" class="account-container">
            <i class="fa-solid fa-circle-user"></i>
            <figcaption class="identifier-container">
                <h1>daffa</h1>
            </figcaption>
        </a>
    <?php endfor;?>
    </div>
</div>

<script>
    function follow(type){
        following = document.getElementById("following-btn")
        follower = document.getElementById("follower-btn")
        list_following = document.getElementById("list-following")
        list_follower = document.getElementById("list-follower")

        if (type === "following"){
            follower.classList.remove("follow-active")
            following.classList.add("follow-active")
            list_following.style.display = "block"
            list_follower.style.display = "none"
            following.style.color = "#f3f3f3"
            follower.style.color = "#303841"


        } else if (type === "follower"){
            following.classList.remove("follow-active")
            follower.classList.add("follow-active")
            list_follower.style.display = "block"
            list_following.style.display = "none"
            following.style.color = "#303841"
            follower.style.color = "#f3f3f3"
        }
    }
</script>

<div class="followerpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('follower')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>Mengikuti</h1>
    </div>
</div>