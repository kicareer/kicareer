<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include('../classes/posts.php');
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4">Job Post Form</h2>
			 
			 <div class="border rounded p-4">

			  
			   <div class="post_form">
			    
			    <div class="mb-3">
   				 <label class="form-label">Job Title</label>
    				<input type="text" class="form-control" id="job_title">
    				<div class="form-text"></div>
  				</div>
  				
  				 <div class="mb-3">
   				 <label class="form-label">Job Description</label>
    				<textarea class="form-control" id="job_description"></textarea>
    				<div class="form-text"></div>
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
   				      </div>
   				      <div class="exp">
   				         <label class="form-label text-muted d-block"><small>Max</small></label>
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
   				          
   				            </div>
   				         </div>
    				    <div class="form-text"></div>
  				     </div>
  				
  				    </div>
  				    
  				    <div class="col-md-8">
  				        
  				        <div class="mb-3">
   				 <label class="form-label">Job Salary</label>
   				 
   				 <div class="d-flex">
   				     <div class="exp mr-4">
   				         <label class="form-label text-muted d-block"><small>Min</small></label>
   				           <input type="text" class="form-control" id="salary_min">
   				      </div>
   				      <div class="exp">
   				         <label class="form-label text-muted d-block"><small>Max</small></label>
   				           <input type="text" class="form-control" id="salary_max">
   				      </div>
   				     
   				 </div>
   				 <div class="form-text"></div>
   				 
  				</div>
  				
  				
  				    </div>
  				    
  				</div>
  				
  				
  				<div class="mb-3">
    				<label class="form-label d-block">Preferred Job Location</label>
    			 <select class="form-control" id="job_location" multiple>
              <option value="">--SELECT--</option>
   				      <?php 
                  $locationlisting = new posts($conn);
                  $locationlist = $locationlisting ->locationlist();
              
                  foreach($locationlist as $location) { 
                      echo "<option value='" . $location['name'] . "'>" . $location['name'] . "</option>";
                  $i++; } 
                ?>
            </select>
                           
    				<div class="form-text"></div>
  				</div>
  				
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Job Details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label d-block">Role Category</label>
    				<!-- <input type="text" class="form-control" id="role"> -->
    				<select class="form-control" id="role_category">
              <option value="">--SELECT--</option>
   				              <?php 
            
                $rolelisting = new posts($conn);
                $rolelist = $rolelisting ->rolelist();
            
                foreach($rolelist as $role) { 
                    echo "<option value='" . $role['name'] . "'>" . $role['name'] . "</option>";
                $i++; } 
                ?>
                           </select>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Openings</label>
    				<input type="number" class="form-control" id="openings">
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Industry type</label>
    				<input type="text" class="form-control" id="industry_type" readonly="" value="Automotive">
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Functional area</label>
    				<input type="text" class="form-control" id="function_area">
    				<div class="form-text"></div>
  				</div>
  				
  				
  				<div class="mb-3">
    				<label class="form-label">Employment Type</label>
            <select required=""  class="form-control" id="emp_type">
              <option value="">--SELECT--</option>
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Contractual">Contractual</option>
            </select>
    				<!-- <input type="text" class="form-control" id="emp_type"> -->
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Role</label>
    				<input type="text" class="form-control" id="role">
    				<div class="form-text"></div>
  				</div>
  				
  				
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Education & Other Details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Education</label>
    				<input type="text" class="form-control" id="education">
    				<div class="form-text text-muted">Ex. B.Tech/B.E, Bsc ( Each Qualification seperate by "," ) </div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Key Skills</label>
    				<input type="text" class="form-control" id="skills">
    				<div class="form-text text-muted">Ex. Java, Sql ( Each Skills seperate by "," ) </div>
  				</div>
  				
  				<div class="btn btn-primary post px-4">Submit</div>
  			  
  			  </div>	
  			  
  			   <div class="response"></div>
  				
            </div>
				
				
			</div>
		</div>
	</div>

	
	<div id="response"></div>

<script>
$(document).ready(function(){
    
    
  $(".post").click(function(){
      
  job_title = $("#job_title").val();
  job_description = $("#job_description").val();
  exper_min = $("#exper_min").val();
  exper_max = $("#exper_max").val();
  salary_min = $("#salary_min").val();
  salary_max = $("#salary_max").val();
  locations = $("#job_location").val();
    role = $("#role").val();
  openings = $("#openings").val();
  industry_type = $("#industry_type").val();
  function_area = $("#function_area").val();
  emp_type = $("#emp_type").val();
  role_category = $("#role_category").val();
  education = $("#education").val();
  skills = $("#skills").val(); 
  
  alert(locations)

       
     $.ajax({
                  url:'product-action.php',
                  method:'POST',
                  datatype:'json',
                  data:{
                    action : 'addpost',
                    job_title : job_title, 
                    job_description : job_description,
                    exper_min : exper_min,
                    exper_max : exper_max, 
                    salary_min : salary_min, 
                    salary_max : salary_max,
                    joblocation : locations,
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
                  $('div#response').html(html);
                  $(".post_form").fadeOut();
                  $('.post_form').delay(3000).fadeIn();
                  $('.response').fadeIn();
                  $('.response').html("<div class='alert alert-success px-4 py-3'>Successfully Submitted Form</div>");
                  $('.response').delay(3000).fadeOut();
                }
             }) 

  });
  
});
</script>
	
	
	

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>