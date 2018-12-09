<?php
  // this starts a session on each page and my database is connected
  require "header.php";
    if (isset($_SESSION['id'])) {
    header("Landing_page.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Developer coding test</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body>
		<section class="login-signup">
		<div class="container">
			<div class="form1 col-md-4 col-md-offset-4 col-sm-offset-3  col-sm-6 col-xs-8 col-xs-offset-2">
			    <div>
				   <h3 class="active">Login</h3>
				   <hr>
				   <br>
			    </div>
			    <!--This is the message i am pulling from the email verification page-->
			    <?php
			    if (isset($_GET["message"])) {
				if ($_GET["Successful"] == "true") {
					echo '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .$_GET["message"]. '</div>';
							}
						}
				?>
				<form name="login"action="includes/login_action_page.inc.php" method="POST">
				    <div id="uname-login-group" class="form-group">
				    	<label for="uname">Username</label>
				    	<input type="text" class="form-control" name="loginuname" placeholder="Username">
				    </div>
				    <div id="pwd-login-group" class="form-group">
				    	<label for="pwd">Password</label>
				    	<input type="password" class="form-control" name="loginpwd" placeholder="Password">
				    </div>
				    <div class="form-group">
				    	<input type="submit" class="btn btn-info" name="login_submit" value="Login">
				    </div> 
				</form>
					<div>
						<p>Don't have an account ? <a href="" id="signUp">Create one</a></p>
					</div>
			    </div>
				<div class="form2 col-md-4 col-md-offset-4 col-sm-offset-3  col-sm-6 col-xs-8 col-xs-offset-2">
			    <div>
			    	<h3 class="active">Signup</h3>
			    	<hr>
			    	<br>
			    </div>
				<form name="signup"action="includes/signin_action_page.inc.php" method="POST">
				    <div id="uname-group" class="form-group">
				    	<label for="uname">Username</label>
				    	<input type="text" class="form-control" name="uname" placeholder="Username">
				    </div>
				    <div id="email-group" class="form-group">
				    	<label for="email">Email</label>
				    	<input type="email" class="form-control" name="email" placeholder="Email">
				    </div>
				    <!--Getting the user types and adding to the form drop down-->
			    <div id="utype-group" class="form-group">
			    	<label for="utype">User type</label>
			    	<select class="form-control" name="utype">
			    		<option value="">Select An option</option>
			    	    <?php
		                    $sql = "SELECT id FROM user_types;";
		                    $result = mysqli_query($conn, $sql);
		                    $resultCheck = mysqli_num_rows($result);
		                    if ($resultCheck > 0) {
		                    while ($row = mysqli_fetch_assoc($result)) {
		                     echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
		                        }
		                    }
						?>
					</select>
			    </div>
				    <div id="pwd-group" class="form-group">
				    	<label for="pwd">Password</label>
				    	<input type="password" class="form-control" name="pwd" placeholder="Password">
				    </div>
				    <div id="pwd_rp-group" class="form-group">
				    	<label for="pwd_rp">Repeat Password</label>
				    	<input type="password" class="form-control" name="pwd_rp" placeholder="Repeat Password">
				    </div>
				    <div class="form-group">
				    	<input type="submit" class="btn btn-info" name="signup_submit" value="Sign up" id="signup_submit">
				    </div> 
				</form>
			    <div>
			    	<p>Already have an account ? <a href="" id="logIn">Login Now</a></p>
			    </div>
			</div>
				</div>
			</section>
			<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<script src="js/login_jquery.js"></script>
			<script src="js/signin_jquery.js"></script>
	</body>
</html>