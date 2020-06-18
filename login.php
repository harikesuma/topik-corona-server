<?php   
    require_once('connection.php');
   
    if(isset($_POST['email'], $_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT tb_user.`id`, tb_user.`email`, tb_user.`password`,
                 tb_user.`nama`,  tb_user.`jenis_kelamin`, tb_user.`alamat`
                 FROM tb_user WHERE tb_user.`email` = ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($result_id, $result_email, $result_password, $result_name, $result_gender, $result_address);
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
                    "id" => $result_id,
                    "email" => $result_email,
                    "name" => $result_name,
                    "gender" => $result_gender,
                    "address" => $result_address
                ];
            }
            echo json_encode($response);
        }

    }else{
    echo "Post Data Null";
    }