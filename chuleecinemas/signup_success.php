<?php
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}
if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirmpassword']) || !isset($_POST['name']) || !isset($_POST['phonenumber'])) {
    $db->close();
    die('Error occured. Return to homepage <a href="./">here</a>.');
}
if ($_POST['password'] != $_POST['confirmpassword']) {
    $db->close();
?>
    <script>
        alert("Password entered do not match")
        window.location.replace('./signup.php')
    </script>
<?php
}
//query to check if email and phone number present
$email_sql = "SELECT Email FROM f32ee.User WHERE Email = '." . trim($_POST['email']) . "';";
$phonenumber_sql = "SELECT PhoneNumber FROM f32ee.User WHERE PhoneNumber = '" . trim($_POST['phonenumber']) . "';";

$emailResults = $db->query($email_sql);
$phonenumberResults = $db->query($phonenumber_sql);


$user_insert = "INSERT INTO f32ee.User( Name, Email, PhoneNumber, Password) VALUES ('" . trim($_POST['name']) . "','" . trim(urldecode($_POST['email'])) . "','" . $_POST['phonenumber'] . "','" . md5(utf8_decode(urldecode($_POST['password']))) . "');";
$userInsertResults = $db->query($user_insert);
$user_query = "SELECT Id from f32ee.User WHERE Email = '" . trim(urldecode($_POST['email'])) . "';";
$userResults = $db->query($user_query);
if ($userInsertResults) {
    $id = $userResults->fetch_assoc()['Id'];
    session_start();

    setcookie($name = 'userId', $value = $id, $expire = time() + (3600 * 24 * 7), $path = "", $domain = "", $secure = false, $httponly = false);
    $_SESSION[$id] = array('Id' => $id, 'PhoneNumber' => $_POST['phonenumber'], 'Name' => $_POST['name'], 'Email' => $_POST['email']);
    $to = 'f32ee@localhost';
    $subject = 'Welcome to ChuLee Cinemas';
    $message = 'Hello ' . $_POST['name'] . ','."\n\n".'Thank you for registering an account with ChuLee Cinemas.'."\n".'You may start booking your movie tickets with us now! '."\n\n".'We look forward to seeing you at ChuLee Cinemas!';
    $headers = 'From: hello@chuleecinemas.com' . "\r\n" . 'Reply-To: f32ee@localhost' . "\r\n" . 'X-mailer:PHP/' . phpversion();
    mail($to, $subject, $message, $headers, '-f32ee@localhost');
    echo "<script>
    alert('You have successfully registered for an account!');
    window.location.href = 'index.php';
    </script>";
}
?>