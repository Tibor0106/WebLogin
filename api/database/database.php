<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");


if ($conn->connect_error) {
    die("Hiba a kapcsolódás során: " . $conn->connect_error);
}
