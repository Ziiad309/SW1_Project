<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<form method="post" action="">
    <button name="logout">Logout</button>
</form>
</body>
</html>

<style>
  button[name="logout"] {
  display: inline-block;
  border: 2px solid #333;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  color: #333;
  background-color: #eee;
  border-radius: 5px;
  cursor: pointer;
}

button[name="logout"]:hover {
  background-color: lightblue;
  color: #fff;
}
</style>

<?php
session_start();

if (isset($_POST['logout'])){

require "../inc/db connection.php";

$user_id = $_SESSION['user_id'];
$usertype = $_SESSION['user-type'];

if ($usertype == 'patient') {
    $delete_sql = "DELETE FROM `patient` WHERE patient_id = $user_id";
} elseif ($usertype == 'doctor') {
    $delete_sql = "DELETE FROM `doctor` WHERE doctor_id = $user_id";
}

if ($connection->query($delete_sql) == true) {
    echo "User data deleted successfully";
} else {
    echo "Error deleting user data: ";
}

$connection->close();

session_unset();
session_destroy();
}
?>