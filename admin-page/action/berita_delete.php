<?php
    require_once('../../connection.php');
    require_once('../cloudinary/Cloudinary_Setup.php');

    $id = $_GET['id'];

    $query  = "SELECT foto FROM tb_news WHERE id = ?";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $foto = $result->fetch_assoc();
    $stmt->close();

    $query  = "DELETE FROM tb_news WHERE id = ?";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();

    $delete_image = substr($foto['foto'], 65, -4);

    \Cloudinary\Uploader::destroy($delete_image);

    header("Location: ../berita.php");
?>