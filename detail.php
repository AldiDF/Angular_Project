<?php
    require "databases/connection.php";
    require "databases/query.php";

    date_default_timezone_set("Asia/Makassar");
    $waktu = date("Y-m-d H:i");

    if (!isset($_SESSION['username'])) {
        header('Location: index.php'); 
        exit;
    }

    if (isset($_GET["lagu"])){
        if (isset($_SESSION["username"])){
            $lagu = select_lagu_spesifik($conn, $_GET["lagu"]);
            $jumlah_like = num_row($conn, "like_content", "objek", $_GET["lagu"]);
            $jumlah_komen = num_row($conn, "comment", "lagu", $_GET["lagu"]);
            $komen = select_komen($conn, $_GET["lagu"], false);
            $like = select_like($conn, $_GET["lagu"], $_SESSION["username"]);
        } else {
            $komen = select_komen($conn, $_GET["lagu"], false);
            $lagu = select_lagu_spesifik($conn, $_GET["lagu"]);
            $jumlah_like = num_row($conn, "like_content", "objek", $_GET["lagu"]);
            $jumlah_komen = num_row($conn, "comment", "lagu", $_GET["lagu"]);
            $_SESSION["username"] = "";
        }

    } else {
        echo "
        <script>
            alert('Lagu tidak ditemukan');
            document.location.href = 'index.php';
        </script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lagu["user"] . " - " . $lagu["judul"]?></title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/edit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/chat.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .main-content{
            width: 100%;
            height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url("<?php echo "databases/thumbnail/" . $lagu['thumbnail']?>");
            background-size: cover;
            background-position: center;
        }

        .main-content:hover{
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url("<?php echo "databases/thumbnail/" . $lagu['thumbnail']?>");
            background-size: cover;
            background-position: center;
        }

        .main-content.lyric{
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url("<?php echo "databases/thumbnail/" . $lagu['thumbnail']?>");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION["username"])):?>
    <?php include("slide/settings.php")?>
    <?php include("slide/edit.php")?>
    <?php include("slide/user_music.php")?>
    <?php include("slide/chat.php")?>
    <?php include("slide/upload_content.php")?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    <?php else:?>
    <?php include("slide/chat.php")?>
    <?php endif;?>


    <?php 
    $lagu = select_lagu_spesifik($conn, $_GET["lagu"]);
    $akun = select_akun($conn, $lagu["user"]);
    $jumlah_follower = num_row($conn,"follow", "objek", $akun["username"]);
 ?>
    <main>
    <section class="main-content" id="main-content">
        <div class="click-lyric" onclick="show_lyric()"></div>
        <div class="lyric-container" onclick="show_lyric()">
            <pre id="lyric-content"></pre>
        </div>
        <audio id="playMusic" controls>
            <source  src="<?php echo "databases/music/". $lagu['lagu']?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <div class="playback-container">
            <button class="play-music" id="play-music" onclick="playAudio()">
                <i class="fa-duotone fa-solid fa-play"></i>
            </button>
            <button class="play-music" id="pause-music" onclick="pauseAudio()" style="display:none;">
                <i class="fa-solid fa-pause"></i>
            </button>
            <span id="currentStart">0.00</span>
            <div class="bar">
                <input type="range" id="seek" min="0" value="0" max="100">
                <div class="bar2" id="bar2"></div>
                <div class="dot" id="dot"></div>
            </div>
            <span id="currentEnd">0.00</span>
            <button class="stop-music" id="stop-music" onclick="stopAudio()">
                <i class="fa-solid fa-stop"></i>
            </button>
        </div>
    </section>
    <section class="comment-section">
        <div class="descript-container">
            <div class="heading-container">
                <h1><?php echo $lagu['judul']?></h1>
                <h2><?php echo $lagu['deskripsi']?></h2>
            </div>
            <div class="information-container">
                <div class="info-specify">
                    <div class="info-center">
                        <div>
                            <?php if ($_SESSION["username"] != ""):?>
                            <?php if ($like == 1):?>
                                <button type="submit" name="unsend-like" onclick="cancel_like()" id="liked">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                                <button type="submit" name="send-like" onclick="send_like()" id="like" style="display: none;">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                             <?php else:?>
                                <button type="submit" name="send-like" onclick="send_like()" id="like">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button type="submit" name="unsend-like" onclick="cancel_like()" id="liked" style="display: none;">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            <?php endif;?>
                            <?php else :?>
                                <button type="submit" name="send-like" id="like">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            <?php endif;?>

                        </div>
                        <div><p id="like-count"><?php echo $jumlah_like?></p></div>
                    </div>
                    <div class="info-center">
                        <i class="fa-solid fa-comment"></i>
                        <div><p id="comment-count"><?php echo $jumlah_komen?></p></div>
                    </div>
                    <div class="info-center">
                        <i class="fa-solid fa-user"></i>
                        <div><p><?= $jumlah_follower?></p></div>
                    </div>
                    <?php if(isset($_SESSION['user']) || isset($_SESSION["admin"])):?>
                    <?php if ($_SESSION["username"] != $akun["username"] && $_SESSION["username"] != "admin"):?>
                    <div class="report" onclick="open_slide('chat')">
                        <i class="fa-light fa-circle-exclamation"></i>
                    </div>
                    <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <div class="comment-column">
            <h2>Berikan Komentar Anda</h2>
            <div class="comment-container" id="comment-container">
                <?php foreach($komen as $komen) :?>
                <?php if ($komen["user"] == $_SESSION["username"]):?>
                    <div class="comment-right" id="comment-right">
                        <div class="comment-owner">
                            <div><?= $komen["user"]?></div>
                            <?php if ($currentSession["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $currentSession["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                            
                        </div>
                        <div class="comment-content-right" id="<?= "komen_" . $komen["id"]?>">
                            <?= $komen["isi_komen"]?>
                        </div>
                        <p class="time-comment"><?= $komen["waktu"]?></p>
                    </div>
                <?php else:?>
                    <div class="comment-left">
                        <div class="comment-owner">
                            <?php $akun_komen = select_akun($conn, $komen['user'])?>
                            <?php if ($akun_komen["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akun_komen["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                            <div><?= $komen["user"]?></div>

                        </div>
                        <div class="comment-content">
                            <?= $komen["isi_komen"]?>
                        </div>
                        <p class="time-comment"><?= $komen["waktu"]?></p>
                    </div>
                <?php endif;?>
                <?php endforeach;?>

                <div class="send-comment" id="input-comment">
                    <textarea name="comment" id="comment" cols="30" rows="1" placeholder="Komentar Anda"></textarea>
                    <button type="submit" name="send-comment" id="send-comment"><i class="fa-regular fa-paper-plane-top"></i></button>
                </div>
                
            </div>
        </div>
    </section>
    </main>

    <?php include("navfooter/footer.php")?>

    <script>
        let old_id = <?php if ($jumlah_komen == 0) {echo 0;} else {echo $komen["id"];}?>

        document.addEventListener('DOMContentLoaded', (event) => {
            const music = document.getElementById('playMusic');
            const currentEnd = document.getElementById('currentEnd');
        
            music.addEventListener('loadedmetadata', () => {
                let music_dur = music.duration;
                let min = Math.floor(music_dur / 60);
                let sec = Math.floor(music_dur % 60);
                if (sec < 10) {
                    sec = `0${sec}`;
                }
                currentEnd.textContent = `${min}:${sec}`;
            });
        });

        <?php if (isset($_SESSION["username"])):?>
        document.getElementById('send-comment').addEventListener('click', function() {
            const commentInput = document.getElementById('comment');
            const commentText = commentInput.value.trim();
            const commentCount = document.getElementById('comment-count');
            let count = parseInt(commentCount.textContent);

            if (commentText !== '') {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'databases/query.php?comment=true', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const newComment = document.createElement('div');
                        newComment.classList.add('comment-right');
                        newComment.innerHTML = `
                            <div class="comment-owner">
                                <div><p><?= $_SESSION["username"]?></p></div>
                                <?php if ($currentSession["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $currentSession["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>

                            </div>
                            <div class="comment-content-right">
                                <p>${commentText.replace(/\n/g, '<br>')}</p>
                            </div>
                            <p class="time-comment"><?= $waktu?></p>
                        `;

                        // Append the new comment to the comments container
                        const commentsContainer = document.getElementById("comment-container");
                        const sendCommentDiv = document.querySelector('.send-comment');
                        commentsContainer.insertBefore(newComment, sendCommentDiv);
                    
                        // Clear the input field
                        commentInput.value = '';
                        count += 1;
                        commentCount.textContent = count;
                    }
                }
            
                const lagu = "<?= $_GET['lagu'] ?>";
                const username = "<?= $_SESSION['username'] ?>";
                xhr.send(`lagu=${lagu}&username=${username}&send-comment=${encodeURIComponent(commentText.replace(/\n/g, '<br>'))}`);
            
            }
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            function fetchNewComments() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `databases/query.php?lagu=<?= $_GET['lagu'] ?>&last=true`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const newComments = JSON.parse(xhr.responseText);
                        if (old_id == newComments.id) {
                            return;
                        } else {
                            if (newComments.user === "<?= $_SESSION["username"]?>"){
                                return;
                            }
                            old_id = newComments.id;
                        }

                        const newComment = document.createElement('div');
                        newComment.classList.add('comment-left');
                        newComment.innerHTML = `
                            <div class="comment-owner">
                                <?php if ($akun_komen["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akun_komen["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                                <div><p>${newComments.user}</p></div>
                            </div>
                            <div class="comment-content">
                                <p>${newComments.isi_komen.replace(/\n/g, '<br>')}</p>
                            </div>
                            <p class="time-comment">${newComments.waktu}</p>
                        `;
                        const commentsContainer = document.getElementById("comment-container");
                        const sendCommentDiv = document.querySelector('.send-comment');
                        commentsContainer.insertBefore(newComment, sendCommentDiv);
                        
                    }
                };
                const lagu = "<?= $_GET['lagu'] ?>";
                const last = true;
                xhr.send(`lagu=${lagu}&last=${last}`);
            }
    
            // Poll for new comments every 5 seconds
            setInterval(fetchNewComments, 5000);
        })


        function send_like() {
            const like = document.getElementById('like');
            const liked = document.getElementById('liked');
            const likeCount = document.getElementById('like-count');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'databases/query.php?send-like=true', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    like.style.display = "none";
                    liked.style.display = "block";
                    let count = parseInt(likeCount.textContent);
                    count += 1;
                    likeCount.textContent = count;
                }
            };
            const lagu = "<?= $_GET['lagu'] ?>";
            const username = "<?= $_SESSION['username'] ?>";
            xhr.send(`lagu=${encodeURIComponent(lagu)}&username=${encodeURIComponent(username)}`);
        }

        function cancel_like() {
            const like = document.getElementById('like');
            const liked = document.getElementById('liked');
            const likeCount = document.getElementById('like-count');
            const status = false;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'databases/query.php?cancel-like=true', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    like.style.display = "block";
                    liked.style.display = "none";
                    let count = parseInt(likeCount.textContent);
                    count -= 1;
                    likeCount.textContent = count;
                }
            };
            const lagu = "<?= $_GET['lagu'] ?>";
            const username = "<?= $_SESSION['username'] ?>";
            xhr.send(`lagu=${lagu}&username=${username}`);
        }
        <?php endif;?>

        function show_lyric(){
            const mainContentContainer = document.getElementById('main-content');
            const lyric = document.querySelector('.lyric-container');
            lyric.classList.toggle('lyric');
            mainContentContainer.classList.toggle('lyric');

            const lyricsContent = document.getElementById('lyric-content');
            lyricsContent.innerHTML = `<?php 
                if ($lagu["lirik"] == "") {
                    echo "Lirik tidak tersedia";
                } else {
                    echo nl2br($lagu['lirik']);
                }
            ?>`;
        }

        document.addEventListener("click", function(event) {
            if (event.target.id.includes("komen_")) {
                let commentId = event.target.id.split("_")[1];
                console.log(event.target.id);
                    if (confirm("Apakah Anda yakin ingin menghapus komentar ini?")) {
                        document.location.href = "databases/query.php?commentDelete=true&lagu=<?= $_GET['lagu']?>&commentId=" + commentId;
                    } else {
                        return;
                    }
            }
        });
    </script>
    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/playback.js?v=<?php echo time(); ?>"></script>
</body>
</html>