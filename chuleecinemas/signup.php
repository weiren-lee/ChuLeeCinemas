<!DOCTYPE html>
<html lang="en">
<head>
<title>ChuLee Cinemas</title>
<meta charset="utf-8"/>
</head>
<link rel="stylesheet" href="main.css"/>
<link rel="stylesheet" href="signup.css"/>
<style></style>
<body>
	<div id="wrapper">
        <?php include "./navbar.php";?>
		<div id="container">
            <div id="welcome">
                <h1>Register Today!</h1>
            </div>
            <div id="signup">
                <div id="tablecontent">
                    <form method="post" action="./signup_success.php"> 
                        <label for="name">
                            Name:
                        </label><br/>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Input your name here"
                            required
                            size="100"
                        /><br/>
                        <label for="email">
                            Email:
                        </label><br/>
                        <input 
                            type="email"
                            name="email"
                            id="email"
                            required
                            placeholder="Enter your Email-ID here"
                            size="100"
                        /><br/>
                        <label for="password">
                            Password:
                        </label><br/>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="Enter password here"
                            pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
                            title="Password must include one uppercase and lowercase letter, one number, one special character and at least 8 characters"
                            size="100"
                        /><br/>
                        <div id="popup1" style="display: none;">
                            <p>Password must include:</p>
                            <p id="uppercase" class="cross">At least 1 uppercase letter</p>
                            <p id="lowercase" class="cross">At least 1 lowercase letter</p>
                            <p id="number" class="cross">At least 1 number</p>
                            <p id="specialcharacter" class="cross">At least 1 of the following special characters #?!@$%^&*-</p>
                            <p id="length" class="cross">At least 8 characters long</p>
                        </div>
                        <label for="confirmpassword">
                            Confirm Password:
                        </label><br/>
                        <input
                            type="password"
                            name="confirmpassword"
                            id="confirmpassword"
                            required
                            placeholder="Please re-enter your password"
                            size="100"
                            /><br/>
                        <div id="popup2" style="display: none;">
                            <p id="confirmp" class="cross">
                                Password must match password entered previously.
                            </p>
                        </div>
                        <label for="phonenumber">
                            Phone No.:
                        </label><br/>
                        <input
                            type="tel"
                            name="phonenumber"
                            id="phonenumber"
                            minlength="8"
                            maxlength="8"
                            required
                            placeholder="Enter phone no. here"
                            size="100"
                        /><br/>
                        <input class="quickbuybutton" id="submit" type="submit" style="float: right; height: 30px" value="Register"/>
                    </form>
                </div>
            </div>
        </div>
        <div style = "position: fixed; bottom:0; left:0; right:0;">
            <?php include "./footer.php"; ?>
        </div>	</div>
    <script>
        var inputPassword = document.getElementById("password");
        var inputConfirmPassword = document.getElementById("confirmpassword");
        var confirmp = document.getElementById("confirmp");
        var uppercase = document.getElementById("uppercase");
        var lowercase = document.getElementById("lowercase");
        var number = document.getElementById("number");
        var specialcharacter = document.getElementById("specialcharacter");
        var length = document.getElementById("length");
        let passwordmatch = false;

        //to display message for password
        inputPassword.onfocus = function() {
            document.getElementById("popup1").style.display = "block";
        };
        inputPassword.onblur = function() {
            document.getElementById("popup1").style.display = "none";
        };
        //to display message for confirm password
        inputConfirmPassword.onfocus = function() {
            document.getElementById("popup2").style.display = "block";
        };
        inputConfirmPassword.onblur = function() {
            document.getElementById("popup2").style.display = "none";
        };

        //match password with individual regex
        inputPassword.onkeyup = function () {
            var uppercaseRegex = /[A-Z]/g;
            if (inputPassword.value.match(uppercaseRegex)) {
                uppercase.classList.remove("cross");
                uppercase.classList.add("tick");
            } else {
                uppercase.classList.remove("tick");
                uppercase.classList.add("cross");
            }

            var lowercaseRegex = /[a-z]/g;
            if (inputPassword.value.match(lowercaseRegex)) {
                lowercase.classList.remove("cross");
                lowercase.classList.add("tick");
            } else {
                lowercase.classList.remove("tick");
                lowercase.classList.add("cross");
            }

            var numberRegex = /[0-9]/g;
            if (inputPassword.value.match(numberRegex)) {
                number.classList.remove("cross");
                number.classList.add("tick");
            } else {
                number.classList.remove("tick");
                number.classList.add("cross");
            }

            var specialcharacterRegex = /[#?!@$%^&*-]/g;
            if (inputPassword.value.match(specialcharacterRegex)) {
                specialcharacter.classList.remove("cross");
                specialcharacter.classList.add("tick");
            } else {
                specialcharacter.classList.remove("tick");
                specialcharacter.classList.add("cross");
            }

            if (inputPassword.value.length >= 8) {
                length.classList.remove("cross");
                length.classList.add("tick");
            } else {
                length.classList.remove("tick");
                length.classList.add("cross");
            }
        }

        //match confirm password with password
        inputConfirmPassword.onkeyup = function () {
            if (inputConfirmPassword.value == inputPassword.value) {
                confirmp.classList.remove("cross");
                confirmp.classList.add("tick");
                passwordmatch = true;
            } else {
                confirmp.classList.remove("tick");
                confirmp.classList.add("cross");
                passwordmatch = false;
            }
        };

        document.querySelector("form").addEventListener("submit", (e) => {
            if (passwordmatch == false) {
                alert("Passwords do not match");
                e.preventDefault();
            }
        });

    </script>
</body>
</html>
