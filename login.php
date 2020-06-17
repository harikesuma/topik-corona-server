<?php   
    require_once('connection.php');

    if(isset($_POST['email'], $_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT users.`id`, users.`email`, users.`password`, users.`name` FROM users WHERE users.`email` = ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($result_id, $result_email, $result_password, $result_name);
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
                    "code" => 200,
                    "id" => $result_id,
                    "email" => $result_email,
                    "name" => $result_name,
                ];
            }
            echo json_encode($response);
        }

    }else{
    echo "Post Data Null";
    }