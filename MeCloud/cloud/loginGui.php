<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="loginStyles.css">
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <form action="register.php">
        <input type="submit" value="Create a new account" />
        </form>
    </div>
    

    
    <!--<br>-->
    <?php
        //accDebuger();
    ?>
    
</body>
</html>

<?php
    function accDebuger() {
        session_start();
        $hashMapString = json_encode($_SESSION['hashMapPairs']);
        echo $hashMapString;
    }
?>