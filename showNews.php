<?php
    
    require_once("connection.php");
    
    $response = array();
    
    $response["data"] = array(); 
    $query = "SELECT tb_news.`id`, tb_news.`judul`, tb_news.`foto` FROM tb_news";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($resultId, $resultTitle, $resultFoto);
    while($stmt->fetch()){

        $result = [
            "id" => $resultId,
            "title" => $resultTitle,
            "image" => $resultFoto
        ];

        array_push($response["data"], $result);
        
    }
    $stmt->close();

    header("Content-Type: application/json");
    echo json_encode($response);