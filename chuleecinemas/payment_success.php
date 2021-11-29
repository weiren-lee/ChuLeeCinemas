<?php 
session_start();
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');

if (mysqli_connect_errno()) {
  echo 'Error: Could not connect to database.';
  exit;
}

$name = $_POST['Name'];
$phone = $_POST['Phone'];
$seats = $_COOKIE['seats'];
$userId = $_COOKIE['userId'];
$sessionId = $_COOKIE['selectedSession'];
$movieId = $_COOKIE['selectedMovie'];

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
//for seats
$seatIdArray = array();
if (isset($_COOKIE['seats'])) {
    $seatsArray = explode(',',$_COOKIE['seats']);
    // print_r($seatsArray);
    for ($i=0; $i<count($seatsArray); $i++) {
        $seatid_sql = "SELECT * FROM f32ee.Seats WHERE Rows='". $seatsArray[$i][0] ."' AND Columns='". $seatsArray[$i][1].$seatsArray[$i][2] ."' AND MovieId='".$movieId."' AND SessionId='".$sessionId."'";
        $seatid_result = $db->query($seatid_sql);
        $numRows = $seatid_result->num_rows;
        $seatid = $seatid_result->fetch_assoc();
        
        $updateSeatAvailability_sql = "UPDATE Seats SET States='Occupied' WHERE Id='".$seatid['Id']."'";
        $updateSeatAvailability = $db->query($updateSeatAvailability_sql);

        array_push($seatIdArray, $seatid['Id']);
    }
    $seatIdString = implode(",",$seatIdArray);
    $seatIdString = implode(",",$seatIdArray);
    $seatIdString = implode(",",$seatIdArray);

    $insertBooking_sql = "INSERT INTO f32ee.MyBookings(Name, UserId, SeatId, Seats, Date, Time, MovieName, Cinema) VALUES ('".$name."', '".$userId."', '".$seatIdString."', '".$seats."', '".$sessionDate."', '".$sessionTime."', '".$movieName."', 'Nex')";
    $insertBooking = $db->query($insertBooking_sql);

    $to = 'f32ee@localhost';
    $subject = 'Your tickets have been booked!';
    $message = 'Hello ' . $name . ','."\n\n".'You have booked seat(s) ' . $seats . ' for ' . $movieName . ' on ' .$sessionDay. ', ' . $sessionDate . ' at ' . $sessionTime . '.' . "\n\n" . 'We hope to see you soon at ChuLee Cinemas!';
    $headers = 'From: hello@chuleecinemas.com' . "\r\n" . 'Reply-To: f32ee@localhost' . "\r\n" . 'X-mailer:PHP/' . phpversion();
    mail($to, $subject, $message, $headers, '-f32ee@localhost');


    echo "<script>
    alert('Your payment is processing. Please press OK to continue.');
    window.location.href = 'thankyou.php';
    </script>";
} else {
    echo 'You have not logged in OR you have not selected a seat.';
}
?>
