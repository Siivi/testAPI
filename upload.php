<?php

define ('SITE_ROOT', realpath(dirname(__DIR__)));

function uploadFile() {
  global $file;
  $target_dir = SITE_ROOT."/images/";
  $target_file = $target_dir . $file;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $image = $_FILES["image"]["tmp_name"];
  
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }
  }
  
  if (file_exists($target_file)) {
    $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
  } else {
    move_uploaded_file($image, $target_file);
  }
}
