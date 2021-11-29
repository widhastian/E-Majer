<?php
require('koneksi.php');
session_start();

if (isset($_POST['btn-login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];
    if (!empty(trim($username)) && !empty(trim($password))) {
        $query = "SELECT * FROM akun WHERE email = '$username'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id_akun'];
            $nama = $row['nama'];
            $kelas = $row['id_kelas'];
            $level = $row['id_level'];
            $email = $row['email'];
            $saldo = $row['saldo'];
            $pwd = $row['password'];;
        }

        if ($num != 0) {
            if ($username == $email ||  $password == $pwd) {
                $_SESSION['id_akun'] = $id;
                $_SESSION['nama'] = $nama;
                $_SESSION['id_kelas'] = $kelas;
                $_SESSION['id_level'] = $level;
                $_SESSION['saldo'] = $saldo;
                echo "<script>alert('Anda Berhasil Login');</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php?p=home'>";
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
