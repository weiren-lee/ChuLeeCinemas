<!DOCTYPE html>
<html lang="en">

<head>
  <title>ChuLee Cinemas</title>
  <meta charset="utf-8" />
</head>
<link rel="stylesheet" href="main.css" />
<link rel="stylesheet" href="index.css" />
<link rel="stylesheet" href="moviedetails.css" />
<link rel="stylesheet" href="seatsSelection.css" />

<?php include "./navbar.php";
session_start();
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
  echo 'Error: Could not connect to database.';
  exit;
}

if (!isset($_COOKIE['userId'])) {
  echo "<script>
  alert('You need to log in to an account first!');
  window.location.href = 'login.php';
  </script>";
}

$selectedMovie = $_GET['movie'];
$selectedSession = $_GET['session'];
setcookie($name = 'selectedMovie', $value = $_GET['movie'], $expire = time() + (86400), $path = "", $domain = "", $secure = false, $httponly = false);
setcookie($name = 'selectedSession', $value = $_GET['session'], $expire = time() + (86400), $path = "", $domain = "", $secure = false, $httponly = false);

$movie_sql = "SELECT * FROM f32ee.Movies WHERE Id='".$selectedMovie."' ";
$movie_result = $db->query($movie_sql);
$movie = $movie_result->fetch_assoc();

$session_sql = "SELECT * FROM f32ee.Session WHERE Id='". $selectedSession ."' ";
$session_result = $db->query($session_sql);
$session = $session_result->fetch_assoc();
?>
<body>
  <div id="wrapper">
  <div style="text-align:center" class="movie-selected">
    <h3>You have selected <u><?php echo $movie['MovieName'] ?></u> on <u><?php echo $session['Day'] ." ". $session['Time'] ?> </u> </h3>
  </div>
  <ul class="legend">
    <li>
      <div class="seat"></div>
      <small>Available</small>
    </li>
    <li>
      <div class="seat selected"></div>
      <small>Selected</small>
    </li>
    <li>
      <div class="seat occupied"></div>
      <small>Sold</small>
    </li>
    <li>
      <div class="seat covid"></div>
      <small>Safe Distancing</small>
    </li>
  </ul>
  <div class="container">
    <div class="screen"></div>
    <div class="row">
      <h2>A</h2>
        <?php
        $seats_sql = "SELECT * FROM `Seats` WHERE Rows = 'A' and MovieId = '" . $selectedMovie . "' and SessionId = '" . $selectedSession . "'";
        $seats_result = $db->query($seats_sql);
        $num_result = $seats_result->num_rows;
        // ini_set('display_errors', 1);
        for ($i = 0; $i < $num_result; $i++) {
          $seat = $seats_result->fetch_assoc();
          $unavailable_seat_sql = "SELECT * FROM `MyBookings` WHERE SeatId = '" . $seat['Id'] ."'";
          $unavailable_seat_result = $db->query($unavailable_seat_sql);
          $unavailable_seat = $unavailable_seat_result->fetch_assoc();

          if ($seat['States'] == 'Occupied') {
            ?>
            <div id="A<?php echo $i+1?>" class="seat occupied"></div>
            <?php
          }
          elseif ($seat['States'] == 'Available') {
            ?>
            <div id="A<?php echo $i+1?>" class="seat"></div>
            <?php
          };
          if ($seat['States'] == 'Covid') {
          ?>
            <div id="A<?php echo $i+1?>" class="seat covid"></div>
          <?php
          };
          ?>
        <?php
        } 
        ?>
    <h2>A</h2>
    </div>
    <div class="row">
      <h2>B</h2>
        <?php
        $seats_sql = "SELECT * FROM `Seats` WHERE Rows = 'B' and MovieId = '" . $selectedMovie . "' and SessionId = '" . $selectedSession . "'";
        $seats_result = $db->query($seats_sql);
        $num_result = $seats_result->num_rows;

        for ($i = 0; $i < $num_result; $i++) {
          $seat = $seats_result->fetch_assoc();
          $unavailable_seat_sql = "SELECT * FROM `MyBookings` WHERE SeatId = '" . $seat['Id'] ."'";
          $unavailable_seat_result = $db->query($unavailable_seat_sql);
          $unavailable_seat = $unavailable_seat_result->fetch_assoc();

          if ($seat['States'] == 'Occupied') {
            ?>
            <div id="B<?php echo $i+1?>" class="seat occupied"></div>
            <?php
          }
          elseif ($seat['States'] == 'Available') {
            ?>
            <div id="B<?php echo $i+1?>" class="seat"></div>
            <?php
          };
          if ($seat['States'] == 'Covid') {
          ?>
            <div id="B<?php echo $i+1?>" class="seat covid"></div>
          <?php
          };
          ?>
        <?php
        } 
        ?>
    <h2>B</h2>
    </div>

    <div class="row">
      <h2>C</h2>
        <?php
        $seats_sql = "SELECT * FROM `Seats` WHERE Rows = 'C' and MovieId = '" . $selectedMovie . "' and SessionId = '" . $selectedSession . "'";
        $seats_result = $db->query($seats_sql);
        $num_result = $seats_result->num_rows;

        for ($i = 0; $i < $num_result; $i++) {
          $seat = $seats_result->fetch_assoc();
          $unavailable_seat_sql = "SELECT * FROM `MyBookings` WHERE SeatId = '" . $seat['Id'] ."'";
          $unavailable_seat_result = $db->query($unavailable_seat_sql);
          $unavailable_seat = $unavailable_seat_result->fetch_assoc();

          if ($seat['States'] == 'Occupied') {
            ?>
            <div id="C<?php echo $i+1?>" class="seat occupied"></div>
            <?php
          }
          elseif ($seat['States'] == 'Available') {
            ?>
            <div id="C<?php echo $i+1?>" class="seat"></div>
            <?php
          };
          if ($seat['States'] == 'Covid') {
          ?>
            <div id="C<?php echo $i+1?>" class="seat covid"></div>
          <?php
          };
          ?>
        <?php
        } 
        ?>
    <h2>C</h2>
    </div>
    <div class="row">
      <h2>D</h2>
        <?php
        $seats_sql = "SELECT * FROM `Seats` WHERE Rows = 'D' and MovieId = '" . $selectedMovie . "' and SessionId = '" . $selectedSession . "'";
        $seats_result = $db->query($seats_sql);
        $num_result = $seats_result->num_rows;

        for ($i = 0; $i < $num_result; $i++) {
          $seat = $seats_result->fetch_assoc();
          if ($seat['States'] == 'Occupied') {
            ?>
            <div id="D<?php echo $i+1?>" class="seat occupied"></div>
            <?php
          }
          elseif ($seat['States'] == 'Available') {
            ?>
            <div id="D<?php echo $i+1?>" class="seat"></div>
            <?php
          };
          if ($seat['States'] == 'Covid') {
          ?>
            <div id="D<?php echo $i+1?>" class="seat covid"></div>
          <?php
          };
          ?>
        <?php
        } 
        ?>
    <h2>D</h2>
  </div>
  <div>
  <div id='countprice' style="max-width: 650px; margin-bottom: 20px;"></div>
  </div>
  <div id="payment">
      <h2 style="padding: 10px 0 0 50px;">Payment Details</h2>
      <div id="form">
        <form method="post" action="payment_success.php" id="paymentForm">
          <label>*Name: </label><br/>
          <input class="paymentform" type="text" name="Name" id="Name" size="30" placeholder="John Lee" required onchange="validateName()"><br>
          <label for="Phone">*Contact Number: </label><br/>
          <input class="paymentform" type="text" name="Phone" id="Phone" size="8" minlength="8" maxlength="8" placeholder="98765432" required onchange="validatePhone()"><br>
          <label>*Name on Credit Card: </label><br/>
          <input class="paymentform" type="text" name="CName" id="CName" size="30" placeholder="John Lee" required onchange="validateCName()"><br>
          <label>*Credit Card Number: </label><br/>
          <input class="paymentform" type="text" name="card" id="card" size="30" minlength="16" maxlength="16" placeholder="1111222233334444" required onchange="validateCard()"><br>
          <div id="mainclass">
            <div id="class1">
              <label>*CVV: </label><br/>
              <input type="numbers" id="cvv" name="cvv" minlength="3" maxlength="3" placeholder="352" required onchange="validateCVV()"><br>        
            </div>
            <div id="class2">
              <label>*Expiry Date: </label><br/>
              <input type="month" id="exp" name="exp" min="2021" value="2029" required onchange="validateDate()">
            </div>
          </div>
          <input class="quickbuybutton" id="submit" type="submit" style="float: right; margin: 10px;" value="Cart Out"/>
        </form>
      </div>
    </div>  
    </div>
  </div>
  </body>
  <script>
    const container = document.querySelector('.container');
    const seats = document.querySelectorAll('.row .seat:not(.occupied)');
    const price = 10;

    const updateSelectedSeatsCount = () => {
      const selectedSeats = document.querySelectorAll('.row .selected');
      var arr = [];
      const selectedSeatsCount = selectedSeats.length;
      if (selectedSeatsCount==0) {
        countprice.innerText = 'You have not selected any seats.';
        document.cookie='seats='+";expires=Thu, 01 Jan 1970 00:00:01 GMT";
        console.log(document.cookie);
      } else {
        for (let x=0; x<selectedSeatsCount; x++) {
          var selectedseats = document.getElementsByClassName("selected")[x+1].id;
          arr.push(selectedseats);
          document.getElementById("countprice").innerHTML = 'You have selected <u>' +selectedSeatsCount+'</u> seat(s) at <u>'+arr+'</u>.<br/>The total price is '+'<u>'+'$'+selectedSeatsCount*price+'</u>.';
          //for cookie storing
          document.cookie='seatsCount='+selectedSeatsCount;
          document.cookie='seats='+arr;
          // console.log(document.cookie);
        };
      };
    };
    // Seat select event
    container.addEventListener('click', e => {
      if (e.target.classList.contains('seat') &&!e.target.classList.contains('occupied') && !e.target.classList.contains('covid')) {
        e.target.classList.toggle('selected');
        updateSelectedSeatsCount();
      };
    });
    //validation for details
    function validateName(){
      var name = document.getElementById("Name").value;
      name.trim(); 
      if(name.length > 0){ 
        var regexp = /^([A-z',.\s?]+)$/;
        if(regexp.test(name)){
          return true;
        }
        else{
          alert("Name has incorrect format!! Please enter in alphabetical symbols separated with a blankspace.");
          return false;
        }
      }
      alert("Please fill in your name.");
      return false;
    }

    function validateCName(){
      var cname = document.getElementById("CName").value;
      cname.trim(); 
      if(cname.length > 0){ 
        var regexp = /^([A-z',.\s?]+)$/;
        if(regexp.test(cname)){
          return true;
        }
        else{
          alert("Name has incorrect format!! Please enter in alphabetical symbols separated with a blankspace.");
          return false;
        }
      }
      alert("Please fill in your credit card name.");
      return false;
    }

    function validatePhone(){
      var phone = document.getElementById("Phone").value;
      phone.trim();
      if(phone.length > 0){
        var regexp = /(6|8|9)\d{7}/;
        if(regexp.test(phone)){
          return true;
        }
        else{
          alert("Invalid phone number");
          return false;
        }
      }
      alert ("Please fill in contact number");
      return false;
    }

    function validateCard() {
      var card = document.getElementById("card").value;
      card.trim();
      if (card.length > 0){
        var regexp = /[0-9]{16}/;
        if (regexp.test(card)){
          return true;
        }
        else{
          alert("Invalid Card Number");
          return false;
        }
      }
      alert ("Please input Card Number");
      return false;
    }

    function validateCVV(){
        var cvv = document.getElementById("cvv").value;
        cvv.trim();
        if(cvv.length > 0){
          var regexp = /^[0-9]{3}$/;
          if(regexp.test(cvv)) {
            return true;
          }
          else{
            alert("Invalid CVV");
            return false;
          }
        }
        alert ("Please fill up CVV");
        return false; 
    }
    function validateDate(){
      var date = new Date(document.getElementById("exp").value);
      var currentDate = new Date();
      if(date.getFullYear() > currentDate.getFullYear()) {
        return true;
      }
      else if(date.getFullYear() == currentDate.getFullYear()){
        if(date.getMonth() > currentDate.getMonth()){
          return true;
        }
        else if(date.getMonth() == currentDate.getMonth()){
          if(date.getDate() > currentDate.getDate()){
            return true;
          }
        }
      }
      alert("Date must be in the future.");
      return false;
    }

    document.querySelector("form").addEventListener("submit", (e) => {
      const selectedSeats = document.querySelectorAll('.row .selected');
      const selectedSeatsCount = selectedSeats.length;    
      if (selectedSeatsCount==0) {
        alert('Please select a seat before proceeding.');
        e.preventDefault();
      }
    });
  </script>
   
</html>