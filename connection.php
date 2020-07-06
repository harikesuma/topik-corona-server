<?php
// $mysqli = new mysqli("localhost","root","","db_topik_covid_bali");

$mysqli = new mysqli("113.20.31.181","cekkeuangankuxyz_wincent","tugaswincent12345","cekkeuangankuxyz_db_topik_covid_bali","3306");


// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
