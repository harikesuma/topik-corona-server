<?php
    require_once('connection.php');

    $response = array();

    if(isset($_POST['email'], $_POST['password'], $_POST['name'], $_POST['address'], $_POST['gender'])){
        $email = $_POST['email'];
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];

        $query = "INSERT into tb_user (
            nama,
            email,
            password,
            jenis_kelamin,
            alamat) VALUES (?,?,?,?,?)";
            
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssss', $name, $email, $hash_password, $gender, $address);
        $stmt->execute();
        $stmt->close();

        $query = "SELECT tb_user.`id`, tb_user.`nama`, tb_user.`jenis_kelamin`,  tb_user.`alamat`  FROM tb_user WHERE email = ?";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($resultId, $resultName, $resultGender, $resultAddress);
        $stmt->fetch();
        $stmt->close();


        $response["status_code"] = 200;
        $response["message"] = "Fetch Berhasil";
        $response["data"] = [
            "id" => $resultId,
            "name" => $resultName,
            "gender" => $resultGender,
            "email" => $email,
            "address" => $resultAddress
        ];

        echo json_encode($response);


    } else {

        $response["status_code"] = 400;
        $response["message"] = $mysqli->error;
        $response["data"] = null;
}