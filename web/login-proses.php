<?php
require('koneksi.php');

if (isset($_POST['btn-login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];
    if (!empty(trim($username)) && !empty(trim($password))) {
        $query = "SELECT * FROM akun WHERE email = '$username'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
            $nama = $row['nama'];
            $email = $row['email'];
            $username1 = $row['username'];
            $pwd = $row['password'];;
        }

        if ($num != 0) {
            if ($username == $username1 || $username == $email ||  $password == $pwd) {
                echo "<script>alert('Anda Berhasil Login');</script>";
                echo "<meta http-equiv='refresh' content='0; url=login.php'>";
            } else {
                echo "<script>alert('Anda Gagal Login');</script>";
                echo "<meta http-equiv='refresh' content='0; url=login.php'>";
            }
        } else {
            echo "<script>alert('Anda Gagal Login');</script>";
            echo "<meta http-equiv='refresh' content='0; url=login.php'>";
        }
    } else {
        echo "<script>alert('Anda Gagal Login');</script>";
        echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    }
}
