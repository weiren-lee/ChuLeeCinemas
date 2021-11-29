<!DOCTYPE html>
<html lang="en">
<head>
<title>ChuLee Cinemas</title>
<meta charset="utf-8"/>
</head>
<link rel="stylesheet" href="main.css"/>
<link rel="stylesheet" href="thankyou.css"/>

<?php
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}

$seats = $_COOKIE['seats'];
$name = $_POST['Name'];
$phone = $_POST['Phone'];
$userId = $_COOKIE['userId'];
$sessionId = $_COOKIE['selectedSession'];
$movieId = $_COOKIE['selectedMovie'];
$seatsCount = $_COOKIE['seatsCount'];

//for movie
$movie_sql = "SELECT * FROM f32ee.Movies WHERE Id='".$movieId."'";
$movie_result = $db->query($movie_sql);
$movie = $movie_result->fetch_assoc();

//for session date and time
$session_sql = "SELECT * FROM f32ee.Session WHERE Id='".$sessionId."'";
$session_result = $db->query($session_sql);
$session = $session_result->fetch_assoc();

$movieName = $movie['MovieName'];
$sessionDay = $session['Day'];
$sessionTime = $session['Time'];

//for sessionday to fixed date
if ($sessionDay == 'Monday') {
    $sessionDate = '1 Nov 2021';
}
if ($sessionDay == 'Tuesday') {
    $sessionDate = '2 Nov 2021';
}
if ($sessionDay == 'Wednesday') {
    $sessionDate = '3 Nov 2021';
}
?>
<body>
	<div id="wrapper">
        <?php include "./navbar.php";?>
		<div id="container">
            <div id="thankyou">
                <h1>Thank You for your purchase!</h1>
            </div>
            <div id="content">
                <h2>We hope you enjoy your movie!</h2>
                <p>You have purchased <u><?php echo $seatsCount?></u> tickets for <u><?php echo $movieName?></u> on <?php echo $sessionDate?> at <?php echo  $sessionTime?></p>
                <p>You can check your email or <a href="./mybookings.php">My Bookings<a> section for more details.</p>
                <p>Click <a href="./index.php">HERE</a> to return to homepage.</p>
            </div>
        </div>
        <div style = "position: fixed; bottom:0; left:0; right:0;">
            <?php include "./footer.php"; ?>
        </div>
    </div>
</body>
</html>
