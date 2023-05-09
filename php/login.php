<?php

session_start();
require_once("../inc/db connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user-type'])) {
        $usertype = $_POST['user-type'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM $usertype WHERE email = '$email'";
        $result = $connection->query($sql);

        if ($result->num_rows != 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] =$row['patient_id'];
                echo "<script>alert('Successful login, Nice to see you again Mr/Mrs. {$_SESSION['name']} :)' )</script>";
                header("Location: rate.php");
                exit();
            } else {
                echo "<script>alert('Invalid username or password')</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password')</script>";
        }
        $connection->close();
    }
}
