<?php

require "./config.php";
require "./upload.php";

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$file = $_FILES['image']['title'];
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$published = filter_input(INPUT_POST, 'published', FILTER_SANITIZE_NUMBER_INT);
$publishedEst = filter_input(INPUT_POST, 'publishedEst', FILTER_SANITIZE_NUMBER_INT);

$file= time()."_".$file;

$sql = "INSERT INTO api.my_favorite (title, image, description, published, publishedEst)
VALUES ('$title','$file', '$description', '$published', '$publishedEst')";

if ($conn->query($sql) === TRUE) {
  uploadFile();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

header('Location: ../read.php');