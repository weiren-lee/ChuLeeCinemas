<header>
    <a href="index.php"><img src="./assets/logo2.png" alt="ChuLee Cinemas"/></a>
    <nav>
        <ul class="topnavlinks">
            <div id="start">
                <li class="wordHeader"><a href="index.php"><strong>Movies</strong></a></li>
                <li class="wordHeader"><a href="besafe.php"><strong>Be Safe</strong></a></li>
            </div>
            <div id="end">
                <?php if (isset($_COOKIE["userId"])){
                    ?>
                    <div class="dd">
                        <input type="image" style="height: 50px;" src="./assets/triplebar.png" alt="triplebar" id="ddbutton" class="ddbutton"></button>
                        <div id="ddlist" class="ddlist">
                            <a href="./mybookings.php">My Bookings</a>
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <li class="wordHeader"><a href="signup.php">Register</a></li>
                    <li><a href="login.php"><strong><input type="button" value="Log In"/></strong></a></li>
                <?php
                }
                ?>
            </div>
        </ul>
    </nav>
</header>
<script>
document.getElementById("ddbutton").onclick = function() {myFunction()};
function myFunction() {
    document.getElementById("ddlist").classList.toggle("show");
}
window.onclick = function(event) {
    if (!event.target.matches('.ddbutton')) {
        var ddlist = document.getElementsByClassName("ddlist");
        var a;
        for (a = 0; a < ddlist.length; a++) {
            var opendd = ddlist[a];
            if (opendd.classList.contains('show')) {
                opendd.classList.remove('show');
            }
        }
    }
}
</script>
