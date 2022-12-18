<?php
require_once './check-password.php';
check_userdata();

require_once './timestamp.php';

$target_dir = "../assets/uploads/";
$imgKey = "img";
$datetime = get_current_time();
$datetime = str_replace(":", "-", $datetime);
$image_name = $datetime . '-' . basename($_FILES[$imgKey]["name"]);
$target_file = $target_dir . $image_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$response = [
  "message" => "",
  "uploaded" => false
];

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES[$imgKey]["tmp_name"]);
  if($check !== false) {
    $response["message"] .= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $response["message"] .= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $response["message"] .= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES[$imgKey]["size"] > 500000) {
  $response["message"] .= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $response["message"] .= "Sorry, only JPG, JPEG & PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $response["message"] .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES[$imgKey]["tmp_name"], $target_file)) {
    $response["message"] .= "The file ". htmlspecialchars( basename( $_FILES[$imgKey]["name"])). " has been uploaded.";
  } else {
    $response["message"] .= "Sorry, there was an error uploading your file.";
  }
}

$response["uploaded"] = $uploadOk;
$response["image"] = $image_name;

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>