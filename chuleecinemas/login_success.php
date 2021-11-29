<?php
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    die('Error occured. Return to homepage <a href="./">here</a>.');
}
$email = strtolower(trim(utf8_decode(urldecode($_POST['email']))));
$password = md5(utf8_decode(urldecode($_POST['password'])));

$login_sql = "SELECT * FROM f32ee.User Where Email = '$email' and Password = '$password'";
$loginResults = $db->query($login_sql);

if  ($loginResults->num_rows) {
    $loginResultsRow = $loginResults->fetch_assoc();
    
    session_start();
    setcookie($name = 'userId', $value = $loginResultsRow['Id'], $expire = time() + (86400), $path = "", $domain = "", $secure = false, $httponly = false);
    $_SESSION["user" . $loginResultsRow['Id']] = array('Id' => $id, 'PhoneNumber' => $_POST['phonenumber'], 'Name' => $_POST['name'], 'Email' => $_POST['email']);
    $db->close();
    echo "<script>
    alert('You have successfully logged in!');
    window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert('Incorrect E-mail and/or password detected.');
    window.location.href = 'login.php';
    </script>";
    $db->close();
}