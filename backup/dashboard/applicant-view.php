<?php
include 'headers.php';
include('../classes/posts.php');
?>

<?php
	include 'top-nav.php';
?>
<div class="container-fluid">
	<?php
		include 'navigation.php';
	?>
</div>
	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-12 py-4">
			    
			    
			 <div class="row">
			       <div class="col-md-6"><h2 class="mb-4">Applicant View</h2> </div>
			       <div class="col-md-6 text-end text-right">
			           <!-- <a href="Job-post-form.php" class="btn btn-primary">Post New Job</a> -->
			       </div>
			   </div>   
				
			 <div class="border rounded p-4">
			   
			   
			   
			   
<?php

$postid = $_GET['postid'];

     $$applicantlisting = new posts($conn);
     $$applicantlists = $$applicantlisting ->applicantslist();
     
     $i = 1;
     
     foreach ($$applicantlists as $applicants) { 
     
       if($applicants['sno'] == $postid) { ?>
     
     <div class="row">
         
         <div class="col-md-8">
              <div class="block">
                  
                 <h5 class="my-3">Applicant Job Details</h5>
                 <div class="mb-2"><span class="title">Applied for Position: </span> <?php echo $applicants['apply_position']; ?></div>
                 <div class="mb-2"><span class="title">Curren Employe : </span> <?php echo $applicants['current_emp']; ?></div>
                 <div class="mb-2"><span class="title">Current Salary : </span> <?php echo $applicants['current_sal']; ?></div>
                 <div class="mb-2"><span class="title">Experience : </span> <?php echo $applicants['experience']; ?></div>
                 <div class="mb-2"><span class="title">Job City : </span> <?php echo $applicants['job_city']; ?></div>
                 <div class="mb-2"><span class="title">Resume : </span> <a href="../uploads/<?php echo $applicants['resume']; ?>" download="" target="blank">View Resume</a></div>
                 <div class="mb-2"><span class="title">Kenz Resume : </span> <a href="../uploads/<?php echo $applicants['kenz_resume']; ?>" download="" target="blank">View Resume</a></div>
                 
                 
                 <h5 class="my-4">Applicant Personal Details</h5>
                 <div class="mb-2"><span class="title">Name : </span> <?php echo $applicants['name']; ?></div>
                 <div class="mb-2"><span class="title">Email : </span> <?php echo $applicants['email']; ?></div>
                 <div class="mb-2"><span class="title">Phone : </span> <?php echo $applicants['phone']; ?></div>
                 <div class="mb-2"><span class="title">Residence : </span> <?php echo $applicants['residence']; ?></div>
                 <div class="mb-2"><span class="title">Dob : </span> <?php echo $applicants['dob']; ?></div>
                 
               </div>
             
         </div>
         <div class="col-md-4">
             
             <h5>Profile Image</h5>
             <img src="../uploads/profile/<?php echo $applicants['profile_image']; ?>" style="width:100%" class="border"; />
             <hr>
             <a href="upload-kenz-resume.php?postid=<?=$_GET['postid']?>" class="btn btn-sm btn-primary">Add Kenz Resume <i class="fas fa-external-link-alt"></i></a>
             
         </div>
         
     </div>
     
    
         



<?php  } }  ?>



  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	


  

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>