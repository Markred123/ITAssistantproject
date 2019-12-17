<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Room booking</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
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
				<a class="navbar-brand" href="#"><img src="img/p.jpg" width="30" height="30" alt=""> TheBook</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="Companies.php">List of Companies</a></li>
					<li><a href="RandomPassword.php">Random Password Generator</a></li>
					<?php
                        session_start();
                        if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
                            echo '<li><a href="SignOut.php">Sign out</a></li>' ;

                        }
                        else echo '<li><a href="login.php">Login</a></li> <li><a href="signup.php">Sign-Up</a></li>';





                    ?>


				</ul>
			</div>
		</div>
	</nav>

	<section id="showcase">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="showcase-left">
			<div class="jumbotron">
				<h1 class="a">Work Assistant</h1>
				<h2 class="b">You can use this website to safely store your files and passwords</h2>
				<hr class="my-4">
				<a class="btn btn-primary btn-lg" href="bookroom.php" role="button">View Companies</a>
			</div>
		</div>
		</div>
		</div>
		</div>
	</section>

	<br>
	<hr>

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<script>
		$(function() {
			// Smooth Scrolling
			$('a[href*="#"]:not([href="#"])').click(function() {
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
		});

	</script>
</body>
</html>
