<!DOCTYPE html>
<html lang="en">

<head>
    <title>ChuLee Cinemas</title>
    <meta charset="utf-8" />
</head>
<link rel="stylesheet" href="main.css" />
<link rel="stylesheet" href="index.css" />
<link rel="stylesheet" href="moviedetails.css" />

<?php
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}
$selectedMovie = $_GET['movie'];
date_default_timezone_set('Singapore');

$sql = "SELECT * FROM Movies WHERE Id = '" . $selectedMovie . "'";
$result = $db->query($sql);
$numRows = $result->num_rows;
$movie = $result->fetch_assoc();
?>

<body>
    <div id="wrapper" style="margin-left: none !important;">
        <?php include "./navbar.php"; ?>
        <div id="container">
            <div id="movieposter">
                <img src="<?php echo './assets/movie/poster/' . $movie['Image'] . '.jpg'; ?>" />
            </div>
            <div id="moviedetails">
                <div id="detailright">
                    <div id="moviename">
                        <h2 style="margin:10px 0"><?php echo $movie['MovieName'] ?></h2>
                    </div>
                    <h2><u>Details</u></h2>
                    <h3>Cast</h3>
                    <p><?php echo $movie['Cast'] ?></p>
                    <h3>Director</h3>
                    <?php echo $movie['Director'] ?>
                    <h3>Genre</h3>
                    <?php echo $movie['Genre'] ?>
                    <h3>Duration</h3>
                    <p>120 minutes</p>
                </div>
                <div>
                    <h3>Synopsis</h3>
                    <p><?php echo $movie['Synopsis'] ?></p>
                </div>
            </div>
        </div>
        <?php
            if ((int)$selectedMovie > 5){
                ?>
                <div style="text-align: center; font-size: 30px; margin: 40px"> This movie is currently not in cinemas yet.</div>
                <?php
            }
            else {
                ?>
        <div class="bottom">
            <h2 style="margin-bottom: 15px;"><u>Movie Timings</u></h2>
            <form action="seatsSelection.php" method="GET">
                <table id="table" border="1" width="500px" height="150">
                    <tr>
                        <td><b>Days</b></td>
                        <td>
                            <b>
                            2021-11-01, Monday
                            </b>
                        </td>
                        <td>
                            <b>
                            2021-11-02, Tuesday
                            </b>
                        </td>
                        <td>
                            <b>
                            2021-11-03, Wednesday
                            </b>
                        </td>

                    </tr>

                    <tr>
                        <td><b>Timings</b></td>
                        <?php
                            $session_sql = "SELECT * FROM f32ee.Session WHERE Day='Monday' ";
                            $session_result = $db->query($session_sql);
                            $numRows = $session_result->num_rows;
                            ?>
                        <td>
                            <?php
                            if ($numRows==0) {
                                echo 'No timings available';
                            }
                            for ($i = 0; $i < $numRows; $i++) {
                                $session = $session_result->fetch_assoc();
                                ?> 
                                <input required type="radio" name="session" value="<?php echo $session['Id'] ?>">
                                <label><?php echo $session['Time'] ?></label>
                                <br/>
                                <?php
                            }
                            ?>
                        </td>
                        <?php
                            $session_sql = "SELECT * FROM f32ee.Session WHERE Day='Tuesday' ";
                            $session_result = $db->query($session_sql);
                            $numRows = $session_result->num_rows;
                            ?>
                        <td>
                            <?php
                            if ($numRows==0) {
                                echo 'No timings available';
                            }
                            for ($i = 0; $i < $numRows; $i++) {
                                $session = $session_result->fetch_assoc();
                                ?> 
                                <input required type="radio" name="session" value="<?php echo $session['Id'] ?>">
                                <label><?php echo $session['Time'] ?></label>
                                <br/>
                                <?php
                            }
                            ?>
                        </td>
                        <?php
                            $session_sql = "SELECT * FROM f32ee.Session WHERE Day='Wednesday' ";
                            $session_result = $db->query($session_sql);
                            $numRows = $session_result->num_rows;
                            ?>
                        <td>
                            <?php
                            if ($numRows==0) {
                                echo 'No timings available';
                            }
                            for ($i = 0; $i < $numRows; $i++) {
                                $session = $session_result->fetch_assoc();
                                ?> 
                                <input required type="radio" name="session" value="<?php echo $session['Id'] ?>">
                                <label><?php echo $session['Time'] ?></label>
                                <br/>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <input type="hidden" name="movie" value="<?php echo $selectedMovie['Id']?>">
                </table>
                <div style="margin-top: 20px;">
                    <input type="submit" value="Book Now"/>
                </div>
            </form>
        </div>
        <?php
            }
            ?>
    </div>
    <?php include "./footer.php"; ?>
    </div>
</body>
</html>
