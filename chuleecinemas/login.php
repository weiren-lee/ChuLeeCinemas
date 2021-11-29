<!DOCTYPE html>
<html lang="en">
<head>
<title>ChuLee Cinemas</title>
<meta charset="utf-8"/>
</head>
<link rel="stylesheet" href="main.css"/>
<link rel="stylesheet" href="login.css"/>
<style></style>
<body>
	<div id="wrapper">
        <?php include "./navbar.php";?>
		<div id="container">
            <div id="welcome">
                <h1>Welcome Back!</h1>
            </div>
            <div id="login">
                <form method="post" action="login_success.php" id="loginForm"> 
                    <div id="tablecontent">
                        <label for="email">
                            Email:
                        </label><br/>
                        <input 
                            type="email"
                            name="email"
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
                            required
                            placeholder="Enter password here"
                            size="100"
                        /><br/>
                        <div id="register">
                            <p>Don't have an account?<br/>
                            <a href="signup.php">Sign up Now!</a></p>
                            <input class="quickbuybutton" id="submit" type="submit" value="Log In"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style = "position: fixed; bottom:0; left:0; right:0;">
            <?php include "./footer.php"; ?>
        </div>	</div>
</body>
</html>
