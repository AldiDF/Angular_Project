<?php
    require "connection.php";

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
                <?php $direktori = "../databases/profile_picture/" . $acc["foto"];?>
                <tr>
                    <td><?php echo $i . ".";?></td>
                    <td><?php if ($acc["foto"] == "") {echo "<i class='fa-light fa-circle-user' style='font-size: 50px;'></i>";} else {echo "<img src='$direktori' alt='profile-picture' class='profile-user'>";}?></td>
                    <td><?php echo $acc["username"]?></td>
                    <td><?php echo $acc["email"]?></td>
                    <td>
                        <div class="action-button">
                            <button class="edit-icon">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
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
                            <button class="edit-icon">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
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
