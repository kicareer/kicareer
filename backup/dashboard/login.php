<?php
include 'headers.php';
include('../classes/posts.php');


$jobcount = new posts($conn);
$joblistcount = $jobcount ->joblistcount();

$applicantcount = new posts($conn);
$applicantlistcount = $applicantcount ->applicantlistcount();


?>

<body style="background: #f2f2f2;background: url('../images/login-bg.jpg');">

<!--    
    
<form method="POST" action="">
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
			<input type="text" class="login-input" name="username" placeholder="Your Email" value="admin@elite.com">
			<input type="password" class="login-password" name="password" placeholder="********"  value="********">
			<button class="login-btn" name="submit" type="submit">
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
 -->
    
    
<div class="container py-5 login-form"> 
    
    <div class="row justify-content-center">
        <div class="col-5">
        	<center>
        		<img src="../images/kenz-logo1.png" style="width:180px">
        	</center>
            <div class="mb-3 bg-light px-3 py-3 rounded mx-2 my-2">
             <form action="" method="POST">
              <label for="exampleFormControlInput1" class="form-label">Enter Password</label>
              <input type="text" class="form-control mb-3" name="username" id="exampleFormControlInput1" placeholder="Enter Username">
              <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="********">
              <input type="submit" name="submit" class="submit btn btn-primary mt-3" >
             </form>
            </div>
   
        </div>
    </div>
   
    
    
<?php 

if(isset($_SESSION['username'])) {
    
    echo "<script>location.replace('index.php')</script>";
    
}

  if(isset($_POST['submit'])) {
      include 'password.php';
      if($_POST['password'] == $password && $_POST['username'] == "admin") {
          
          $_SESSION['password'] = $_POST['password'];
          $_SESSION['username'] = $_POST['username'];
          echo "<script>location.replace('index.php')</script>";
          
      } else {
          
          echo "<div class='text-center'><div class='alert alert-danger' style='max-width: 400px;display: inline-block;width: 100%;'>Inccorrect Password</div></div>";
      }
  }


?>

</div>




	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js "></script>
	
	
	</div>
</body>
</html>