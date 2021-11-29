<!DOCTYPE html>
<html lang="en">
<head>
<title>ChuLee Cinemas</title>
<meta charset="utf-8"/>
</head>
<link rel="stylesheet" href="main.css"/>
<link rel="stylesheet" href="index.css"/>
<?php
    session_start();
    $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
    if (mysqli_connect_errno()) {
        exit('Unable to connect to db');
    }
	$movie_sql = "SELECT * FROM f32ee.Movies ORDER BY Id ASC";
    $movie_query = $db->query($movie_sql);

    $user_sql = "SELECT * FROM f32ee.User WHERE Id = '" . $_COOKIE['userId'] . "'";
    $user_query = $db->query($user_sql);

	$session_sql = "SELECT * FROM f32ee.Session";
	$session_query = $db->query($session_sql);

	$cinema_sql = "SELECT * FROM f32ee.Cinema";
	$cinema_query = $db->query($cinema_sql);
	
    $movies = array();
    if ($movie_query->num_rows > 0) {
		while ($a = $movie_query->fetch_assoc()) {
			array_push($movies, $a);
        }
    }
	$sessions = array();
	if ($session_query->num_rows > 0) {
		while ($a = $session_query->fetch_assoc()) {
			array_push($sessions, $a);
		}
	}
	$cinemas = array();
	if ($cinema_query->num_rows > 0) {
		while ($a = $cinema_query->fetch_assoc()) {
			array_push($cinemas, $a);
		}
	}
    $db->close();
?>

<body>
	<div id="wrapper">
		<?php include "./navbar.php";?>
		<div id="container">
			<div id="content">
				<div id="main">
					<div id="movieslide">
						<div class="preview fade">
							<img src="https://i2.wp.com/thefutureoftheforce.com/wp-content/uploads/2021/08/Shang-Chi-And-The-Legend-Of-The-Ten-Rings-Header-2.jpg?fit=1920%2C1080&ssl=1" >
							<div class="caption">Marvel Studios Shang-Chi and the Legend of the Ten Rings</div>
						</div>
						<div class="preview fade">
							<img src="https://i0.wp.com/bloody-disgusting.com/wp-content/uploads/2021/08/dune-poster-2-new.png?w=1515&ssl=1" >
							<div class="caption">Dune</div>
						</div>
						<div class="preview fade">
							<img src="https://w0.peakpx.com/wallpaper/148/292/HD-wallpaper-black-widow-poster-black-widow-2021-movies-movies.jpg">
							<div class="caption">Black Widow</div>
						</div>
						<div style="text-align:center">
							<span class="circle"></span> 
							<span class="circle"></span> 
							<span class="circle"></span> 
						</div>
					</div>
					<div id="mainright">
						<div id="quickbuy">
							<form method="GET" action="./seatsSelection.php">
								<table border="0">
									<tr>
										<th>Quick Buy!</th>
									</tr>
									<tr>
										<td>
											<select required value="Cinemas">
												<option value="" disabled selected hidden>Cinema</option>
												<?php
													for ($i = 0; $i < count($cinemas); $i++) {
														echo '<option value="' . $cinemas[$i]['Id'] . '">' . $cinemas[$i]['Cinema'] . '</option>';
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<select required name="movie" value="Movies">
												<option value="" disabled selected hidden>Movie</option>
												<?php
													for ($i = 0; $i < count($movies); $i++) {
														echo '<option value="' . $movies[$i]['Id'] . '">' . $movies[$i]['MovieName'] . '</option>';
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<select required name="session" value="Date and Time">
												<option value="" disabled selected hidden>Date and Time</option>
												<?php
													for ($i = 0; $i < 9; $i++) {
														echo '<option value="' . $sessions[$i]['Id'] . '">' . $sessions[$i]['DayThreeLetter'] .' '. $sessions[$i]['Time'] .'</option>';
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<input class="quickbuybutton" type="reset">
											<input class="quickbuybutton" type="submit" value="Buy Now!"> 
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
				<div>
					<div id="movies">
						<h1>Now Showing in Cinemas!</h1>
					</div>
					<div id="moviescontent" class="moviescontent">
						<div class="wrapper">
							<div class="nowshowing">
								<?php
								for ($i = 0; $i < count($movies)/2; $i++) {
								?>
									<a href="<?php echo './moviedetails.php?movie=' . urlencode($movies[$i]['Id']) ?>"
									style="text-decoration: none; color: black; font-weight: bold;">
										<div class="poster">
											<img src="<?php echo './assets/movie/poster/' . $movies[$i]['Image'] . '.jpg'; ?>" />
										</div>
										<p class="moviedetailname" style="text-align: center"><?php echo $movies[$i]['MovieName']; ?></p>
									</a>
								<?php
								}
								?>
							</div>
						</div>
						<div id="movies">
							<h1>Coming Soon!</h1>
						</div>
						<div class="wrapper">
							<div class="nowshowing">
								<?php
								for ($i = count($movies)/2; $i < count($movies); $i++) {
								?>
									<a href="<?php echo './moviedetails.php?movie=' . urlencode($movies[$i]['Id']) ?>" 
									style="text-decoration: none; color: black; font-weight: bold; ">
										<div class="poster">
											<img src="<?php echo './assets/movie/poster/' . $movies[$i]['Image'] . '.jpg'; ?>" />
										</div>
										<p class="moviedetailname" style="text-align: center;"><?php echo $movies[$i]['MovieName']; ?></p>
									</a>
								<?php
								}
								?>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<?php include "./footer.php"; ?>
	</div>
</body>
</html>

<script>
var banner = 0;
changeBanner();

function changeBanner() {
  var i;
  var preview = document.getElementsByClassName("preview");
  var circles = document.getElementsByClassName("circle");
  for (i = 0; i < preview.length; i++) {
    preview[i].style.display = "none";  
  }
  banner++;
  if (banner > preview.length) {banner = 1}    
  for (i = 0; i < circles.length; i++) {
    circles[i].className = circles[i].className.replace(" active", "");
  }
  preview[banner-1].style.display = "block";  
  circles[banner-1].className += " active";
  setTimeout(changeBanner, 3000); 
}
</script>