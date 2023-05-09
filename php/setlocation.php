<form method="get">
  <select name="location">
    <option></option>
    <option value="Mohandesin">Mohandesin</option>
    <option value="Dokki">Dokki</option>
    <option value="Maadi">Maadi</option>
    <option value="Zamalik">Zamalik</option>
  </select>
  <button type="submit">Submit</button>
</form>

<?php
session_start();
require "../inc/db connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['location'])) {
        $user_location = $_GET['location'];
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $_SESSION['user_location'] = $user_location;
            $update_sql = "UPDATE `patient` SET `location`='$user_location' WHERE `patient_id`=$user_id";
            if ($connection->query($update_sql)) {
                echo "You have updated your location.";
            } else {
                echo "Something went wrong!";
            }
        }
        } else {
            echo "You are not logged in!";
        }
    } else {
        echo "Please select a location!";
    }
