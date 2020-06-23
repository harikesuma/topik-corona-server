<?php

    require_once('../../connection.php');
   
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT `id`, `nama`, `username`, `email`, `password` FROM tb_admin WHERE `username` = ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($result_id, $result_nama, $result_username, $result_email, $result_password);
        $stmt->fetch();
        $stmt->close();

        if($result_id == null){
            $response = [
                "code" => 100,
                "Message" => "Tidak Ada User",
            ];

            echo json_encode($response);
        }else{
            if(password_verify($password, $result_password)){
                $response = [
                    "status_code" => 200,
                    "id"        => $result_id,
                    "nama"      => $result_nama,
                    "username"  => $result_username,
                    "email"     => $result_email
                ];
                
                echo json_encode($response);
                setcookie('id', $result_id, time() + (86400 * 30), "/");
                setcookie('nama', $result_nama, time() + (86400 * 30), "/");
                setcookie('username', $result_username, time() + (86400 * 30), "/");
                setcookie('email', $result_email, time() + (86400 * 30), "/");
                header("Location: ../index.php");
            }
        }

    }
    else{
    echo "Post Data Null";
    }