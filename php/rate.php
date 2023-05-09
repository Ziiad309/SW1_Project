<form method="get">
    <input type="text" name="rate" placeholder="your rate">
    <input type="submit" name="submit_rate">
</form>

<?php
session_start();
require "../inc/db connection.php";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['rate'])) :

    $rate = $_GET['rate'];
    $valid_rate = "/^[0-9]+$/";

    if (preg_match($valid_rate, $rate)) {
        if ($rate > 10) {
            echo "the maximum rate is 10!";
        } else {
            if (isset($_SESSION['name'])) {
                $username = $_SESSION['name'];
                $date = time();
                $date = date_format(new DateTime("@$date"), "Y-m-d");
                $check_sql = "SELECT * FROM `rate` WHERE `username`='$username' AND `date`='$date'";
                $result = $connection->query($check_sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id = $row['rate_id'];
                    $update_sql = "UPDATE `rate` SET `rating`='$rate' WHERE `rate_id`='$id'";
                    $connection->query($update_sql);
                    echo "you have changed your rate";
                } else {
                    $rate_sql = "INSERT INTO `rate`(`username`, `date`, `rating`) VALUES ('$username','$date','$rate')";
                    $connection->query($rate_sql);
                    echo "Thanks for your rate";
                }
            }
            $connection->close();
            header("Location: setlocation.php");
        }
    } else {
        echo "you have to give us your rate to submit it";
    }
endif;