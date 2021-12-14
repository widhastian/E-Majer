<?php

include 'koneksi.php';

if ($_POST) {

    //POST DATA
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $id_kelas = filter_input(INPUT_POST, 'id_kelas', FILTER_SANITIZE_STRING);
    $id_level = filter_input(INPUT_POST, 'id_level', FILTER_SANITIZE_STRING);

    $response = [];

    //Cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM akun where email = ?");
    $userQuery->execute(array($username));

    // Cek username apakah ada tau tidak
    if ($userQuery->rowCount() != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = 'Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO akun (nama, email, username, password, id_kelas, id_level, saldo) values (:nama, :email, :username, :password, :id_kelas, :id_level, 0)';
        $statement = $connection->prepare($insertAccount);

        try {
            //Eksekusi statement db
            $statement->execute([
                ':nama' => $nama,
                ':email' => $email,
                ':username' => $username,
                ':password' => md5($password),
                ':id_kelas' => $id_kelas,
                ':id_level' => $id_level
            ]);

            //Beri response
            $response['status'] = true;
            $response['message'] = 'Akun berhasil didaftarkan';
            $response['data'] = [
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'id_kelas' => $id_kelas,
                'id_level' => $id_level
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print JSON
    echo $json;
}
