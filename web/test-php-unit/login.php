<?php

class Login
{
    //membuat sebuah fungsi yang terdapat 2 parameter, yaitu email dan password 
    function login($email, $password)
    {
        // menghubungkan php dengan koneksi database
        include 'koneksi.php';
        // menyeleksi data user dengan username dan password yang sesuai    
        $login = mysqli_query($koneksi, "SELECT * FROM akun WHERE email='$email' AND password='$password'");

        if ($login) {
            echo 'Berhasil Login';
            return true;
        } else {
            echo 'Gagal Login';
            return true;
        }
    }
}
