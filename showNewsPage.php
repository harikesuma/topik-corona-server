<?php

    
require_once("connection.php");

    $response = array();

    if(isset($_GET['news_id'])){

        $news_id = $_GET['news_id'];

        $query = "SELECT tb_news.`judul`, tb_news.`deskripsi`, tb_news.`foto`, tb_news.`tanggal`, tb_news.`click`
        FROM tb_news 
        WHERE tb_news.`id` = ?";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $news_id);
        if($stmt->execute()){
            
            $stmt->bind_result($resultTitle, $resultDescription, $resultImage, $resultDate, $resultClick);
            $stmt->fetch();
            $stmt->close();

            $resultClick++;

            $query = "UPDATE tb_news SET tb_news.`click` = ? WHERE tb_news.`id` = ?";

            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ss", $resultClick, $news_id);
            $stmt->execute();
            $stmt->close();

            $response["status_code"] = 200;
            $response["message"] = "Berhasil";
            $response["data"] = [
                "id" => $news_id,
                "title" => $resultTitle,
                "description" => $resultDescription,
                "image" => $resultImage,
                "date" => $resultDate
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
            exit;

        } 
        $response["status_code"] = 500;
        $response["message"] = $mysqli->error;
        $response["data"] = null;

        header("Content-Type: application/json");
        echo json_encode($response);
        exit;

    }
    $response["status_code"] = 400;
        $response["message"] = $mysqli->error;
        $response["data"] = null;

        header("Content-Type: application/json");
        echo json_encode($response);
