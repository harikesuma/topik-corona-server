<?php
    require_once('connection.php');

    if(isset($_POST['userId'])){
        
        // $test = json_decode($_POST['gejalaId']);

        
        $gejalaId = str_replace("[","",$_POST['gejalaId']);
        
       
        $gejalaId = str_replace("]","",$gejalaId);
        $gejalaId = explode(",",$gejalaId);
        var_dump($_POST['gejalaId']);
        $userId = $_POST['userId'];
        $tanggal = date("Y-m-d");
      
            for($i = 0; $i < count($gejalaId); $i++){
                $query = "INSERT into tb_user_gejala (
                    user_id,
                    gejala_id,
                    tanggal
                    ) VALUES (?,?,?)";

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('sss', $userId, $gejalaId[$i], $tanggal);
                $stmt->execute();
                $stmt->close();
            }

     
        $respone = [
            "status_code" => 200,
            "message" => "success"
        ];

        

    }else{
        echo "Post Data Null";
    }