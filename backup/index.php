<?php
include 'headers.php';
include('classes/posts.php');
include 'top-nav.php';
include 'navigation.php';
 ?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-4">
				
			 <div class="rounded px-0 p-md-4">
			   
			   <!-- <h2 class="mb-4">Current Openings </h2>   -->
			   
<?php

     $joblisting = new posts($conn);
     $joblists = $joblisting ->joblist();
     
     $ok = "notok";
     
     foreach ($joblists as $joblist) { 
         
         if($joblist['status'] == "" || $joblist['status'] == "active") {
     
     ?>
         

			   
			   <div class="card mb-3 shadow">
  <div class="card-body">
    <h5 class="card-title"><?php echo $joblist['job_title']; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $joblist['role']; ?></h6>
    
    <div class="d-flex mt-1 mb-3">
        <div class="mr-4 text-muted"><i class="fas fa-briefcase text-muted mr-2"></i> <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></div>
        <div class="mr-4 text-muted"><i class="fas fa-coins text-muted mr-2"></i> <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></div>
        <div class="mr-4 text-muted"><i class="fas fa-map-marker-alt text-muted mr-2"></i> <?php echo $joblist['location']; ?></div>
    </div>
    
    <p class="card-text two-lines"><i class="far fa-file-alt text-muted mr-2"></i> <?php echo $joblist['job_description']; ?></p>
    
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="card-link text-muted mx-0"><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?></a>
            <a href="#" class="card-link text-muted d-block mx-0 mt-2"><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?></a>
        </div>
        <div class="col-md-6 text-center text-md-right px-0 py-3 py-md-0" style="text-align: right;">
            <a href="job-view.php?postid=<?php echo $joblist['sno']; ?> " class="btn btn-primary mt-2"><i class="fas fa-eye"></i></i> View Details</a>
            <a href="application.php?postid=<?php echo $joblist['sno']; ?>&jobtitle=<?php echo $joblist['job_title']; ?>&rolecategory=<?php echo $joblist['role_category']; ?>" class="btn btn-success mt-2 ml-2"><i class="fas fa-arrow-right"></i> Apply Now</a>
        </div>
    </div>
    
    
  </div>
</div>


<?php } }  ?>

  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	


  

	<script type="text/javascript" src="js/bootstrap.js "></script>
</body>
</html>