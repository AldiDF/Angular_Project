<?php
    require "connection.php";
    
    $akun;
    $pesan;
    $komen;
    $konten;
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
                    document.location.href = '../crud/signup.php';
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
        $sql_insert_akun = mysqli_query($conn, "INSERT INTO account VALUES ('$username', '$nama_lengkap', '$email', '$password', '', '');");
        if ($sql_insert_akun) {
            echo "
                <script>
                    alert('Berhasil Membuat Akun');
                    document.location.href = '../login.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal Membuat Akun');
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
                    document.location.href = 'index.php';
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
                        document.location.href = 'index.php';
                    </script>
                ";

                exit;
                
            } 
            $count ++;
        }

        echo "
            <script>
                alert('Gagal Login, email atau password salah');
                document.location.href = '../login.php';
            </script>
        ";
        exit;
    }
    // $select_akun = mysqli_query($conn, "SELECT * FROM account");
    // $select_pesan = mysqli_query($conn, "SELECT * FROM account");
    // $select_komen = mysqli_query($conn, "SELECT * FROM account");
    // $select_konten = mysqli_query($conn, "SELECT * FROM account");

    // $insert_pesan = mysqli_query($conn, "INSERT INTO account VALUES");
    // $insert_komen = mysqli_query($conn, "INSERT INTO account VALUES");
    // $insert_konten = mysqli_query($conn, "INSERT INTO account VALUES");

    // $update_akun = mysqli_query($conn, "INSERT INTO account VALUES");
    // $update_konten = mysqli_query($conn, "INSERT INTO account VALUES");

?>