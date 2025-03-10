<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include('classes/posts.php');

$postid = $_GET['postid'];
$jobtitle = $_GET['jobtitle'];

?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 <div class="border rounded p-4" id="application_from">
			   
			   <h2 class="mb-4">Job Application</h2> 
			   
			   <h4 class="text-muted mb-4"><small>Applying for - </small><span class="fw-bolder"><?php echo $jobtitle; ?></span></h4>
			   
			   <form action="" method="POST"  enctype="multipart/form-data" id="application_from"> 
			   
			   <input type="hidden" value="<?php echo $postid; ?>" name="jobid" />
			    
			    <div class="mb-3">
   				 <label class="form-label">Email address <span class="text-danger">*</span></label>
    				<input type="email" class="form-control" name="email" required>
    				<div class="form-text">We'll never share your email with anyone else.</div>
  				</div>
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i> Personal Details</h5>
  				</div>
			    
			    <div class="mb-3">
   				 <label class="form-label">Application Name <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" name="name" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
   				 <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" name="phone" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Current City <span class="text-danger">*</span></label>
    			<!--	<input type="text" class="form-control" id="residence" name="residence" required>  -->
    				 <select class="form-control" id="residence" name="residence" required>
              <option value="">--SELECT--</option>
              <option value="ABBOTABAD">ABBOTABAD</option>
              <option value="AHMEDPUR EAST">AHMEDPUR EAST</option>
              <option value="ARIF WALA">ARIF WALA</option>
              <option value="ATTOCK">ATTOCK</option>
              <option value="BADIN">BADIN</option>
              <option value="BAHAWALNAGAR">BAHAWALNAGAR</option>
              <option value="BAHAWALPUR">BAHAWALPUR</option>
              <option value="BHAKKAR">BHAKKAR</option>
              <option value="BHALWAL">BHALWAL</option>
              <option value="BUREWALA">BUREWALA</option>
              <option value="CHAKWAL">CHAKWAL</option>
              <option value="CHAMAN">CHAMAN</option>
              <option value="CHARSADDA">CHARSADDA</option>
              <option value="CHINIOT">CHINIOT</option>
              <option value="CHISHTIAN">CHISHTIAN</option>
              <option value="DADU">DADU</option>
              <option value="DAHARKI">DAHARKI</option>
              <option value="DASKA">DASKA</option>
              <option value="DERA GHAZI KHAN">DERA GHAZI KHAN</option>
              <option value="DERA ISMAIL KHAN">DERA ISMAIL KHAN</option>
              <option value="FAISALABAD">FAISALABAD</option>
              <option value="FEROZWALA">FEROZWALA</option>
              <option value="GHOTKI">GHOTKI</option>
              <option value="GOJRA">GOJRA</option>
              <option value="GUJRANWALA">GUJRANWALA</option>
              <option value="GUJRAT">GUJRAT</option>
              <option value="HAFIZABAD">HAFIZABAD</option>
              <option value="HARIPUR">HARIPUR</option>
              <option value="HAROONABAD">HAROONABAD</option>
              <option value="HASILPUR">HASILPUR</option>
              <option value="HYDERABAD">HYDERABAD</option>
              <option value="ISLAMABAD">ISLAMABAD</option>
              <option value="JACOBABAD">JACOBABAD</option>
              <option value="JARANWALA">JARANWALA</option>
              <option value="JATOI">JATOI</option>
              <option value="JHANG">JHANG</option>
              <option value="JHELUM">JHELUM</option>
              <option value="KABAL">KABAL</option>
              <option value="KAMALIA">KAMALIA</option>
              <option value="KAMBER ALI KHAN">KAMBER ALI KHAN</option>
              <option value="KAMOKE">KAMOKE</option>
              <option value="KANDHKOT">KANDHKOT</option>
              <option value="KARACHI">KARACHI</option>
              <option value="KASUR">KASUR</option>
              <option value="KHAIRPUR">KHAIRPUR</option>
              <option value="KHANEWAL">KHANEWAL</option>
              <option value="KHANPUR">KHANPUR</option>
              <option value="KHUSHAB">KHUSHAB</option>
              <option value="KHUZDAR">KHUZDAR</option>
              <option value="KOHAT">KOHAT</option>
              <option value="KOT ABDUL MALIK">KOT ABDUL MALIK</option>
              <option value="KOT ADDU">KOT ADDU</option>
              <option value="KOTRI">KOTRI</option>
              <option value="KUNDIAN">KUNDIAN</option>
              <option value="LAHORE">LAHORE</option>
              <option value="LARKANA">LARKANA</option>
              <option value="LAYYAH">LAYYAH</option>
              <option value="LODHRAN">LODHRAN</option>
              <option value="MANDI BAHAUDDIN">MANDI BAHAUDDIN</option>
              <option value="MANSEHRA">MANSEHRA</option>
              <option value="MARDAN">MARDAN</option>
              <option value="MIANWALI">MIANWALI</option>
              <option value="MINGORA">MINGORA</option>
              <option value="MIRPUR AJK">MIRPUR AJK</option>
              <option value="MIRPUR KHAS">MIRPUR KHAS</option>
              <option value="MIRPUR MATHELO">MIRPUR MATHELO</option>
              <option value="MULTAN">MULTAN</option>
              <option value="MURIDKE">MURIDKE</option>
              <option value="MUZAFFARABAD">MUZAFFARABAD</option>
              <option value="MUZAFFARGARH">MUZAFFARGARH</option>
              <option value="NAROWAL">NAROWAL</option>
              <option value="NAWABSHAH">NAWABSHAH</option>
              <option value="NOWSHERA">NOWSHERA</option>
              <option value="OKARA">OKARA</option>
              <option value="PAKPATTAN">PAKPATTAN</option>
              <option value="PESHAWAR">PESHAWAR</option>
              <option value="QUETTA">QUETTA</option>
              <option value="RAHIM YAR KHAN">RAHIM YAR KHAN</option>
              <option value="RAWALPINDI">RAWALPINDI</option>
              <option value="SADIQABAD">SADIQABAD</option>
              <option value="SAHIWAL">SAHIWAL</option>
              <option value="SAMBRIAL">SAMBRIAL</option>
              <option value="SAMUNDRI">SAMUNDRI</option>
              <option value="SARGODHA">SARGODHA</option>
              <option value="SHAHDADKOT">SHAHDADKOT</option>
              <option value="SHEIKHUPURA">SHEIKHUPURA</option>
              <option value="SHIKARPUR">SHIKARPUR</option>
              <option value="SIALKOT">SIALKOT</option>
              <option value="SUKKUR">SUKKUR</option>
              <option value="SWABI">SWABI</option>
              <option value="TANDO ADAM">TANDO ADAM</option>
              <option value="TANDO ALLAHYAR">TANDO ALLAHYAR</option>
              <option value="TANDO MUHAMMAD KHAN">TANDO MUHAMMAD KHAN</option>
              <option value="TAXILA">TAXILA</option>
              <option value="TURBAT">TURBAT</option>
              <option value="UMERKOT">UMERKOT</option>
              <option value="VEHARI">VEHARI</option>
              <option value="WAH CANTONMENT">WAH CANTONMENT</option>
              <option value="WAZIRABAD">WAZIRABAD</option>
            </select>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Date Of Birth <span class="text-danger">*</span></label>
    				<input type="date" class="form-control" id="dob" name="dob" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Attach Picture</label>
    				<input type="file" class="form-control" id="profile_image" name="profile_image" >
    				<div class="form-text text-muted">Upload Profile file size should be less than 1MB</div> 
  				</div>
  				
  				
  				
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Current Employement details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Current Employer <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" id="current_emp" name="current_emp" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Current Salary <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" id="current_sal" name="current_sal" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Total Years Of Experience <span class="text-danger">*</span></label>
            <select class="form-control"  id="experience" name="experience" required>
              <option value="">Select</option>
              <option value="0">0</option>
              <option value="1">1 Year</option>
              <option value="2">2 Years</option>
              <option value="3">3 Years</option>
              <option value="4">4 Years</option>
              <option value="5">5 Years</option>
              <option value="6">6 Years</option>
              <option value="7">7 Years</option>
              <option value="8">8 Years</option>
              <option value="9">9 Years</option>
              <option value="10">10 Years</option>
              <option value="10+">10+ Years</option>
            </select>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mt-5 mb-4">
  				    <h5 class="text-muted"><i class="fas fa-chevron-right mr-3"></i>Other Details</h5>
  				</div>
  				
  				<div class="mb-3">
    				<!-- <label class="form-label">Position Applying <span class="text-danger">*</span></label> -->
    				<input type="hidden" class="form-control" id="apply_position" name="apply_position" value="-" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label d-block">Preferred Job Location  <span class="text-danger">*</span></label>
    				<!-- <input type="text" class="form-control" id="job_city" name="job_city" required> -->

           <select class="form-select form-select-lg mb-3 px-3 py-2 rounded border-0 bg-light job_location" id="job_city">
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
  				
  				<div class="mb-3">
    				<label class="form-label">Notice Period <span class="text-danger">*</span></label>
    				<input type="text" class="form-control" id="notice_period" name="notice_period" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="mb-3">
    				<label class="form-label">Uploaded Your Resume In DOC/PDF Formats Only <span class="text-danger">*</span></label>
    				<input type="file" class="form-control" id="resume" name="resume" required>
    				<div class="form-text text-muted">Upload Resume file size should be less than 1MB</div>
  				</div>
  				
  				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
  				
  			  </form>	
  			  
  			  <div class="response"></div>
  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	
<?php

 include('classes/posts.php'); 

  if(isset($_POST['submit'])) {
      
      $jobid = $_POST['jobid'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $residence = $_POST['residence'];
      $dob = $_POST['dob'];
      $profile_image = $_POST['profile_image'];
      $current_emp = $_POST['current_emp'];
      $current_sal = $_POST['current_sal'];
      $experience = $_POST['experience'];
      $apply_position = $_POST['apply_position'];
      $job_city = $_POST['job_city'];
      $notice_period = $_POST['notice_period'];

      
      
      // FILE UPLOAD 
      
        
        // Profile Picture
        
       
       if ($_FILES["profile_image"]["size"] < 1000000 || $_FILES["profile_image"]["resume"] < 1000000) {
        
         $file_name = $_FILES['profile_image']['name'];
         $allowed_types = array('jpg', 'png');
         $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
          
          if(in_array(strtolower($file_ext), $allowed_types)) {
              
          $temp = explode(".", $file_name);
          $time = round(microtime(true)) ;
          $profile_image = $time . '.' . end($temp);
          move_uploaded_file($_FILES['profile_image']['tmp_name'], 'uploads/profile/' . $profile_image);

         }
      
        
        // resume
         
         $file_names = $_FILES['resume']['name'];
         $allowed_types = array('pdf', 'doc', 'docx');
         $file_exts = pathinfo($file_names, PATHINFO_EXTENSION);
          
          if(in_array(strtolower($file_exts), $allowed_types)) {
              
          $temps = explode(".", $file_names);
          $times = round(microtime(true)) ;
          $resume = $times . '.' . end($temps);
          move_uploaded_file($_FILES['resume']['tmp_name'], 'uploads/' . $resume);

        }  
      
      
         $addpost = new posts($conn);
         $add_post = $addpost->application_insert($jobid, $name, $email, $phone, $residence, $dob, $profile_image, $current_emp, $current_sal, $experience, $apply_position, $job_city, $notice_period, $resume);  
         
         $notice_message = "<div class='alert alert-success px-4 py-3'><i class='fas fa-check-circle'></i> Your application has been successfully submitted. Thank You.</div>";
           
       } else {
           
           $notice_message = "<div class='alert alert-danger px-4 py-3'>Upload Profile and Resume file size should be less than 1MB</div>";
           
       }
       
       
       $notice_message = "<div class='alert alert-success px-4 py-3'><i class='fas fa-check-circle'></i> Your application has been successfully submitted. Thank You.</div>";
       
       
          ?>
          


<?php } ?>

<script>
  
   $(document).ready(function(){
       
    $('#application_from').hide();

   
      });

</script>
  

	<script type="text/javascript" src="js/bootstrap.js "></script>
</body>
</html>