<?php
    include('../../connection.php');

    $response = array();

    $nama     = "Admin";
    $username = "admin";
    $email    = "admin@email.com";
    $password = password_hash("admin", PASSWORD_DEFAULT);

    $query = "INSERT into tb_admin VALUES (NULL,?,?,?,?)";
        
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssss', $nama, $username, $email, $password);
    if (!$stmt->execute()){
        $response["status_code"] = 400;
        $response["message"] = $mysqli->error;
    }
    else {
        $response["status_code"] = 200;
        $response["message"] = "Insert Success";
    }
    $stmt->close();
    echo json_encode($response);
?>