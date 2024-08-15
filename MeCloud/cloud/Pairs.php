
<?php
//login pairs (name and password) logic
function setPair($name, $password) {
    $loginPairs = getLoginPairs();
    $loginPairs[$name] = password_hash($password, PASSWORD_DEFAULT);
    saveLoginPairs($loginPairs);
}

function getPair($name, $password) {
    $loginPairs = getLoginPairs();
    if (isset($loginPairs[$name]) && password_verify($password, $loginPairs[$name])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $name;
        return true;
    } else {
        return false;
    }
}

function getLoginPairs() {
    $filePath = 'loginPairs.json';
    if (!file_exists($filePath)) {
        return array("Developer0" => password_hash("123", PASSWORD_DEFAULT));
    }
    $json = file_get_contents($filePath);
    return json_decode($json, true);
}

function saveLoginPairs($loginPairs) {
    $filePath = 'loginPairs.json';
    $json = json_encode($loginPairs);
    file_put_contents($filePath, $json);
}
?>
