<?php

$connection = null;

try {
    //Config
    $host = "localhost";
    $username = "u1694897_b_reg_4";
    $password = "jtipolije";
    $dbname = "u1694897_b_reg_4_db";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($connection){
    //     echo "Koneksi Berhasil";
    // } else {
    //     echo "Gagal gan";
    // }


} catch (PDOException $e) {
    echo "Error ! " . $e->getMessage();
    die;
}
