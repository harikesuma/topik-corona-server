<?php

    require_once('connection.php');

    if(isset($_POST['id'])){
        $name =  $_POST['name'];
        $address = $_POST['address'];
        $id = $_POST['id'];

        $query = "UPDATE tb_user
        SET tb_user.`nama` = ? , tb_user.`alamat` = ? 
        WHERE tb_user.`id` = ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('sss', $name, $address, $id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();

        $respone = [
            "status_code" => 200,
            "message" => "success",
            "name" => $name,
            "address" => $address
        ];

        echo json_encode($respone);
    }
    
    else{
        echo "Post Data Null";
        }