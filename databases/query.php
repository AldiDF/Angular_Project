<?php
    session_start();
    require "connection.php";
    
    $count = 0;
    
    function check_duplikat_akun($conn, $username){
        $sql_select_akun = mysqli_query($conn, "SELECT * FROM account");
        $count = 0;
        while ($row = mysqli_fetch_assoc($sql_select_akun)) {
            $akun[] = $row; 

            if ($akun[$count]["username"] == $username){
                echo "
                <script>
                    alert('Gagal Mendaftar, username sudah tersedia');
                    document.location.href = '../index.php';
                </script>
                ";
                exit;
            }
            $count++;
        }
    }

    function insert_akun($username, $nama_lengkap, $email, $password, $conn){
        check_duplikat_akun($conn, $username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert_akun = mysqli_query($conn, "INSERT INTO account VALUES ('$username', '$nama_lengkap', '$email', '$password', '', '', 'PUBLIK');");
        if ($sql_insert_akun) {
            echo "
                <script>
                    alert('Berhasil Membuat Akun');
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal Membuat Akun');
                    document.location.href = '../index.php';
                </script>
            ";
        }
    }
    
    function login($username, $password, $conn){
        $sql_select_akun = mysqli_query($conn, "SELECT * FROM account");

        if ($username == "admin" && $password == "admin"){
            $_SESSION["admin"] = true;
            echo "
                <script>
                    alert('Login Berhasil');
                    document.location.href = '../index.php';
                </script>
            ";
            exit;
        }

        $count = 0;
        while ($row = mysqli_fetch_assoc($sql_select_akun)){
            $akun[] = $row;
            if ($akun[$count]["username"] == $username && password_verify($password, $akun[$count]["password"])){
                $_SESSION["user"] = true;
                $_SESSION["username"] = $akun[$count]["username"];
                echo "
                    <script>
                        alert('Login Berhasil');
                        document.location.href = '../index.php';
                    </script>
                ";

                exit;
                
            } 
            $count ++;
        }

        echo "
            <script>
                alert('Gagal Login, email atau password salah');
                document.location.href = '../index.php';
            </script>
        ";
        exit;
    }

    function select_akun($conn, $where){
        if ($where == ""){
            $select_akun = mysqli_query($conn, "SELECT * FROM account");
            $akun = [];
            while ($row = mysqli_fetch_assoc($select_akun)){
                $akun[] = $row; 
            }
            return $akun;
            
        } else {
            // $akun;
            $select_akun = mysqli_query($conn, "SELECT * FROM account WHERE username = '$where'");
            $akun = mysqli_fetch_assoc($select_akun);
            return $akun;
        }
    }

    function select_lagu($conn, $where, $username){
        $lagu = [];
        if ($where == "PENDING"){
            $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats ='$where'");
            while ($row = mysqli_fetch_assoc($select_lagu)){
                $lagu[] = $row; 
            }
            return $lagu;

        } else if ($where == "ACCEPT"){
            if ($username == ""){
                $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats = '$where'");
                while ($row = mysqli_fetch_assoc($select_lagu)){
                    $lagu[] = $row; 
                }
                return $lagu;
            } else {
                $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats = '$where' AND user = '$username'");
                while ($row = mysqli_fetch_assoc($select_lagu)){
                    $lagu[] = $row; 
                }
                return $lagu;
            }
        }
    }

    function select_lagu_spesifik($conn, $lagu){
        $lagu;
        $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats ='ACCEPT' AND lagu = '$lagu'");
        $lagu = mysqli_fetch_assoc($select_lagu);
        return $lagu;
        
    }

    function insert_lagu($conn, $where){
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H.i.s");

        $judul = $_POST["title"];
        $lirik = $_POST["lyrics"];
        $deskripsi = $_POST["description"];
        $lagu = $_FILES["music"]["name"];
        $thumbnail = $_FILES["thumbnail"]["name"];
        $tmp_lagu = $_FILES["music"]["tmp_name"];
        $tmp_thumbnail = $_FILES["thumbnail"]["tmp_name"];

        $akun = select_akun($conn, $where);
        $ekstensi_lagu = explode('.', $lagu);
        $ekstensi_lagu = strtolower(end($ekstensi_lagu));

        $ekstensi_thumbnail = explode('.', $thumbnail);
        $ekstensi_thumbnail = strtolower(end($ekstensi_thumbnail));
        $tmp_thumbnail = $_FILES["thumbnail"]["tmp_name"];

        $username = $akun["username"]; 
        $namaBaru_lagu = $username . "_" . $waktu . "." . $ekstensi_lagu;
        $namaBaru_thumbnail = $username . "_" . $waktu . "." . $ekstensi_thumbnail;
        $direktori_lagu = 'music/' . $namaBaru_lagu;
        $direktori_thumbnail = 'thumbnail/' . $namaBaru_thumbnail;
        $status = "PENDING";

        if (is_uploaded_file($tmp_lagu) && is_uploaded_file($tmp_thumbnail)) {
            if (move_uploaded_file($tmp_lagu, $direktori_lagu) && move_uploaded_file($tmp_thumbnail, $direktori_thumbnail)) {
                $query = "
                INSERT INTO content (lagu, thumbnail, judul, lirik, deskripsi, stats, user) 
                VALUES ('$namaBaru_lagu', '$namaBaru_thumbnail','$judul', '$lirik', '$deskripsi', '$status' ,'$username')";
                $result = mysqli_query($conn, $query);
    
                if ($result) {
                    echo "<script>alert('Berhasil menambah lagu!'); document.location.href = '../index.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambah lagu!'); document.location.href = '../index.php';</script>";
                }
            } else {
                echo "<script>alert('Gagal meng-upload lagu!');</script>";
            }
        }
    }

    function delete_akun($conn, $username, $session){
        $query = "SELECT * FROM content WHERE user = '$username'";
        $result = mysqli_query($conn, $query);
        $lagu = [];
        while ($row = mysqli_fetch_assoc($result)){
            $lagu[] = $row;
            $image_path = '../databases/thumbnail/' . $lagu['thumbnail'];
            $song_path = '../databases/music/' . $lagu['lagu'];
            if(file_exists($image_path)){
                unlink($image_path);
            }
            if(file_exists($song_path)){
                unlink($song_path);
            }
        }

        $delete_akun = mysqli_query($conn, "DELETE FROM account WHERE username = '$username'");
        if ($session == "admin") {
            if ($delete_akun){
                echo "
                    <script>
                        alert('Akun berhasil dihapus');
                        document.location.href = '../admin/manage_account.php';
                    </script>
                ";

            } else {
                echo "
                <script>
                    alert('Akun gagal dihapus');
                    document.location.href = '../admin/manage_account.php';
                </script>
            ";
            }
        } else {
            if ($delete_akun){
                echo "
                    <script>
                        alert('Akun berhasil dihapus');
                        document.location.href = '../index.php';
                    </script>
                ";

            } else {
                echo "
                <script>
                    alert('Akun gagal dihapus');
                    document.location.href = '../index.php';
                </script>
            ";
            }
        }
    }

    function select_pesan($conn, $penerima, $pengirim){
        $select_pesan = mysqli_query($conn, "SELECT * FROM chat WHERE pengirim = '$pengirim' AND penerima = '$penerima'");
        $pesan = mysqli_fetch_assoc($select_pesan);
        return $pesan;
    }

    function update_status_content($conn, $stats, $lagu){
        if ($stats == "ACCEPT"){
            $update_status = mysqli_query($conn, "UPDATE content SET stats = '$stats' WHERE lagu = '$lagu'");
            if ($update_status){
                date_default_timezone_set("Asia/Makassar");
                $waktu = date("Y-m-d H.i.s");
                $judul = mysqli_query($conn, "SELECT judul FROM content where lagu='$lagu'");
                $user = mysqli_query($conn, "SELECT user FROM content where lagu='$lagu'");
                $pesan = "Lagu anda yang berjuful ".$judul." telah disetujui";
                mysqli_query($conn, "INSERT INTO notification VALUES (0,'$pesan', '$user', '$waktu')");
                echo "
                    <script>
                        alert('Berhasil mengubah status');
                        document.location.href = '../admin/manage_permission.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal mengubah status');
                        document.location.href = '../admin/manage_permission.php';
                    </script>
                ";
            }
        } else {
            $song = mysqli_query ($conn, "SELECT lagu FROM content WHERE lagu = '$lagu'");
            $image = mysqli_query ($conn, "SELECT thumbnail FROM content WHERE lagu = '$lagu'");
            $song_path = "../databases/music/".$song;
            $image_path = "../databases/thumbnail/".$image;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            if(file_exists($song_path)){
                unlink($song_path);
            }
            $update_status = mysqli_query($conn, "DELETE FROM content  WHERE lagu = '$lagu'");
            if ($update_status){
                echo "
                    <script>
                        alert('Berhasil mengubah status');
                        document.location.href = '../admin/manage_permission.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal mengubah status');
                        document.location.href = '../admin/manage_permission.php';
                    </script>
                ";
            }
        }
    }

    function action_like($conn, $lagu, $username, $status){
        if ($status){
            $action = mysqli_query($conn, "INSERT INTO like_content VALUES (0, '$lagu', '$username');");
            $pesan = $username." Telah Menyukai Lagu Anda";
            $orang = select_lagu_spesifik($conn, $lagu);
            date_default_timezone_set("Asia/Makassar");
            $waktu = date("Y-m-d H.i.s");
            mysqli_query($conn, "INSERT INTO notification VALUES (0,'$pesan', '$orang', '$waktu'); ");

        } else {
            $action = mysqli_query($conn, "DELETE FROM like_content WHERE objek = '$lagu' AND subjek = '$username';");
        }

        if ($action){
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        }
    }

    function insert_komen($conn){
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H:i");
        $komen = $_POST["send-comment"];
        $lagu = $_POST["lagu"];
        $username = $_POST["username"];
        $query = "INSERT INTO comment VALUES (0, '$komen', '$waktu', '$lagu', '$username')";
        $result = mysqli_query($conn, $query);
        if ($result){
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        }
    }

    function select_komen($conn, $lagu, $last){
        if ($last == true){
            // $komen;
            $select_komen = mysqli_query($conn, "SELECT * FROM comment WHERE lagu = '$lagu' ORDER BY id DESC LIMIT 1");
            $komen = mysqli_fetch_assoc($select_komen);
            echo json_encode($komen);
            return;
            
        } else if ($last == false){
            $select_komen = mysqli_query($conn, "SELECT * FROM comment WHERE lagu = '$lagu'");
            $komen = [];
            while ($row = mysqli_fetch_assoc($select_komen)){
                $komen[] = $row;
            }
            
            return $komen;
        }

    } 

    function delete_komen($conn){
        $id = $_GET["commentId"];
        $lagu = $_GET["lagu"];
        $delete_komen = mysqli_query($conn, "DELETE FROM comment WHERE id = '$id'");
        if ($delete_komen){
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../detail.php?lagu=$lagu';
                </script>
            ";
        }
    }

    function select_like($conn, $lagu, $username){
        // $like;
        $select_like = mysqli_query($conn, "SELECT * FROM like_content WHERE objek = '$lagu' AND subjek = '$username'");
        $like = mysqli_num_rows($select_like);
        return $like;
    }

    function num_row($conn, $table, $column, $where){
        $query = "SELECT * FROM $table WHERE $column = '$where'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function status_account($conn, $status){
        $username = $_GET["akun"];
        $status_akun = mysqli_query($conn, "UPDATE account SET stats = '$status' WHERE username = '$username'");
        if ($status_akun){
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        }
    }

    function follow_action($conn){
        $follow = $_GET["follow"];
        $object = $_GET["objek"];
        $subject = $_GET["subjek"];

        if ($follow == "true"){
            $query = mysqli_query($conn, "INSERT INTO follow (objek, subjek) VALUES ('$object', '$subject')");
            date_default_timezone_set("Asia/Makassar");
            $waktu = date("Y-m-d H.i.s");
            $pesan = $subject." Telah mengikuti anda";
            mysqli_query($conn, "INSERT INTO notification VALUES (0,'$pesan', '$object', '$waktu')");

            if($query){
                echo "
                    <script>
                        document.location.href = '../profile.php?user=$object';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        document.location.href = '../profile.php?user=$object';
                    </script>
                ";
            }

        } else if ($follow == "false"){
            $query = mysqli_query($conn, "DELETE FROM follow WHERE objek = '$object' AND subjek = '$subject'");

            if($query){
                echo "
                    <script>
                        document.location.href = '../profile.php?user=$object';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        document.location.href = '../profile.php?user=$object';
                    </script>
                ";
            }
        }
    }

    function insert_chat($conn){
        $penerima = $_POST["penerima"];
        $pengirim = $_POST["pengirim"];
        $pesan = $_POST["pesan"];
        $waktu = $_POST["waktu"];
        $query = "INSERT INTO chat VALUES (0, '$pesan', '$waktu', '$penerima', '$pengirim' )";
        $result = mysqli_query($conn, $query);
        if ($result){
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        }
    }

    function select_chat($conn, $last, $user1, $user2){
        if ($last == "true"){
            $select_chat = mysqli_query($conn, "SELECT * FROM chat WHERE (penerima = '$user1' AND pengirim = '$user2') OR (penerima = '$user2' AND pengirim = '$user1') ORDER BY id DESC LIMIT 1");
            $chat = mysqli_fetch_assoc($select_chat);

            echo json_encode($chat);
            return;

        } else if ($last == "false"){
            $chat = [];
            $select_chat = mysqli_query($conn, "SELECT * FROM chat WHERE (penerima = '$user1' AND pengirim = '$user2') OR (penerima = '$user2' AND pengirim = '$user1') ORDER BY id ASC;");
            while ($row = mysqli_fetch_assoc($select_chat)){
                $chat[] = $row;
            }
            return $chat;

        } else if ($last == ""){
            $chat = [];
            $select_history = mysqli_query($conn, "SELECT DISTINCT 
                                                    CASE 
                                                        WHEN pengirim = '$user1' THEN penerima 
                                                        ELSE pengirim 
                                                    END AS lawan_chat
                                                FROM chat
                                                WHERE pengirim = '$user1' OR penerima = '$user1';");
            while ($row = mysqli_fetch_assoc($select_history)){
                $chat[] = $row;
            }
            return $chat;
        }
    }

    function total_like($conn, $username){
        $query = "SELECT * FROM like_content WHERE objek LIKE '%$username%'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function checkFollow($conn, $objek, $subjek){
        $query = "SELECT * FROM follow WHERE objek = '$objek' AND subjek = '$subjek'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function select_follow($conn, $username, $where){
        if ($where == "following"){
            $query = "SELECT * FROM follow WHERE subjek = '$username'";
            $result = mysqli_query($conn, $query);
            return $result;

        } else if ($where == "follower"){
            $query = "SELECT * FROM follow WHERE objek = '$username'";
            $result = mysqli_query($conn, $query);
            return $result;
        }
    }

    function editAkun($conn, $username, $fullName, $email, $newPassword = null) {
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE account SET 
                        nama_lengkap = '$fullName', 
                        email = '$email', 
                        password = '$hashedPassword' 
                      WHERE username = '$username'";
        } else {
            $query = "UPDATE account SET 
                        nama_lengkap = '$fullName', 
                        email = '$email' 
                      WHERE username = '$username'";
        }
    
        $result = mysqli_query($conn, $query);
        if($result){
            echo "
            <script>
                alert('Akun Berhasil diperbarui');
                document.location.href = '../index.php';
            </script>
            ";
        }else{
            echo "
            <script>
                alert('Gagal Memperbarui akun');
                document.location.href = '../index.php';
            </script>
            ";
        }
    }

    function update_lagu($conn, $lagu) {
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H.i.s");
    
        $judul = $_POST["title"];
        $lirik = $_POST["lyrics"];
        $deskripsi = $_POST["description"];
        $thumbnail = $_FILES["thumbnail"]["name"];
        $tmp_thumbnail = $_FILES["thumbnail"]["tmp_name"];
    
        $query_check = "SELECT * FROM content WHERE lagu = '$lagu'";
        $result_check = mysqli_query($conn, $query_check);
    
        if (mysqli_num_rows($result_check) == 0) {
            echo "<script>alert('Lagu tidak ditemukan!'); document.location.href = '../index.php';</script>";
            return;
        }
    
        $data = mysqli_fetch_assoc($result_check);
        $thumbnail_lama = $data['thumbnail']; 
        $username = $data['user']; 
    

        $namaBaru_thumbnail = "";
        if (!empty($thumbnail)) {
            $ekstensi_thumbnail = explode('.', $thumbnail);
            $ekstensi_thumbnail = strtolower(end($ekstensi_thumbnail));
            $namaBaru_thumbnail = $username . "_" . $waktu . "." . $ekstensi_thumbnail;
            $direktori_thumbnail = 'thumbnail/' . $namaBaru_thumbnail;
    

            if (file_exists("thumbnail/" . $thumbnail_lama)) {
                unlink("thumbnail/" . $thumbnail_lama);
            }

            if (!move_uploaded_file($tmp_thumbnail, $direktori_thumbnail)) {
                echo "<script>alert('Gagal meng-upload thumbnail baru!');</script>";
                return;
            }
        }
    
        $query = "UPDATE content SET judul = '$judul', lirik = '$lirik', deskripsi = '$deskripsi'";
    
        if (!empty($thumbnail)) {
            $query .= ", thumbnail = '$namaBaru_thumbnail'";
        }
    
        $query .= " WHERE lagu = '$lagu'";
    
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            echo "<script>alert('Berhasil memperbarui lagu!'); document.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui lagu!');</script>";
        }
    }
    

    function delete_notif($conn, $id){
        $query = mysqli_query($conn, "SELECT FROM notification WHERE id = '$id'");
        if($query){
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        }
    }

    function deleteall_notif($conn, $username){
        $query = mysqli_query($conn, "SELECT FROM notification WHERE username = '$username'");
        if($query){
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../index.php';
                </script>
            ";
        }
    }

    function select_notif ($conn, $username){
        $notif = [];
        $select_notif = mysqli_query($conn, "SELECT * FROM notification WHERE (username = '$username' ORDER BY id DESC;");
        while ($row = mysqli_fetch_assoc($select_notif)){
            $notif[] = $row;
        }
        return $notif;
    }

    if (isset($_POST["signup"])){
        insert_akun($_POST["username"], $_POST["full-name"], $_POST["email"], $_POST["password"], $conn);
        
    } else if (isset($_POST["login"])){
        login($_POST["username"], $_POST["password"], $conn);
        
    } else if (isset($_GET["logout"])){
        session_unset();
        session_destroy();
        echo "
        <script>
            alert('Anda telah logout');
            document.location.href = '../index.php';
        </script>
        ";
        
    } else if (isset($_GET["delete"])){
        delete_akun($conn, $_GET["username"], $_GET["session"]);

    } else if (isset($_POST["upload-music"])){
        insert_lagu($conn, $_GET["username"]);
    
    } else if (isset($_GET["acc"])){
        if ($_GET["acc"] == "false"){
            update_status_content($conn, "REJECT", $_GET["lagu"]);
        } else if ($_GET["acc"] == "true"){
            update_status_content($conn, "ACCEPT", $_GET["lagu"]);
        }

    } else if (isset($_GET["delete_lagu"])){
        $lagu_user = $_GET["lagu"];
        $query = "SELECT * FROM content WHERE lagu = '$lagu_user'";
        $result = mysqli_query($conn, $query);
        $lagu = mysqli_fetch_assoc($result);
        $user = $lagu['user'];
        $juduls = $lagu['judul'];
        $waktu = date('Y-m-d H.i.s');
        
        if($lagu){
            $image_path = '../databases/thumbnail/' . $lagu['thumbnail'];
            $song_path = '../databases/music/' . $lagu['lagu'];
            if(file_exists($image_path)){
                unlink($image_path);
            }
            if(file_exists($song_path)){
                unlink($song_path);
            }
        }

        $delete_query = "DELETE FROM content WHERE lagu = '$lagu_user'";
        if (mysqli_query($conn, $delete_query)) {

            echo "<script>
                    alert('Lagu Telah Dihapus');
                    document.location.href = '../admin/manage_music.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal Menghapus lagu');
                    document.location.href = '../admin/manage_music.php';
                  </script>";
        }

    } else if (isset($_GET["comment"])){
        insert_komen($conn);

    } else if (isset($_GET["send-like"])){
        action_like($conn, $_POST["lagu"], $_POST["username"], true);

    } else if (isset($_GET["cancel-like"])){
        action_like($conn, $_POST["lagu"], $_POST["username"], false);

    } else if (isset($_GET["last"])){
        select_komen($conn, $_GET["lagu"], true);

    } else if (isset($_GET["commentDelete"])){
        delete_komen($conn);

    } else if (isset($_POST["private"])){
        $status = "PRIVATE";
        status_account($conn, $status);
        
    } else if (isset($_POST["public"])){
        $status = "PUBLIK";
        status_account($conn, $status);

    } else if (isset($_GET["follow"])){
        follow_action($conn);
    } else if (isset($_POST['edit-account'])) {
        $username = $_SESSION['username']; 
        $fullName = $_POST['full-name'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
    
        echo editAkun($conn, $username, $fullName, $email, $password);
    } else if(isset($_POST['edit-music'])) {
        update_lagu($conn, $_POST['lagu']);
    } else if(isset ($_GET['id-notif'])) {
        delete_notif ($conn, $_GET['id']);
    } else if(isset ($_GET['delete-all-notif'])) {
        deleteall_notif ($conn, $_SESSIONp['username']);
    } else if (isset($_GET["chat"])){
        insert_chat($conn);

    } else if (isset($_GET["last-chat"])){
        $last = $_GET["last-chat"];
        if ($last == "true"){
            select_chat($conn, "true", $_POST["session"], $_POST["penerima"]);
        }
    }
?>