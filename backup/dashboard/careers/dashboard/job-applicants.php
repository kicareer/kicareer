<?php
include 'headers.php';
include('../classes/posts.php');
include 'top-nav.php';
include 'navigation.php';

$jobtitle = $_GET['jobtitle'];
 ?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-12 py-4">
				
			 <div class="rounded p-4">
			   
			   <div class="row">
			       <div class="col-md-8"><h2 class="mb-4">Applicant List - <span class="h4"><?php echo $jobtitle; ?></span></h2> </div>
			       <div class="col-md-4 text-end text-right">
			            <a href="job-list.php" class="btn btn-primary">Back to List</a> 
			       </div>
			   </div>
			    
			   
			   
			   <table class="table border table-striped table-hover">
      <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">date</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">experience</th>
      <th scope="col">postion</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
			   
<?php

     $applicantlisting = new posts($conn);
     $applicantlists = $applicantlisting ->applicantslist();
     
     $i = 1;
     
     $ok = "notok";
     
     $applicantid = $_GET['applicantid'];
     $expmin = $_GET['expmin'];
     $expmax = $_GET['expmax'];
     $salmin = $_GET['salmin'];
     $salmax = $_GET['salmax'];
     
     echo "Min Salary : " . $salmax  . ", Min Experience : " . $expmin ;
     
     foreach ($applicantlists as $applicants) { 
         
        if($applicants['jobid'] == $applicantid && $applicants['current_sal'] < $salmax && $applicants['experience'] > $expmin) {
            
            $ok = "ok";
     
     ?>
         
         <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $applicants['apply_date']; ?></td>
            <td><?php echo $applicants['name']; ?></td>
            <td><?php echo $applicants['email']; ?></td>
            <td><?php echo $applicants['experience']; ?></td>
            <td><?php echo $applicants['apply_position']; ?></td>
            <td><a href="applicant-view.php?postid=<?php echo $applicants['sno']; ?>" class="btn btn-success">View</a></td>
        </tr> 


<?php $i++; } }  

   if($ok == "notok") {
       
       echo "<tr><td colspan='7' class='text-center'> No Applicants</td></tr>";
   
   }  ?>


  </tbody>

  </table>

  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	


  

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>