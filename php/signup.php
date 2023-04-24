<?php 

session_start();

function validate ($data){
  $data = str_replace(["@","#","%","$","^","&","*",")","(",">","<","?","|",":",";","}","{","~","!"] , " ", $data);
  $data = stripslashes($data);
  $data = trim($data);
  return $data;
}

require_once ("../inc/db connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  
    $usertype = isset($_POST['user-type']) ? $_POST['user-type'] : '';
    $name = isset($_POST['name']) ? ucwords(validate($_POST['name'])) : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = isset($_POST['phone']) ? strval(validate($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL , FILTER_NULL_ON_FAILURE) : '';
    $hashed_password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $_SESSION['name'] = $name ;

    if ($_POST['user-type'] == "patient"){

    $sql = "INSERT INTO `patient`(`name`, `gender`, `date_of_birth`, `phone`, `email`, `password`) 
            VALUES ('$name', '$gender', '$dob', '$phone', '$email', '$hashed_password')";

    } else {

      $sql = "INSERT INTO `doctor`(`name`, `email`, `password`) 
      VALUES ('$name', '$email', '$hashed_password')";

    }

    if($connection->query($sql)){

      echo "<script>alert('Successful Sign up.')</script>";

  } else {

      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
      
  }

     $connection->Close();  

  }