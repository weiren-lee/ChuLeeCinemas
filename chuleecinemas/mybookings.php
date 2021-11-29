<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ChuLee Cinemas</title>
        <meta charset="utf-8"/>
    </head>
    <link rel="stylesheet" href="main.css"/>
    <link rel="stylesheet" href="mybookings.css"/>
    <?php
    session_start();
    $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.';
        exit;
    }
    ?>
    <body>
        <div id="wrapper">
            <?php include "./navbar.php";?>
            <div id="container">
                <div id="mybookingscontent">
                    <h1>My Bookings</h1>
                    <div id="mybookings">
                        <table border=0>
                            <tr>
                                <th>Movie</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Cinema</th>
                                <th>Seat No.</th>
                            </tr>
                            <?php
                                $userId = $_COOKIE['userId'];
                                $sql = "SELECT * FROM MyBookings WHERE UserId= '".$userId."'";
                                $result = $db->query($sql);
                                $numRows = $result->num_rows;
                                if ($numRows==0) {
                                    ?>
                                    <td colspan="5" style="text-align: center; font-size:larger"> There are no bookings made yet </td>
                                    <?php
                                }
                                for ($i=0; $i<$numRows; $i++) {
                                    $movie = $result->fetch_assoc();
                                ?>
                                <tr>
                                <td><?php echo $movie['MovieName']?></td>
                                <td><?php echo $movie['Date']?></td>
                                <td><?php echo $movie['Time']?></td>
                                <td><?php echo $movie['Cinema']?></td>
                                <td><?php echo $movie['Seats']?></td>
                                <?php
                                }?>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        <div style = "position: fixed; bottom:0; left:0; right:0;">
            <?php include "./footer.php"; ?>
        </div>        
    </div>
</body>
</html>
