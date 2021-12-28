<?php

include 'koneksi1.php';

if ($_POST) {

    //POST DATA

    $id = "M-" . mt_rand(1000, 99999);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $id_kelas = filter_input(INPUT_POST, 'id_kelas', FILTER_SANITIZE_STRING);

    $response = [];

    //Cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM akun WHERE email = ?");
    $userQuery->execute(array($username));

    // Cek username apakah ada tau tidak
    if ($userQuery->rowCount() != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = 'Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO akun (id_akun, nama, email, username, password, id_kelas, id_level) values (:id, :nama, :email, :username, :password, :id_kelas, 2)';
        $statement = $connection->prepare($insertAccount);

        try {
            //Eksekusi statement db
            $statement->execute([
                ':id' => $id,
                ':nama' => $nama,
                ':email' => $email,
                ':username' => $username,
                ':password' => $password,
                ':id_kelas' => $id_kelas
            ]);

            //Beri response
            $response['status'] = true;
            $response['message'] = 'Akun berhasil didaftarkan';
            $response['data'] = [
                'id' => $id,
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'kelas' => $id_kelas
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
