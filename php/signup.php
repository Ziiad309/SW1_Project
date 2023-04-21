<?php 

function validate ($data){
  $data = str_replace(["@","#","%","$","^","&","*",")","(",">","<","?","|",":",";","}","{","~","!"] , " ", $data);
  $data = stripslashes($data);
  $data = trim($data);
  return $data;
}

require_once ("../inc/db connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

  if ($_POST['user-type'] == "patient"){

    $name = isset($_POST['name']) ? ucwords(validate($_POST['name'])) : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = isset($_POST['phone']) ? strval(validate($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL , FILTER_NULL_ON_FAILURE) : '';
    $hashed_password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    
    $sql_patient = "INSERT INTO `patient`(`name`, `gender`, `date_of_birth`, `phone`, `email`, `password`) 
            VALUES ('$name', '$gender', '$dob', '$phone', '$email', '$hashed_password')";

    if(mysqli_query($connection, $sql_patient)){

        echo "<script>alert('Successful Login.')</script>";

    } else {

        echo "ERROR: Could not able to execute $sql_patient. " . mysqli_error($connection);
        
    }


















    

  // } else {

  //   $name_dr = isset($_POST['name']) ? ucwords(validate($_POST['name'])) : '';
  //   $email_dr = isset($_POST['email']) ? filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL , FILTER_NULL_ON_FAILURE) : '';
  //   $password_dr = isset($_POST['password']) ? $_POST['password'] : '';
  //   $qualifications = isset($_POST['qualifications']) ? $_POST['qualifications'] : '';

  //   $hash_dr = password_hash($password_dr, PASSWORD_DEFAULT);

  //   $sql_dr = "INSERT INTO doctor ('name' , 'email' , 'password_dr') VALUES ($name_dr , $email_dr , $hash_dr)";
  //   $sql_dr_qual = "INSERT INTO doctor_qualifications ('qualifications') VALUES ($qualifications)";

  //   if(mysqli_query($connection, $sql_dr)){

  //     echo "Data inserted successfully.";

  // } else {

  //     echo "ERROR: Could not able to execute $sql_dr. " . mysqli_error($connection);
      
  // }

  } 

}