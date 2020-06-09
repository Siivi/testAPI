<?php

$host = "localhost";
$user = "root";
$psw = "";
$dbname = "api";

$conn = new mysqli($host, $user, $psw, $dbname);
mysqli_set_charset($conn, 'utf8');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}