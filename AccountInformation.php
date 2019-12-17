<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head id="home">
	<meta charset="utf-8">
	<title>Plum Services</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
		
	<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
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
                        <li><a href = "AccountInformation.php"><?php
                            echo $_SESSION['username']; ?></a> </li>
						<li><a href="index.php">Home</a></li>
						<li><a href="login.php">Login</a></li>
						<li><a href="signup.php">Sign-Up</a></li>
						<li> <a href="SignOut.php" class="btn btn-danger">Sign Out of Your Account </a></li>
			  </ul>
		  </div>
		</div>
	  </nav>
		  
		 <div class="container">
			<div class="col-md-12">
				<h1>Account Information:</h1>
				<h2>Your username is: <?php echo $_SESSION['username']; ?> </h2>
				<h2>Your password is: <?php echo $_SESSION['password']; ?> </h2>
				<h2>You are user number: <?php echo $_SESSION['id']; ?></h2>
			</div>
		</div>
    </body>
    
</html>