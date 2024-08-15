<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['filename'])) {
    $filename = basename($_GET['filename']);
    $filepath = $_SESSION['path'] . DIRECTORY_SEPARATOR . $filename;

    if (file_exists($filepath)) {
        //set header, for downloading file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filepath));

        //show file
        readfile($filepath);
        exit();
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>