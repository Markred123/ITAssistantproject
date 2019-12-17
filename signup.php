<?php
session_start();
// if the user is already logged in this will redirect them to the Services page
if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
    header("location: index.php");
    exit;
}
require_once "configuration.php";


// Variables used for the password and usernames
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$uppercase = preg_match('@[A-Z]@', $password);

// This code processes the data when the sign up button is clicked

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // this code validates the username entered
    if(empty(trim($_POST["username"]))){
        $username_err = "You have not entered your username correctly";
    }
        
        else{ 
            //selects information from the prexisiting database ( ON gearhost )
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if ($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                
                // setting the params
                $param_username = trim($_POST["username"]);
                // executing hte statement
                
                if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)== 1){
                        $username_err = "This name is already taken";     
                    }
                    else {
                        $username = trim($_POST["username"]);
                    }  
                }
                else{
                    echo "Error, please try again";
                }
                
            }
            mysqli_stmt_close($stmt);
        }
    if (empty(trim($_POST["password"]))){
        $password_err = "Enter a password";
    }
    elseif(strlen(trim($_POST["password"]))<8){
        $password_err = "Password needs to be 8 characters or longer";
        
    }
    else{
        $password = trim($_POST["password"]);
    }
    // this piece of the code is for validating the password it checks if the password field is empty and also checks if the confirm password field matches the password field
    if (empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirm your password";
    }
    else {
        $confirm_password = trim($_POST ["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "password did not match";
        }
    }
    
    // this checks the code before inserting it into the database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        //insert statement inserting the info into the database
        $sql = "INSERT INTO users (username, password) VALUES (?,?)";
        if ($stmt = mysqli_prepare($link, $sql)){
            // bind variables are params
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // setting the params
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            // hashes the password
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
                
            }
            else {
                echo "something went wrong, try again";
            }
        }
        mysqli_close($link);
        
    }
    
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sign Up </title>

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
                      
                        if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
                            echo '<li><a href="SignOut.php">Sign out</a></li>' ;
                            
                        }
                        else echo '<li><a href="login.php">Login</a></li> <li><a href="signup.php">Sign-Up</a></li>';
                     
                            
                        
                            
                        
                    ?>
					
                    
				</ul>
		  </div>
		</div>
	  </nav>
	

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">                       
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Sign Up</h3>
                            		<p>Enter your desired username and password to register an account:</p>
                        		</div>
                            </div>
                            <div class="form-bottom">
								<form action="<?php echo   htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
									<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
										<label>Username</label>
										<input type="email" name="username" class="form-control" placeholder="e.g JohnSmith" maxlength="40" value="<?php echo $username; ?>">
										<span class="help-block"><?php echo $username_err; ?></span>
									</div>    
									<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
										<label>Password</label>
										<input type="password" id="password" name="password" class="form-control" placeholder="Enter your desired password" maxlength="20" pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one uppercase letter, one number, one special character and be at least 8 characters long." value="<?php echo $password; ?>"required>
										<span class="help-block"><?php echo $password_err; ?></span>
									</div>
									<div class="form-group <?php echo (!empty($confirm_password_err)) ?         'has-error' : ''; ?>">
										<label>Confirm Password</label>
										<input type="password" id="confirm-password" name="confirm_password" class="form-control" placeholder="Confirm your entered password" maxlength="20" pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one uppercase letter, one number, one special character and be at least 8 characters long." value="<?php echo $confirm_password; ?>">
										<!-- 
										Addded password requirements.
										Added input validation (Enforcing maxlength limits, validating e-mail input)
										-->
										<span class="help-block"><?php echo $confirm_password_err; ?></span>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Sign Up">
										<input type="reset" class="btn btn-default" value="Clear">
									</div>
									<p>Already have an account? <a href="login.php">Login here</a>.</p>
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