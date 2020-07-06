<?php
// $mysqli = new mysqli("localhost","root","","db_topik_covid_bali");

$mysqli = new mysqli("cekkeuanganku.xyz","cekkeuangankuxyz_wincent","tugaswincent12345","cekkeuangankuxyz_db_topik_covid_bali");


// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
