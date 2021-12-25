<?php
$server = "localhost";
$username = "u1694897_b_reg_4";
$password = "jtipolije";
$db = "u1694897_b_reg_4_db";
$koneksi = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Koneksi Gagal : " . mysqli_connect_error();
}
