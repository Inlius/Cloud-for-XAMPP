<?php
//register logic
include 'Pairs.php';
session_start();
$message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginPairs = getLoginPairs();

    if (isset($loginPairs[$username])) {
        $message = "Username already taken";
    } else {
        setPair($username, $password);
        $message = 'success';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="registerStyles.css">
    <script type="text/javascript">
        function popUpRS() {
            alert('Registration successful!');
        }
        <?php if ($message === 'success'): ?>
        window.onload = function () {
            popUpRS();
        };
        <?php endif; ?>
    </script>
</head>
<body>
    <div class="register-data">
        <form action="register.php" method="post">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
    <div class="loginArea">
        <a href="loginGui.php">Login</a>
    </div>
    <?php if ($message && $message !== 'success'): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>

