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
        $username = mysqli_real_escape_string($conn, $username);
        $nama_lengkap = mysqli_real_escape_string($conn, $nama_lengkap);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        check_duplikat_akun($conn, $username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert_akun = mysqli_query($conn, "INSERT INTO account VALUES ('$username', '$nama_lengkap', '$email', '$password', '', '', 'PUBLIK');");
        if ($sql_insert_akun) {
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
    
    function login($username, $password, $conn){
        $sql_select_akun = mysqli_query($conn, "SELECT * FROM account");

        $count = 0;
        while ($row = mysqli_fetch_assoc($sql_select_akun)){
            $akun[] = $row;
            if ($akun[$count]["username"] == $username && password_verify($password, $akun[$count]["pasword"])){
                if ($username == "HexaAdmin" && $password == "admin123"){
                    $_SESSION["admin"] = true;
                    $_SESSION["username"] = $akun[$count]["username"];
                    echo "
                        <script>
                            document.location.href = '../index.php';
                        </script>
                    ";
                    exit;
                }
                $_SESSION["user"] = true;
                $_SESSION["username"] = $akun[$count]["username"];
                echo "
                    <script>
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
                if ($row["username"] != "HexaAdmin"){
                    $akun[] = $row; 
                }
            }
            return $akun;
            
        } else {
            $where = mysqli_real_escape_string($conn, $where);
            $akun;
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
                $username = mysqli_real_escape_string($conn, $username);
                $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats = '$where' AND user = '$username' ORDER BY lagu DESC");
                while ($row = mysqli_fetch_assoc($select_lagu)){
                    $lagu[] = $row; 
                }
                return $lagu;
            }
        }
    }

    function select_lagu_spesifik($conn, $lagu){
        $lagu = mysqli_real_escape_string($conn, $lagu);
        $select_lagu = mysqli_query($conn, "SELECT * FROM content WHERE stats ='ACCEPT' AND lagu = '$lagu'");
        $lagu = mysqli_fetch_assoc($select_lagu);
        return $lagu;
        
    }

    function insert_lagu($conn, $where){
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H.i.s");

        $judul = $_POST["title"];
        $lirik = $_POST["lyrics"];
        $deskripsi = mysqli_real_escape_string($conn, $_POST["description"]);
        
        $lagu = $_FILES["music"]["name"];
        $thumbnail = $_FILES["thumbnail"]["name"];
        $tmp_lagu = $_FILES["music"]["tmp_name"];
        $tmp_thumbnail = $_FILES["thumbnail"]["tmp_name"];

        $akun = select_akun($conn, $where);
        $ekstensi_lagu = explode('.', $lagu);
        $ekstensi_lagu = strtolower(end($ekstensi_lagu));

        $nama_lirik = "lyrics/" . $akun["username"] . "_" . $judul . "_" . $waktu . ".lrc";
        $file_lirik = fopen($nama_lirik, "w");
        if ($file_lirik){
            fwrite($file_lirik, $lirik);

            fclose($file_lirik);
        } else {
            echo "<script> alert('Gagal mengupload lirik!');
            </script>";
        }

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
                $namaBaru_lagu = mysqli_real_escape_string($conn, $namaBaru_lagu);
                $namaBaru_thumbnail = mysqli_real_escape_string($conn, $namaBaru_thumbnail);
                $username = mysqli_real_escape_string($conn, $username);
                $nama_lirik = mysqli_real_escape_string($conn, $nama_lirik);
                $judul = mysqli_real_escape_string($conn, $judul);
                $query = "
                INSERT INTO content (lagu, thumbnail, judul, lirik, deskripsi, stats, user) 
                VALUES ('$namaBaru_lagu', '$namaBaru_thumbnail','$judul', '$nama_lirik', '$deskripsi', '$status' ,'$username')";
                $result = mysqli_query($conn, $query);
    
                if ($result) {
                    echo "<script>document.location.href = '../index.php';</script>";
                } else {
                }
            } else {
                echo "<script>alert('Gagal meng-upload lagu!');</script>";
            }
        }
    }

    function delete_akun($conn, $username, $session){
        $username = mysqli_real_escape_string($conn, $username);

        $query = "SELECT * FROM content WHERE user = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $image_path = 'thumbnail/' . $row['thumbnail'];
                $song_path = 'music/' . $row['lagu'];

                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                if (file_exists($song_path)) {
                    unlink($song_path);
                }
                if (file_exists($row['lirik'])){
                    unlink($row['lirik']);
                }
            }
        }
        $akun = select_akun($conn, $username);
        if($akun["foto"] != "" || $akun["foto"] != null){
            unlink("profile/" . $akun["foto"]);
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
                session_unset();
                session_destroy();
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
        $penerima = mysqli_real_escape_string($conn, $penerima);
        $pengirim = mysqli_real_escape_string($conn, $pengirim);
        $select_pesan = mysqli_query($conn, "SELECT * FROM chat WHERE pengirim = '$pengirim' AND penerima = '$penerima'");
        $pesan = mysqli_fetch_assoc($select_pesan);
        return $pesan;
    }

    function update_status_content($conn, $stats, $lagu){
        $lagu = mysqli_real_escape_string($conn, $lagu);
        if ($stats == "ACCEPT"){
            
            $update_status = mysqli_query($conn, "UPDATE content SET stats = '$stats' WHERE lagu = '$lagu'");
            
            if ($update_status) {
                
                date_default_timezone_set("Asia/Makassar");
                $waktu = date("Y-m-d H.i.s");
    
                
                $judul_result = mysqli_query($conn, "SELECT judul FROM content WHERE lagu='$lagu'");
                $judul_row = mysqli_fetch_assoc($judul_result); 
                $judul = $judul_row['judul'];
                $judul = mysqli_real_escape_string($conn, $judul);
    
                
                $user_result = mysqli_query($conn, "SELECT user FROM content WHERE lagu='$lagu'");
                $user_row = mysqli_fetch_assoc($user_result); 
                $user = $user_row['user'];
                $user = mysqli_real_escape_string($conn, $user);
    
                
                $pesan = "Lagu anda yang berjudul $judul telah disetujui";
    
                
                mysqli_query($conn, "INSERT INTO notification VALUES (0, '$pesan', '$user', '$waktu')");
    
                
                echo "
                <script>
                        document.location.href = '../admin/manage_permission.php';
                </script>
                ";
            } else {
                
                echo "
                    <script>
                        document.location.href = '../admin/manage_permission.php';
                    </script>
                ";
            }
        } else if($stats == "REJECT") {
            
            $song_result = mysqli_query($conn, "SELECT lagu FROM content WHERE lagu = '$lagu'");
            $image_result = mysqli_query($conn, "SELECT thumbnail FROM content WHERE lagu = '$lagu'");
            $lyrics_result = mysqli_query($conn, "SELECT lirik FROM content WHERE lagu = '$lagu'");
            
            $song_row = mysqli_fetch_assoc($song_result);  
            $image_row = mysqli_fetch_assoc($image_result);  
            $lyrics_row = mysqli_fetch_assoc($lyrics_result);  
    
            $song_path = "music/" . $song_row['lagu'];   
            $image_path = "thumbnail/" . $image_row['thumbnail'];
            $lyrics_path = $lyrics_row['lirik'];
            
            
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            if (file_exists($song_path)) {
                unlink($song_path);
            }
            if (file_exists($lyrics_path)){
                unlink($lyrics_path);
            }
            
            date_default_timezone_set("Asia/Makassar");
            $waktu = date("Y-m-d H.i.s");
    
            
            $judul_result = mysqli_query($conn, "SELECT judul FROM content WHERE lagu='$lagu'");
            $judul_row = mysqli_fetch_assoc($judul_result); 
            $judul = $judul_row['judul'];
    
            
            $user_result = mysqli_query($conn, "SELECT user FROM content WHERE lagu='$lagu'");
            $user_row = mysqli_fetch_assoc($user_result); 
            $user = $user_row['user'];

            $judul = mysqli_real_escape_string($conn, $judul);
            $user = mysqli_real_escape_string($conn, $user);
    
            
            $pesan = "Lagu anda yang berjudul $judul telah ditolak";
    
            
            mysqli_query($conn, "INSERT INTO notification VALUES (0, '$pesan', '$user', '$waktu')");
    
            
            $delete_status = mysqli_query($conn, "DELETE FROM content WHERE lagu = '$lagu'");
    
            if ($delete_status) {
                
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
        $username = mysqli_real_escape_string($conn, $username);
        $lagu = mysqli_real_escape_string($conn, $lagu);
        if ($status){
            $action = mysqli_query($conn, "INSERT INTO like_content VALUES (0, '$lagu', '$username');");
            $orang = select_lagu_spesifik($conn, $lagu);
            $pesan = $orang["judul"] . " : ". $username ." Telah Menyukai Lagu Anda "; ;
            $penerima_notif = $orang["user"];
            $pesan = mysqli_real_escape_string($conn, $pesan);
            date_default_timezone_set("Asia/Makassar");
            $waktu = date("Y-m-d H.i.s");
            $send_notif = mysqli_query($conn, "INSERT INTO notification VALUES (0,'$pesan', '$penerima_notif', '$waktu'); ");
            if ($action && $send_notif){
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

        } else {
            $action = mysqli_query($conn, "DELETE FROM like_content WHERE objek = '$lagu' AND subjek = '$username';");
            $lagu_objek = select_lagu_spesifik($conn, $lagu);
            $isi_pesan = $lagu_objek["judul"] . " : ". $username ." Telah Menyukai Lagu Anda ";
            $del_notif = mysqli_query($conn, "DELETE FROM notification WHERE isi_notif = '$isi_pesan'");
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

    }

    function insert_komen($conn){
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H:i");
        $komen = mysqli_real_escape_string($conn, $_POST["send-comment"]);
        $lagu = mysqli_real_escape_string($conn, $_POST["lagu"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);

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
        $lagu = mysqli_real_escape_string($conn, $lagu);
        if ($last == true){
            $komen;
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
        $lagu = mysqli_real_escape_string($conn, $_GET["lagu"]);
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

    function delete_lagu($conn){
        $lagu_user = mysqli_real_escape_string($conn, $_GET["lagu"]);


        $query = "SELECT * FROM content WHERE lagu = '$lagu_user'";
        $result = mysqli_query($conn, $query);
        $lagu = mysqli_fetch_assoc($result);
        $user = mysqli_real_escape_string($conn, $lagu['user']);
        $juduls = $lagu['judul'];

        $lirik = $lagu['lirik'];

        date_default_timezone_set("Asia/Makassar");
        $waktu = date('Y-m-d H.i.s');
        
        if($lagu){
            $image_path = 'thumbnail/' . $lagu['thumbnail'];
            $song_path = 'music/' . $lagu['lagu'];
            if(file_exists($image_path)){
                unlink($image_path);
            }
            if(file_exists($song_path)){
                unlink($song_path);
            }
            if(file_exists($lirik)){
                unlink($lirik);
            }
        }
        
        $delete_query = "DELETE FROM content WHERE lagu = '$lagu_user'";
        if (mysqli_query($conn, $delete_query)) {
            if (!isset($_SESSION["admin"])){
                echo "<script>
                alert('Lagu Telah Dihapus');
                document.location.href = '../index.php';
                </script>";
            } else {
                date_default_timezone_set("Asia/Makassar");
                $waktu = date("Y-m-d H.i.s");
                
                $pesan = "Lagu anda yang berjudul $juduls telah dihapus oleh admin";
                $pesan = mysqli_real_escape_string($conn, $pesan);
        
                
                mysqli_query($conn, "INSERT INTO notification VALUES (0, '$pesan', '$user', '$waktu')");
                echo "<script>
                        alert('Lagu Telah Dihapus');
                        document.location.href = '../admin/manage_music.php';
                      </script>";
            }
        } else {
            if (!isset($_SESSION["admin"])){
                echo "<script>
                    alert('Gagal Menghapus lagu');
                    document.location.href = '../index.php';
                  </script>";

            } else {
                echo "<script>
                    alert('Gagal Menghapus lagu');
                    document.location.href = '../admin/manage_music.php';
                  </script>";
            }
            
        }
    }

    function select_like($conn, $lagu, $username){
        $lagu = mysqli_real_escape_string($conn, $lagu);
        $username = mysqli_real_escape_string($conn, $username);
        $like;
        $select_like = mysqli_query($conn, "SELECT * FROM like_content WHERE objek = '$lagu' AND subjek = '$username'");
        $like = mysqli_num_rows($select_like);
        return $like;
    }

    function num_row($conn, $table, $column, $where){
        $where = mysqli_real_escape_string($conn, $where);
        $query = "SELECT * FROM $table WHERE $column = '$where'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function status_account($conn, $status){
        $username = mysqli_real_escape_string($conn, $_GET["akun"]);
        $status_akun = mysqli_query($conn, "UPDATE account SET stats = '$status' WHERE username = '$username'");
        if ($status_akun){
            return;
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
        $object = mysqli_real_escape_string($conn, $_GET["objek"]);
        $subject = mysqli_real_escape_string($conn, $_GET["subjek"]);
        if ($follow == "true"){
            $query = mysqli_query($conn, "INSERT INTO follow VALUES (0, '$object', '$subject')");
            
            if($query){
                $pesan = $subject." Telah Mengikuti Anda";
                $subject = mysqli_real_escape_string($conn, $pesan);
                date_default_timezone_set("Asia/Makassar");
                $waktu = date("Y-m-d H.i.s");
                mysqli_query($conn, "INSERT INTO notification VALUES (0,'$pesan', '$object', '$waktu'); ");
                
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
        $penerima = mysqli_real_escape_string($conn,$_POST["penerima"]);
        $pengirim = mysqli_real_escape_string($conn,$_POST["pengirim"]);
        $pesan = mysqli_real_escape_string($conn,$_POST["pesan"]);

        $waktu = $_POST["waktu"];
        $notif = $pengirim. " : " . $pesan;
        mysqli_query($conn, "INSERT INTO notification VALUES (0,'$notif', '$penerima', '$waktu'); ");
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
        $user1 = mysqli_real_escape_string($conn, $user1);
        $user2 = mysqli_real_escape_string($conn, $user2);
        if ($last == "true"){
            $chat;
            $select_chat = mysqli_query($conn, "SELECT * FROM chat WHERE (penerima = '$user1' AND pengirim = '$user2') OR (penerima = '$user2' AND pengirim = '$user1') ORDER BY id DESC LIMIT 1");
            $chat = mysqli_fetch_assoc($select_chat);

            echo json_encode($chat);
            return $chat;

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
        $username = mysqli_real_escape_string($conn,$username);
        $query = "SELECT 
        acc.username,
        lk.objek
        FROM account acc
        JOIN content ct ON ct.user = acc.username
        JOIN like_content lk ON lk.objek = ct.lagu
        WHERE acc.username = '$username'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function checkFollow($conn, $objek, $subjek){
        $objek = mysqli_real_escape_string($conn,$objek);
        $subjek = mysqli_real_escape_string($conn,$subjek);
        $query = "SELECT * FROM follow WHERE objek = '$objek' AND subjek = '$subjek'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    function select_follow($conn, $username, $where){
        $username = mysqli_real_escape_string($conn,$username);
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

    function editAkun($conn, $fullName, $email, $newPassword = null) {
        date_default_timezone_set("Asia/Makassar");

        $oldUsername = $_SESSION["username"];
        $akun = select_akun($conn, $oldUsername);
        $oldFoto = $akun["foto"];
        
        $foto = $_FILES["profile-pic"]["name"];
        $temp = $_FILES["profile-pic"]["tmp_name"];
        $deskripsi = mysqli_real_escape_string($conn,$_POST["desc"]);

        $ekstensi = explode('.', $foto);
        $ekstensi = strtolower(end($ekstensi));
        $namabaru = $_SESSION["username"] ."_". date("Y-m-d H.i.s") . "." . $ekstensi;
        $direktori = "profile/" . $namabaru;
        
        if (move_uploaded_file($temp, $direktori)){
            if($akun["foto"] != "" || $akun["foto"] != null){
                unlink("profile/" . $akun["foto"]);
            }
            $email = mysqli_real_escape_string($conn,$email);
            $fullName = mysqli_real_escape_string($conn,$fullName);
            $namabaru = mysqli_real_escape_string($conn,$namabaru);
            $oldUsername = mysqli_real_escape_string($conn,$oldUsername);
            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE account SET 
                            nama_lengkap = '$fullName', 
                            email = '$email', 
                            pasword = '$hashedPassword', 
                            deskripsi = '$deskripsi',
                            foto = '$namabaru'
                          WHERE username = '$oldUsername'";
            } else {
                $query = "UPDATE account SET 
                            nama_lengkap = '$fullName', 
                            email = '$email',
                            deskripsi = '$deskripsi',
                            foto = '$namabaru'
                          WHERE username = '$oldUsername'";
            }

            $result = mysqli_query($conn, $query);
            if($result){
                echo "
                <script>
                    document.location.href = '../index.php';
                </script>
                ";
            }else{
                echo "
                <script>
                    document.location.href = '../index.php';
                </script>
                ";
            }
        } else {
            $email = mysqli_real_escape_string($conn,$email);
            $fullName = mysqli_real_escape_string($conn,$fullName);
            $oldFoto = mysqli_real_escape_string($conn,$oldFoto);
            $oldUsername = mysqli_real_escape_string($conn,$oldUsername);
            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $query = "UPDATE account SET 
                            nama_lengkap = '$fullName', 
                            email = '$email', 
                            pasword = '$hashedPassword', 
                            deskripsi = '$deskripsi',
                            foto = '$oldFoto'
                          WHERE username = '$oldUsername'";
            } else {
                $query = "UPDATE account SET 
                            nama_lengkap = '$fullName', 
                            email = '$email',
                            deskripsi = '$deskripsi',
                            foto = '$oldFoto'
                          WHERE username = '$oldUsername'";
            }

            $result = mysqli_query($conn, $query);
            if($result){
                echo "
                <script>
                    document.location.href = '../index.php';
                </script>
                ";
            }else{
                echo "
                <script>
                    document.location.href = '../index.php';
                </script>
                ";
            }
        }
    }

    function update_lagu($conn, $lagu) {
        date_default_timezone_set("Asia/Makassar");
        $waktu = date("Y-m-d H.i.s");
    
        $lagu =$_GET["lagu"];
    
        $select_lagu = select_lagu_spesifik($conn, $lagu);
        $direktoriLama = $select_lagu["thumbnail"];    
    
        $judul = mysqli_real_escape_string($conn, $_POST["edit-title"]);
        $lirik_baru = $_POST["edit-lyrics"]; 
        $lirik = $select_lagu["lirik"];
        $deskripsi = mysqli_real_escape_string($conn, $_POST["edit-description"]);
        
        $thumbnail = $_FILES["input-Thumbnail"]["name"];
        $temp = $_FILES["input-Thumbnail"]["tmp_name"];
        $ekstensi = explode('.', $thumbnail);
        $ekstensi = strtolower(end($ekstensi));
        $namaBaru_thumbnail =$_SESSION["username"] . "_" . $waktu . "." . $ekstensi;
        $direktori_thumbnail = 'thumbnail/' . $namaBaru_thumbnail;
        
        if ($thumbnail == ""){
            file_put_contents($lirik, $lirik_baru);
            $lirik = mysqli_real_escape_string($conn, $lirik);
            $lagu = mysqli_real_escape_string($conn, $lagu);
            $query = "UPDATE content SET judul = '$judul', lirik = '$lirik', deskripsi = '$deskripsi' WHERE lagu = '$lagu'";
            $result = mysqli_query($conn, $query);
            if($result){
                echo "
                <script>
                window.location.href = '../index.php';
                </script>
                ";
            }else{
                echo "
                <script>
                    window.location.href = '../index.php';
                </script>
                ";
            }

        } else {
            file_put_contents($lirik, $lirik_baru);
            unlink("thumbnail/" . $direktoriLama);
            $lirik = mysqli_real_escape_string($conn, $lirik);
            $namaBaru_thumbnail = mysqli_real_escape_string($conn, $namaBaru_thumbnail);
            $lagu = mysqli_real_escape_string($conn, $lagu);
            $query = "UPDATE content SET thumbnail = '$namaBaru_thumbnail', judul = '$judul', lirik = '$lirik', deskripsi = '$deskripsi' WHERE lagu = '$lagu'";

            if (move_uploaded_file($temp, $direktori_thumbnail)){
                $result = mysqli_query($conn, $query);
                if($result){
                    echo "
                    <script>
                        window.location.href = '../index.php';
                    </script>
                    ";
                }else{
                    echo "
                    <script>
                        window.location.href = '../index.php'; 
                    </script>
                    ";
                }
            }
        }
    
    }

    function recomendation($conn){
        $query = "SELECT * FROM content WHERE stats = 'ACCEPT' ORDER BY lagu DESC LIMIT 6";
        $result = mysqli_query($conn, $query);
        $lagu = [];
        while ($row = mysqli_fetch_assoc($result)){
            $lagu[] = $row;
        }
        return $lagu;
    }

    function select_notif ($conn, $username){
        $username = mysqli_real_escape_string($conn, $username);
        $notif = [];
        $select_notif = mysqli_query($conn, "SELECT * FROM notification WHERE username = '$username' ORDER BY waktu DESC;");
        while ($row = mysqli_fetch_assoc($select_notif)){
            $notif[] = $row;
        }
        return $notif;
    }

    function timeAgo($inputTime) {
        date_default_timezone_set("Asia/Makassar");
        $now = new DateTime();
        $past = new DateTime($inputTime);
        $diff = $now->diff($past);
    
        if ($diff->y > 0) {
            return $diff->y . " tahun yang lalu";
        } elseif ($diff->m > 0) {
            return $diff->m . " bulan yang lalu";
        } elseif ($diff->d > 0) {
            return $diff->d . " hari yang lalu";
        } elseif ($diff->h > 0) {
            return $diff->h . " jam yang lalu";
        } elseif ($diff->i > 0) {
            return $diff->i . " menit yang lalu";
        } else {
            return $diff->s . " detik yang lalu";
        }
    }

    function overflow($text, $maxLength) {
        // Menghapus semua newline (\n atau \r) dari teks
        $cleanText = str_replace(["\r", "\n"], ' ', $text);
        
        // Jika panjang teks lebih dari maxLength, potong teks dan tambahkan '...'
        if (strlen($cleanText) > $maxLength) {
            $cleanText = substr($cleanText, 0, $maxLength) . '...';
        }
    
        return $cleanText;
    }

    function delete_chat($conn){
        $id = $_GET["chatID"];
        $lawan_chat = mysqli_real_escape_string($conn, $_GET["Lawanchat"]);
        $delete_chat = mysqli_query($conn, "DELETE FROM chat WHERE id = '$id'");
        if ($delete_chat){
            echo "
                <script>
                    document.location.href = '../index.php?lawanChat=$lawan_chat';
                </script>
            ";
        } else {
            echo "
                <script>
                    document.location.href = '../index.php?lawanChat=$lawan_chat';
                </script>
            ";
        }
    }

    function delete_notification($conn, $clear){
        if ($clear == "true"){
            $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
            $delete_notif = mysqli_query($conn, "DELETE FROM notification WHERE username = '$username'");
            if ($delete_notif){
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
        } else {
            $id = $_GET["idNotif"];
            $delete_notif = mysqli_query($conn, "DELETE FROM notification WHERE id = '$id'");
            if ($delete_notif){
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
        delete_lagu($conn);

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

    } else if (isset($_GET["chat"])){
        insert_chat($conn);

    } else if (isset($_GET["last-chat"])){
        $last = $_GET["last-chat"];
        if ($last == "true"){
            select_chat($conn, "true", $_POST["session"], $_POST["penerima"]);
        }

    } else if (isset($_POST['edit-account'])) {
        $fullName = $_POST['full-name'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
    
        editAkun($conn, $fullName, $email, $password);

    } else if (isset($_POST['edit-music'])) {
        update_lagu($conn, $_GET["lagu"]);

    } else if (isset($_GET["chatID"])){
        delete_chat($conn);

    } else if (isset($_GET["idNotif"])){
        if ($_GET["idNotif"] == "clear"){
            delete_notification($conn, "true");
        } else {
            delete_notification($conn, "false");
        }
    }
?>