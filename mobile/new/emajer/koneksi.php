<?php

$connection = null;

try{
    //Config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emajer";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*if($connection){
        echo "Koneksi Berhasil";
    } else {
        echo "Koneksi Gagal";
    }*/

} catch (PDOException $e){
    echo "Error ! " . $e->getMessage();
    die;
}

?>