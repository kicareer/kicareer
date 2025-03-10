<?php
include 'headers.php';
include('../classes/posts.php');

$jobcount = new posts($conn);
$joblistcount = $jobcount ->joblistcount();

$applicantcount = new posts($conn);
$applicantlistcount = $applicantcount ->applicantlistcount();

?>


<?php if(isset($_SESSION['username'])) { } else {
    
    echo "<script>location.replace('login.php')</script>";
    
} ?>

<?php
	include 'top-nav.php';
?>
<div class="container-fluid">
	<?php
		include 'navigation.php';
	?>
</div>
	<div class="container-fluid m-t-20">
	    
		<div class="row">
		    
			<div class="col-md-3">
			    
			    <div class="card text-center text-white" style="border-radius: 12px;background: #1C7AA5;">
  			       <div class="card-body text-center">
  			         <i class="fas fa-users h1 mb-3"></i>
    			     <h5 class="card-title">Job Posts</h5>
  			       </div>
  			      <ul class="list-group list-group-flush" style="background: #1C7AA5;">
    			    <li class="list-group-item text-white" style="background: #1C7AA5;">Total Posts : <?php echo $joblistcount; ?></li>
  			      </ul>
  			      <div class="">
    			    <a href="job-list.php" class="card-link text-white d-block py-2" style="border-bottom-right-radius: 12px;border-bottom-left-radius: 12px;font-weight: 600;background:#d392ba ;">View Posts</a>
  			      </div>
			    </div>
	
			</div>
			
			<div class="col-md-3">
			
			<div class="card text-center text-white" style="border-radius: 12px;background: #1C7AA5">
  			       <div class="card-body text-center">
  			         <i class="far fa-file-alt h1 mb-3"></i>
    			     <h5 class="card-title">Applications</h5>
  			       </div>
  			      <ul class="list-group list-group-flush">
    			    <li class="list-group-item text-white" style="background: #1C7AA5;">Total Applicants : <?php echo $applicantlistcount; ?></li>
  			      </ul>
  			      <div class="">
    			    <a href="applicants-list.php" class="card-link text-white d-block py-2" style="border-bottom-right-radius: 12px;border-bottom-left-radius: 12px;font-weight: 600;background:#d392ba ;">View Applicants</a>
  			      </div>
			    </div>
			    
			</div>    
			    
			<div class="col-md-3">
			        
			<!-- <div class="card text-center bg-primary text-white" style="border-radius: 12px;">
  			       <div class="card-body text-center">
  			         <i class="fas fa-user-plus h1 mb-3"></i>
    			     <h5 class="card-title">Vacancies</h5>
  			       </div>
  			      <ul class="list-group list-group-flush">
    			    <li class="list-group-item bg-primary text-white">Total Posts : 1</li>
  			      </ul>
  			      <div class="">
    			    <a href="#" class="card-link text-white d-block py-2 bg-warning" style="border-bottom-right-radius: 12px;border-bottom-left-radius: 12px;font-weight: 600;">View Lists</a>
  			      </div>
			    </div>
			     -->
			</div>
			
		</div>
		
		<div class="row m-t-20">
		    <div class="col-md-6">
		        <a href="addlocation.php" class="btn btn-success">Add Preferred Job Locations</a>
		        <a href="addrole.php" class="btn btn-success">Add Preferred Role</a>
		        <a href="add-city.php" class="btn btn-success">Add Current City</a>
		    </div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>