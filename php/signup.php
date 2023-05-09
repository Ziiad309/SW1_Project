<?php
session_start();

$valid_email = "/^[a-zA-Z0-9\_]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/";
$valid_phone = "/^[0]{1}[1]{1}[0-9]{9}$/";

require "../inc/db connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertype = isset($_POST['user-type']) ? $_POST['user-type'] : '';
    $name = isset($_POST['name']) ? ucwords(trim($_POST['name'])) : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (preg_match($valid_phone, $phone) && preg_match($valid_email, $email)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($usertype == "patient") {
            $run_sql = $connection->query("SELECT email FROM patient WHERE email = '$email'");

            if (mysqli_num_rows($run_sql) == 0) {
                $insert_sql = "INSERT INTO `patient`(`name`, `gender`, `date_of_birth`, `phone`, `email`, `password`) 
                            VALUES ('$name', '$gender', '$dob', '$phone', '$email', '$hashed_password')";

                if ($connection->query($insert_sql)) {
                    echo "<script>alert('Successful Sign up.')</script>";
                    $id_sql = "SELECT patient_id FROM `patient` WHERE email='$email'";
                    $result = $connection->query($id_sql);
                    
                    if ($row = $result->fetch_assoc()) {
                        $_SESSION['user_id'] = $row['patient_id'];
                        $_SESSION['name'] = $name;
                        $_SESSION['user-type'] = $usertype;
                        header("Location: setlocation.php");
                        exit();
                    }
                }
            } else {
                echo "<script>alert('ERROR: the email already exists')</script>";
            }
        } elseif ($usertype == "doctor") {
            $run_sql = $connection->query("SELECT email FROM doctor WHERE email = '$email'");

            if (mysqli_num_rows($run_sql) == 0) {
                $insert_sql = "INSERT INTO `doctor`(`name`, `email`, `password`) 
                            VALUES ('$name', '$email', '$hashed_password')";

                if ($connection->query($insert_sql)) {
                    echo "<script>alert('Successful Sign up.')</script>";
                    $id_sql = "SELECT doctor_id FROM `doctor` WHERE email='$email'";
                    $result = $connection->query($id_sql);

                    if ($row = $result->fetch_assoc()) {
                        $_SESSION['user_id'] = $row['doctor_id'];
                        $_SESSION['name'] = $name;
                        exit();
                    }
                }
            } else {
                echo "<script>alert('ERROR: the email already exists')</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid email or phone')</script>";
    }
}

$connection->close();

if (empty($usertype) || empty($name) || empty($dob) || empty($gender) || empty($phone) || empty($email) || empty($password)) {

    echo "
        <div class='alert alert-warning'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields..!</b>
        </div>";

    exit();
}
