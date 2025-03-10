<?php
include 'headers.php';
include('../classes/posts.php');
include 'top-nav.php';
include 'navigation.php';
if(isset($_GET['success'])){
	echo '<script>alert("Data saves successfully.")</script>';
}
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-10 py-5">
				
			 <div class="rounded p-0">
			   
			   <h2 class="mb-4">Edit Job Details</h2>  
			   
<?php

     $joblisting = new posts($conn);
     $joblists = $joblisting ->joblist();
     
     $ok = "notok";
     
     foreach ($joblists as $joblist) { 
     
     if($joblist['sno'] == $_GET['postid']) {
     
     ?>
     
     <input type="hidden" value="<?php echo $joblist['sno']; ?>" id="postid" />
         
    <div class="rounded border p-2 p-md-4">        
			   
      <div class="post_form">
			    
			    <div class="mb-3">
   				 <label class="form-label">Job Title</label>
    				<input type="text" class="form-control" id="job_title" value="<?php echo $joblist['job_title']; ?>">
    				<div class="form-text"></div>
  				</div>
  				
  				 <div class="mb-3">
   				 <label class="form-label">Job Description</label>
   				    <input type="hidden" id="job_description_old"  value="<?php echo $joblist['job_description']; ?>" />
    				<textarea class="form-control" id="job_description" style="height: 200px;"><?php echo $joblist['job_description']; ?></textarea>
  				</div>
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Job Requirement</h5>
  				</div>
  				
  				
  				<div class="row">
  				    
  				    <div class="col-md-4">
  				        <div class="mb-3">
   				 <label class="form-label">Experience</label>
   				 
   				 <div class="d-flex">
   				     <div class="exp mr-4">
   				         <label class="form-label text-muted d-block"><small>Min</small></label>
   				         <input type="hidden" id="exper_min_old"  value="<?php echo $joblist['exper_min']; ?>" />
   				           <select class="form-select form-select-lg mb-3 px-2 py-2 rounded border-0 bg-light d-block exper-min" id="exper_min">
   				             <option value="0">0</option>
     				         <option value="1 Year">1 Year</option>
     				         <option value="2 Years">2 Years</option>
     				         <option value="3 Years">3 Years</option>
     				         <option value="4 Years">4 Years</option>
     				         <option value="5 Years">5 Years</option>
     				         <option value="6 Years">6 Years</option>
     				         <option value="7 Years">7 Years</option>
     				         <option value="8 Years">8 Years</option>
     				         <option value="9 Years">9 Years</option>
     				         <option value="10 Years">10+ Years</option>
                           </select>
                           <div class="form-text"><?php echo $joblist['exper_min']; ?></div>
   				      </div>
   				      <div class="exp">
   				         <label class="form-label text-muted d-block"><small>Max</small></label>
   				         <input type="hidden" id="exper_max_old"  value="<?php echo $joblist['exper_max']; ?>" />
   				            <select class="form-select form-select-lg mb-3 px-2 py-2 rounded border-0 bg-light exper-max" id="exper_max">
   				             <option value="0">0</option>
                       <option value="1 Year">1 Year</option>
                       <option value="2 Years">2 Years</option>
                       <option value="3 Years">3 Years</option>
                       <option value="4 Years">4 Years</option>
                       <option value="5 Years">5 Years</option>
                       <option value="6 Years">6 Years</option>
                       <option value="7 Years">7 Years</option>
                       <option value="8 Years">8 Years</option>
                       <option value="9 Years">9 Years</option>
                       <option value="10 Years">10+ Years</option>
                      </select>
   				          <div class="form-text"><?php echo $joblist['exper_max']; ?></div>
   				            </div>
   				         </div>
    				    
  				     </div>
  				
  				    </div>
  				    
  				    <div class="col-md-8">
  				        
  				        <div class="mb-3">
   				 <label class="form-label">Job Salary</label>
   				 
   				 <div class="d-flex">
   				     <div class="exp mr-4">
   				         <label class="form-label text-muted d-block"><small>Min</small></label>
   				           <input type="text" class="form-control" id="salary_min" value="<?php echo $joblist['salary_min']; ?>">
   				      </div>
   				      <div class="exp">
   				         <label class="form-label text-muted d-block"><small>Max</small></label>
   				           <input type="text" class="form-control" id="salary_max" value="<?php echo $joblist['salary_max']; ?>">
   				      </div>
   				     
   				 </div>
   				 <div class="form-text"></div>
   				 
  				</div>
  				
  				
  				    </div>
  				    
  				</div>
  				
  				
  				<div class="mb-3">
    				<label class="form-label d-block">Preferred Job Location</label>
    			 <!--	<input type="text" class="form-control" id="job_location">  -->
    			 <input type="hidden" id="job_location_old"  value="<?php echo $joblist['location']; ?>" />
    			 <select class="form-select form-select-lg mb-3 px-3 py-2 rounded border-0 bg-light job_location" id="job_location" multiple>
              <option value="">--SELECT--</option>
   				      <?php 
                  $locationlisting = new posts($conn);
                  $locationlist = $locationlisting ->locationlist();
              
                  foreach($locationlist as $location) { 
                      echo "<option value='" . $location['name'] . "'>" . $location['name'] . "</option>";
                  $i++; } 
                ?>
            </select>
                           
    				<div class="form-text"><?php echo $joblist['location']; ?></div>
  				</div>
  				
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Job Details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label d-block">Role</label>
    				<!-- <input type="text" class="form-control" id="role"> -->
    				 <input type="hidden" id="role_old"  value="<?php echo $joblist['role']; ?>" />
    				<select class="form-select form-select-lg mb-3 px-3 py-2 rounded border-0 bg-light role" id="role">
              <option value="">--SELECT--</option>
   				              <?php 
            
                $rolelisting = new posts($conn);
                $rolelist = $rolelisting ->rolelist();
            
                foreach($rolelist as $role) { 
                    echo "<option value='" . $role['name'] . "'>" . $role['name'] . "</option>";
                $i++; } 
                ?>
                           </select>
    				<div class="form-text"><?php echo $joblist['role']; ?></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Openings</label>
    				<input type="number" class="form-control" id="openings"  value="<?php echo $joblist['openings']; ?>">
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Industry type</label>
    				<input type="text" class="form-control" id="industry_type"  value="Automotive">
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Functional area</label>
    				<input type="text" class="form-control" id="function_area" value="<?php echo $joblist['function_area']; ?>">
    				<div class="form-text"></div>
  				</div>
  				
  				
  				<div class="mb-3">
    				<label class="form-label">Employment Type</label>
    				<input type="hidden" id="emp_type_old"  value="<?php echo $joblist['emp_type']; ?>" />
            <select required=""  class="form-control" id="emp_type">
              <option value="">--SELECT--</option>
              <option value="Fulltime">Fulltime</option>
              <option value="Parttime">Parttime</option>
              <option value="Contract Basic">Contract Basic</option>
            </select>
    				<!-- <input type="text" class="form-control" id="emp_type"> -->
    				<div class="form-text"><?php echo $joblist['emp_type']; ?></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Role Category</label>
    				<input type="text" class="form-control" id="role_Category" value="<?php echo $joblist['role_category']; ?>">
    				<div class="form-text"><?php echo $joblist['role_category']; ?></div>
  				</div>
  				
  				
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Education & Other Details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Education</label>
    				<input type="text" class="form-control" id="education" value="<?php echo $joblist['education']; ?>">
    				<div class="form-text text-muted">Ex. B.Tech/B.E, Bsc ( Each Qualification seperate by "," ) </div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Key Skills</label>
    				<input type="text" class="form-control" id="skills" value="<?php echo $joblist['skills']; ?>">
    				<div class="form-text text-muted">Ex. Java, Sql ( Each Skills seperate by "," ) </div>
  				</div>
  				
  				<div class="btn btn-primary post px-4">Submit</div>
  			  
  			  </div>	
  			  
  	  <div class="response"></div>
  	  
  	</div>


<?php } }  ?>

  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	
<script>
$(document).ready(function(){
    
    
  $(".post").click(function(){
  
  id = $("#postid").val();    
  job_title = $("#job_title").val();
  
  
  job_description = $("#job_description").val();
  
  if(job_description == "") {
      
      job_description = $("#job_description_old").val();
  }
  
  exper_min = $("#exper_min").val();
  
  if(exper_min == "") {
      
      exper_min = $("#exper_min_old").val();
  }
  
  exper_max = $("#exper_max").val();
  
  if(exper_max == "") {
      
      exper_min = $("#exper_max_old").val();
  }
  
  
  salary_min = $("#salary_min").val();
  salary_max = $("#salary_max").val();
  locations = $("#job_location").val();
  
  if(locations == "") {
      
      locations = $("#job_location_old").val();
  }
  
  role = $("#role").val();
  
  if(role == "") {
      
      role = $("#role_old").val();
  }
  
  openings = $("#openings").val();
  industry_type = $("#industry_type").val();
  function_area = $("#function_area").val();
  emp_type = $("#emp_type").val();
  
  if(emp_type == "") {
      
      emp_type = $("#emp_type_old").val();
  }
  
  role_category = $("#role_category").val();
  education = $("#education").val();
  skills = $("#skills").val(); 
      
     $.ajax({
                  url:'product-action.php',
                  method:'POST',
                  datatype:'json',
                  data:{
                    action : 'updatepost',
                    id : id,
                    job_title : job_title, 
                    job_description : job_description,
                    exper_min : exper_min,
                    exper_max : exper_max, 
                    salary_min : salary_min, 
                    salary_max : salary_max,
                    location : locations,
                    role : role,
                    openings : openings, 
                    industry_type : industry_type, 
                    function_area : function_area,
                    emp_type : emp_type, 
                    role_category : role_category, 
                    education : education, 
                    skills : skills  
                },
          success:function(html){
            		window.location.href="?postid="+id+"&success";
                  //$('div#response').html(html);
                  //$(".post_form").fadeOut();
                  //$('.post_form').delay(3000).fadeIn();
                  //$('.response').fadeIn();
                  //$('.response').html("<div class='alert alert-success px-4 py-3'>Updated Post</div>");
                  //$('.response').delay(3000).fadeOut();
                }
             }) 

  });
  
});
</script>

  

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>