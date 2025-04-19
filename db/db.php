<?php
$server = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = 'tiembanh';
$conn = new mysqli($server, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Could not connect to DB" . mysqli_connect_error());
}
