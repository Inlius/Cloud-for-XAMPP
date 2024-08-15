<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['path'])) {
    echo "Sorry, no upload path set.";
    exit();
}

$target_dir = $_SESSION['path'];
$uploadOk = 1;

foreach ($_FILES["filesToUpload"]["name"] as $key => $name) {
    $target_file = $target_dir . '/' . basename($name);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file $name already exists.<br>";
        $uploadOk = 0;
        continue;
    }

    //try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["filesToUpload"]["tmp_name"][$key], $target_file)) {
            echo "The file " . htmlspecialchars($name) . " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your file $name.<br>";
        }
    }
}
?>

