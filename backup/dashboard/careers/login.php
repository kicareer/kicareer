<?php
?>
<!DOCTYPE HTML>
<html lang="eng">
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/login-new.css" rel='stylesheet' type='text/css' />
<link href="css/esdy.css" rel='stylesheet' type='text/css' />
<link href="css/swiper.min.css" rel='stylesheet' type='text/css' />
<link href="css/fontawesome-all.min.css" rel="stylesheet">
<link href="css/slick.min.css" rel="stylesheet">
</head>
<body style="background: #f2f2f2;background: url('images/login-bg.jpg');">
<form method="POST" action="dashboard/">
	<section class="login-container">
		<center><h4 class="m-t-20">Login to your account</h4></center>
		<?php
			if (isset($_GET['no-user'])) {
				echo '<div class="alert alert-danger">User not found!</div>';
			}
			if (isset($_GET['incorrect-password'])) {
				echo '<div class="alert alert-danger">Invalid password, Please try again</div>';
			}
			if (isset($_GET['password_updated'])) {
				echo '<div class="alert alert-success"> <i class="fas fa-check-circle"> </i> Password Updated</div>';
			}
		?>
		<div style="clear: both;" class="m-t-30">
			<input type="" class="login-input" name="email" placeholder="Your Email" value="admin@elite.com">
			<input type="password" class="login-password" name="password" placeholder="********"  value="********">
			<button class="login-btn" name="login_now" type="submit">
				<i class="far fa-arrow-alt-circle-right"></i>
			</button>
		</div>
		<div style="clear:both">
			<center><label><input type="checkbox" name=""> Keep me signed in</label></center>
			<center><hr style="width:80%;margin:0"></center>
			<center><small>Forgot your  <a href="forgot-password.php">password</a>?</small></center>
		</div>
	</section>
</form>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js "></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
</body>
</html>
<?php
$esdy_in=null;
?>