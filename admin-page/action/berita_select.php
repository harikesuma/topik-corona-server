<?php
    require_once('../connection.php');

    $query  = "SELECT a.id, a.judul, a.deskripsi, a.foto, a.click, a.tanggal, b.nama FROM tb_news a INNER JOIN tb_admin b ON a.admin_id = b.id";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $beritas = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // echo "<pre>";
    // print_r($beritas);
    // echo "</pre>";
?>