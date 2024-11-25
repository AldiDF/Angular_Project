<?php
    require "connection.php";
    include "query.php";

    if (isset($_GET["action"])){
        $action = $_GET["action"];

        if ($action == "navbar-search"){
            $keyword = $_GET["keyword"];
            liveSearch($keyword);
            return; 
            
        }
    } else if (isset($_GET["A-keywordAccount"])){
        $keyword = $_GET["A-keywordAccount"];
        $akun = adminSearchAccount($keyword);
        $type = "SearchAccount";

    } else if (isset($_GET["A-keywordPermission"])){
        $keyword = $_GET["A-keywordPermission"];
        $lagu = adminSearchPermission($keyword);
        $type = "SearchPermission";

    } else if (isset($_GET["A-keywordContent"])){
        $keyword = $_GET["A-keywordContent"];
        $lagu = adminSearchContent($keyword);
        $type = "SearchContent";

    } else if (isset($_GET["userContent"])){
        $keyword = $_GET["userContent"];
        $lagu = userSearchConntent($keyword);
        $userAction = "userContent";

    } else if (isset($_GET["userChat"])){
        $keyword = $_GET["userChat"];
        $history_chat = userSearchChat($keyword);
        $userAction = "userChat";
    }

    function liveSearch($keyword){
        global $conn;
        $search_account = "SELECT username, nama_lengkap, foto FROM account acc WHERE username LIKE '%$keyword%' OR nama_lengkap LIKE '%$keyword%';";
        $search_content = "SELECT lagu, thumbnail, judul FROM content WHERE stats = 'ACCEPT' AND judul LIKE '%$keyword%';";

        $result_account = mysqli_query($conn, $search_account);
        $result_content = mysqli_query($conn, $search_content);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_content)) {
            $data[] = $row;
        }

        while ($row = mysqli_fetch_assoc($result_account)) {
            $data[] = $row;
        }
        
        echo json_encode($data);
    }

    function searchResult($keyword){
        global $conn;
        $search_account = "SELECT * FROM account acc WHERE username LIKE '%$keyword%' OR nama_lengkap LIKE '%$keyword%';";
        $search_content = "SELECT * FROM content WHERE stats = 'ACCEPT' AND judul LIKE '%$keyword%';";

        $result_account = mysqli_query($conn, $search_account);
        $result_content = mysqli_query($conn, $search_content);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_content)) {
            $data[] = $row;
        }

        while ($row = mysqli_fetch_assoc($result_account)) {
            $data[] = $row;
        }

        return $data;
    }

    function adminSearchAccount($keyword){
        global $conn;
        $search_account = "SELECT * FROM account acc WHERE username LIKE '%$keyword%' OR nama_lengkap LIKE '%$keyword%';";

        $result_account = mysqli_query($conn, $search_account);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_account)) {
            $data[] = $row;
        }

        return $data;
    }

    function adminSearchPermission($keyword){
        global $conn;
        $search_permission = "SELECT * FROM content WHERE stats = 'PENDING' AND LIKE '%$keyword%';";

        $result_permission = mysqli_query($conn, $search_permission);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_permission)) {
            $data[] = $row;
        }

        return $data;
    }

    function adminSearchContent($keyword){
        global $conn;
        $search_content = "SELECT * FROM content WHERE stats = 'ACCEPT' AND judul LIKE '%$keyword%';";

        $result_content = mysqli_query($conn, $search_content);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_content)) {
            $data[] = $row;
        }

        return $data;
    }

    function userSearchConntent($keyword){
        global $conn;

        $search_content = "SELECT * FROM content WHERE stats = 'ACCEPT' AND judul LIKE '%$keyword%'";

        $result_content = mysqli_query($conn, $search_content);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_content)) {
            $data[] = $row;
        }

        return $data;
    }

    function userSearchChat($keyword){
        global $conn;
        $sesi = $_SESSION["username"];
        $chat = [];
        $select_history = mysqli_query($conn, "SELECT DISTINCT 
                                                    CASE 
                                                        WHEN pengirim = '$sesi' THEN penerima 
                                                        ELSE pengirim 
                                                    END AS lawan_chat
                                                FROM chat
                                                WHERE (pengirim = '$sesi' OR penerima = '$sesi')
                                                  AND (pengirim LIKE '%$keyword%' OR penerima LIKE '%$keyword%');");
        while ($row = mysqli_fetch_assoc($select_history)){
            if ($row["lawan_chat"] != $_SESSION["username"]){
                $chat[] = $row;
            }
        }
        return $chat;
    }

?>

<?php if (isset($type)):?>
    <?php if ($type == "SearchAccount"):?>
        <table border=1 id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Pengguna</th>
                    <th>Surel</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($akun as $acc): ?>
                <?php $direktori = "../databases/profile/" . $acc["foto"];?>
                <tr>
                    <td><?php echo $i . ".";?></td>
                    <td><?php if ($acc["foto"] == "") {echo"<img src='../assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='$direktori' alt='profile' class='nav-profile-picture'>";}?></td>
                    <td><?php echo $acc["username"]?></td>
                    <td><?php echo $acc["email"]?></td>
                    <td>
                        <div class="action-button">
                            <a href="../profile.php?user=<?= $acc["username"]?>">
                                <button class="edit-icon">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            <a href="../databases/query.php?delete=true&session=admin&username=<?php echo $acc['username']?>" onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                <button class="delete-icon">
                                    <i class="fa-light fa-trash-can"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; endforeach;?>
            </tbody>
        </table>

    <?php elseif ($type == "SearchPermission"):?>
        <table border=1 id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tampilan</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Nama Pengguna</th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($lagu as $lagu): ?>
                <?php $direktori = "../databases/thumbnail/" . $lagu["thumbnail"];?>
                <?php $direktori_lagu = "../databases/music/". $lagu["lagu"];?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo "<img src='$direktori' alt='' class='thumbnail-user'>";?></td>
                    <td><?php echo $lagu["judul"]?></td>
                    <td><?php echo $lagu["deskripsi"]?></td>
                    <td><?php echo $lagu["user"]?></td>
                    <td>
                        <div class="action-button">
                            <button class="edit-icon" onclick="open_confirm()">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <div class="confirm-container" id="confirm">
                    <div class="confirm-inner" id="inner">
                        <div class="upper">
                            <h2>Konfirmasi</h2>
                            <button class="close-confirm" onclick="close_confirm()">X</button>
                        </div>
                        <div class="lines"></div>
                        <div class="lower">
                            <h2>Judul</h2>
                            <audio class="audio-container" id="songAudio" controls>
                                <source src="<?php echo $direktori_lagu?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="permission-button">
                                <a href="../databases/query.php?acc=false&lagu=<?php echo $lagu['lagu']?>">
                                    <button class="rjc-btn">Tolak</button>
                                </a>
                                <a href="../databases/query.php?acc=true&lagu=<?php echo $lagu['lagu']?>">
                                    <button class="acc-btn">Terima</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; endforeach;?>
            </tbody>
        </table>

    <?php elseif ($type == "SearchContent"):?>
        <table border=1 id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tampilan</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Nama Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($lagu as $lagu): ?>
                <?php $direktori = "../databases/thumbnail/" . $lagu["thumbnail"];?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo "<img src='$direktori' alt='thumbnail-picture' class='thumbnail-user'>";?></td>
                    <td><?php echo $lagu["judul"]?></td>
                    <td><?php echo $lagu["deskripsi"]?></td>
                    <td><?php echo $lagu["user"]?></td>
                    <td>
                        <div class="action-button">
                            <a href="../detail.php?lagu=<?= $lagu["lagu"]?>">
                                <button class="edit-icon">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            <a href="../databases/query.php?delete_lagu=true&session=admin&lagu=<?php echo $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                                <button class="delete-icon">
                                    <i class="fa-light fa-trash-can"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; endforeach;?>
            </tbody>
        </table>

    <?php endif;?>
<?php endif;?>

<?php if (isset($userAction)):?>
    <?php if ($userAction == "userContent"):?>
    
            <?php foreach($lagu as $lagu):?>
            <div class="music-card">
                <img src="<?= "databases/thumbnail/" . $lagu["thumbnail"]?>" alt="Thumbnail" class="thumbnail-user">
                <div class="music-info">
                    <?php $jdl = overflow($lagu["judul"], 10);?>
                    <h2 class="music-title"><?= $jdl?></h2>
                
                    <?php $desk = overflow($lagu["deskripsi"], 18);?>
                    <p class="music-description"><?= $desk?></p>
                </div>
                <div class="action-buttons">
                    <div class="edit-button" title="Edit" id="music+<?= $lagu['lagu']?>" onclick="open_slide('musicEdit'); closep('music'); closep('setting')">
                        <i class="fa-solid fa-pen-to-square" id="music+<?= $lagu['lagu']?>" onclick="open_slide('musicEdit'); closep('music'); closep('setting')"></i>
                    </div>
                    <form action="databases/query.php?delete_lagu=true&lagu=<?= $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')"  title="Hapus">
                        <button type="submit" class="delete-button"><i class="fa-light fa-trash-can"></i></button>

                    </form>
                </div>
            </div>
            <?php endforeach;?>

    <?php elseif ($userAction == "userChat"):?>
        <p>Riwayat Pesan</p> <br>
        <?php foreach($history_chat as $hist):?> 
            <?php $lastChat = select_chat($conn, "false", $_SESSION["username"], $hist["lawan_chat"]); ?>
            <div class="chat-item" onclick="open_slide('chat'); closep('history_chat')" id="pchat_<?= $hist['lawan_chat']?>">
              <div class="chat-item-profile" id="pchat_<?= $hist['lawan_chat']?>">
                <?php $akunChat = select_akun($conn, $hist["lawan_chat"]);?>
                <?php if ($akunChat["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' >";} else {echo"<img src='databases/profile/" . $akunChat["foto"] . "' alt='profile'>";}?>
              </div>
              <div class="chat-item-content" id="pchat_<?= $hist['lawan_chat']?>">
                <div class="chat-item-name" id="pchat_<?= $hist['lawan_chat']?>"><?= $hist["lawan_chat"]?></div>
                  <div class="chat-item-message" id="pchat_<?= $hist['lawan_chat']?>">
                    <?php $formattedText = overflow($lastChat[count($lastChat) - 1]["isi"], 65);?>
                    <?= $formattedText?>
                  </div>
                <div class="chat-item-time" id="pchat_<?= $hist['lawan_chat']?>"><?= $lastChat[count($lastChat) - 1]["waktu"]?></div>
              </div>
            </div>
            <?php endforeach;?>
        <?php endif;?>
<?php endif;?>
