<?php

$host= "{$_SERVER['SERVER_NAME']}";
$username = "root";
$password = "";
$dbname = "vezeetadb";

$connection = mysqli_connect($host , $username , $password , $dbname);

// if (!$connection) {
//   die("Connection failed: " . mysqli_connect_error());
// } else {
//   echo "connection is good";
// }

?>