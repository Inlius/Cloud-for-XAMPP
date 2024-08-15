<?php
session_start();
//check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit;
}
//if user pressed the delete button
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];
    

    
    $file = $_SESSION['path'] . "/" . $filename;

    if (file_exists($file)) {
        if (unlink($file)) {
            echo "The file $filename has been deleted.";
        } else {
            echo "There was an error deleting the file $filename.";
        }
    } else {
        echo "The file $filename does not exist." /*  (debug). $file*/;
    }
} else {
    echo "Invalid request.";
}
?>