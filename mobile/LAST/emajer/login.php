<?php

include 'koneksi.php';

if ($_POST) {

    //Data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $response = []; //Data Response

    //Cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM akun INNER JOIN kelas ON akun.id_kelas = kelas.id_kelas INNER JOIN level ON akun.id_level = level.id_level WHERE akun.email = ?");
    $userQuery->execute(array($email));
    $query = $userQuery->fetch();

    if ($userQuery->rowCount() == 0) {
        $response['status'] = false;
        $response['message'] = "Email Tidak Terdaftar";
    } else {
        // Ambil password di db
        $passwordDB = $query['password'];

        if (strcmp(md5($password), $passwordDB) === 0) {
            $response['status'] = true;
            $response['message'] = "Login Berhasil";
            $response['data'] = [
                'id_akun' => $query['id_akun'],
                'nama' => $query['nama'],
                'email' => $query['email'],
                'username' => $query['username'],
                'password' => $query['password'],
                'kelas' => $query['nama_kelas'],
                'id_level' => $query['id_level'],
                'saldo' => $query['saldo']
            ];
        } else {
            $response['status'] = false;
            $response['message'] = "Email anda salah";
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print
    echo $json;
}
