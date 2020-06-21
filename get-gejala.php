<?php

    require_once('connection.php');

        $query = "SELECT * FROM tb_gejala";

        $sth = $mysqli->query($query);

        $resultGejala = array();
        while($r = mysqli_fetch_assoc($sth)) {
            $resultGejala[] = $r;
        }
        

        $respone = [
            "status_code" => 200,
            "message" => "success",
            "gejala" => $resultGejala
        ];

        echo json_encode($respone);
    
    
  