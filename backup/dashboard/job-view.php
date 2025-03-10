<?php
include 'headers.php';
include('../classes/posts.php');
include 'top-nav.php';
include 'navigation.php';
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-12 py-4">
				
			 <div class="rounded p-4">
			   
			   <h2 class="mb-4">View Job Details</h2>  
			   
<?php

     $joblisting = new posts($conn);
     $joblists = $joblisting ->joblist();
     
     $ok = "notok";
     
     foreach ($joblists as $joblist) { 
     
     if($joblist['sno'] == $_GET['postid']) {
     
     ?>
         
            
			   
       <div class="card mb-3 border border-light">
      
  <div class="card-body pt-1">
      
    <div class="row mb-4 mt-0 bg-light p-3">
        
        <div class="col-md-4 text-muted"><span class="d-block pt-2">Posted On : <strong><?php echo $joblist['post_date']; ?></strong></span></div>
        <div class="col-md-4 text-muted"><span class="d-block pt-2">Openings : <strong><?php echo $joblist['openings']; ?></strong></span></div>
        <div class="col-md-4 text-muted text-right"><a href="job-list.php" class="btn btn-primary mr-2"><i class="fas fa-long-arrow-alt-left mr-2"></i> Back to List</a></div>
        
    </div>  
      
    <h5 class="card-title"><?php echo $joblist['job_title']; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $joblist['role']; ?></h6>
    
    <div class="d-block mt-1 mb-3">
        <div class="text-muted"><i class="fas fa-briefcase text-muted mr-2"></i> <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></div>
        <div class="mt-2 text-muted"><i class="fas fa-coins text-muted mr-2"></i> <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></div>
        <div class="mt-2 text-muted"><i class="fas fa-map-marker-alt text-muted mr-2"></i> <?php echo $joblist['location']; ?></div>
    </div>
    
    <h5 class="mt-4">Job description</h5>
    <p class="card-text"><i class="far fa-file-alt text-muted mr-2"></i> <?php echo $joblist['job_description']; ?></p>
    
    <h5 class="mt-4">Job details</h5>
    <div class="d-block mt-1 mb-3">
        <div class=""><span class="fw-light text-muted pr-4 d-inline-block" style="width: 150px;">Role</span> <?php echo $joblist['role']; ?></div>
        <div class="mt-2 "><span class="fw-light text-muted pr-4 d-inline-block" style="width: 150px;">Industry Type</span> <?php echo $joblist['industry_type']; ?></div>
        <div class="mt-2 "><span class="fw-light text-muted pr-4 d-inline-block" style="width: 150px;">Functional Area</span> <?php echo $joblist['function_area']; ?></div>
        <div class="mt-2 "><span class="fw-light text-muted pr-4 d-inline-block" style="width: 150px;">Employment Type</span> <?php echo $joblist['emp_type']; ?></div>
        <div class="mt-2 "><span class="fw-light text-muted pr-4 d-inline-block" style="width: 150px;">Role Category</span> <?php echo $joblist['role_category']; ?></div>
    </div>
    
    <h5 class="mt-4">Job requirement</h5>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="card-link text-muted mx-0"><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?></a>
            <a href="#" class="card-link text-muted d-block mx-0 mt-2"><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?></a>
        </div>
        <div class="col-md-6 text-end" style="text-align: right;">
            <a href="job-applicants.php?applicantid=<?php echo $joblist['sno']; ?>&jobtitle=<?php echo $joblist['job_title'] . "&expmin=" . $joblist['exper_min'] . "&expmax=" . $joblist['exper_max'] . "&salmin=" . $joblist['salary_min'] . "&salmax=" . $joblist['salary_max']; ?>" class="btn btn-success mt-2"><i class="fas fa-arrow-right"></i> View Applicants</a>
        </div>
    </div>

   </div>
  
</div>


<?php } }  ?>

  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	


  

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>