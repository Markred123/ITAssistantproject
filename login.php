<?php

//start the session
session_start();
// if the user is already logged in this will redirect them to the Services page
if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
    header("location: index.php");
    exit;
}
require_once "configuration.php";

$username = $password = "";
$username_error = $password_error = "";
// processing the data
if ($_SERVER ["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_error="Enter a username";

    }
    else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_error = "Enter your password";

    }
    else {
        $password = trim($_POST["password"]);
    }
    //validation of login stuff
    if(empty($username_error) && empty($password_error)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            // next we'll attempt to execute the statement

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                // checks if theres records in the database
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();


                            $_SESSION["online"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: index.php");


                } else {
                            $password_error = "Password Incorrect";
                        }
                    }


                }else{
                        $username_error = "Username Incorrect";

                    }
                } else{
                    echo "Something seems to have gone wrong";
                }


        }
          mysqli_stmt_close($stmt);


    }
        mysqli_close($link);

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Login Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/loginstyle.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>

    <body>
	  <nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		  <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img src="" width="30" height="30" alt=""> </a>
		  </div>
		  <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
					<li><a href="bookroom.php">Book a room</a></li>
					<li><a href="booked.php">View booked rooms</a></li>
					<?php
                        session_start();
                        if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
                            echo '<li><a href="SignOut.php">Sign out</a></li>' ;

                        }
                        else echo '<li><a href="login.php">Login</a></li> <li><a href="signup.php">Sign-Up</a></li>';





                    ?>


				</ul>
		  </div>
		  <!--/.nav-collapse -->
		</div>
	  </nav>

    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log in:</p>
                        		</div>
                            </div>

                            <div class="form-bottom">
			                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
			                    	<div class="form-group<?php echo (!empty($username_error)) ? 'has-error' : ''; ?>">
										<label>Username</label>
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="email" name="username" class="form-control" placeholder="Your username" maxlength="40" value="<?php echo $username; ?>">
                                    <span class="help-block"><?php echo $username_error; ?></span>
			                        </div>
			                        <div class="form-group<?php echo (!empty($password_error)) ? 'has-error' : ''; ?>">
										<label>Password</label>
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" class="form-control" placeholder="Your password" maxlength="20">
                                        <span class="help-block"><?php echo $password_error; ?></span>
			                        </div>
									<input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in!">
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>


        <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>
