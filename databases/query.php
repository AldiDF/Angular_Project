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
            if ($akun[$count]["username"] == $username && password_verify($password, $akun[$count]["pasword"])){
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
        $delete_lagu = mysqli_query($conn, "DELETE FROM content WHERE user = '$username'");
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
            $update_status = mysqli_query($conn, "UPDATE content SET stats = '$stats' WHERE id = '$id'");
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
        $like;
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
            $image_path = '../assets/images/' . $lagu['thumbnail'];
            $song_path = '../assets/songs/' . $lagu['lagu'];
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

    }
?>