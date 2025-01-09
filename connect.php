<?php
$server = "localhost";
$name = "root";
$database = "data";
$password = "mansura30";
$conn = mysqli_connect($server, $name, $password, $database);
if (!$conn) {
    die(mysqli_error($conn));
}
