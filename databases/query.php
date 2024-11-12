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

    function delete_akun($conn, $username, $session){
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

    function select_komen($conn, $lagu){
        $select_komen = mysqli_query($conn, "
        SELECT
        a.username AS username,
        a.foto AS foto,
        b.isi_komen AS komen,
        b.waktu AS waktu
        FROM comment as b
        JOIN account a ON b.user = a.username, 
        WHERE b.lagu = '$lagu'
        ORDER BY b.waktu DESC
        ");
        $komen = mysqli_fetch_assoc($select_komen);
        return $komen;
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

    } else if (isset($_GET["user-edit"])){
        
    } else if (isset($_GET["delete"])){
        delete_akun($conn, $_GET["username"], $_GET["session"]);
    }
?>