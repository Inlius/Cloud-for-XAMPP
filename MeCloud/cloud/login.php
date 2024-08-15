<?php
include 'Pairs.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['loggedIn'] = false;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (getPair($username, $password)) {
        loginSetup($username);
        header("Location: cloud.php");
        exit();
    } else {
        echo "Username or password are incorrect";
        exit();
    }
}

//Making storage (if it doesnt already exist)
function loginSetup($name) {
    $_SESSION['path'] = "D:/test/" . $name;//path where the files should be stored on the server
    $_SESSION['pathPublic'] = "D:/test/" . $name . "/public";
    if (!file_exists($_SESSION['path'])) {
        mkdir($_SESSION['path'], 0777, true);
        mkdir($_SESSION['pathPublic'], 0777, true);
    }
}
?>
