<?php
    require_once('connection.php');

    if(isset($_POST['email'], $_POST['password'], $_POST['name'], $_POST['address'])){
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $address = $_POST['address'];

        $query = "INSERT into users (
            email,
            password,
            name,
            address) VALUES (?,?,?,?)";
            
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssss', $email, $hash_password, $name, $address);
        $stmt->execute();
        $stmt->close();

        $query = "SELECT users.`id`, users.`name` FROM users WHERE email = ?";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($resultId, $resultName);
        $stmt->fetch();
        $stmt->close();

        $respone = [
            "status_code" => 200,
            "message" => "success",
            "id" => $resultId,
            "name" => $resultName
        ];

        echo json_encode($respone);



    }else{
        echo "Post Data Null";
    }