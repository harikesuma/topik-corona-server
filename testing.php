<?php

require_once 'connection.php';

$angka = 1;

$query = "SELECT percobaan.percobaan FROM percobaan WHERE percobaan.angka = ?";

$stmt = $mysqli->prepare($query);

$stmt->bind_param("s", $angka);

$stmt->execute();

$stmt->bind_result($result);

$stmt->fetch();

$stmt->close();

echo $result;

