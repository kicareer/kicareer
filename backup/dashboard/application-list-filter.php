<?php
include('../classes/posts.php');
?>


			   
	<table id="examples" class="table border table-striped table-hover">
      <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">date</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">experience</th>
      <th scope="col">postion</th>
      <th scope="col" class="resume">Resume</th>
      <th scope="col" class="resume">Profile Pic</th>
      <th scope="col" class="resumes">Residence</th>
      <th scope="col" class="resumes">Dob</th>
      <th scope="col" class="resumes">Current Employe</th>
      <th scope="col" class="resumes">Current Salary</th>
    <!--  <th scope="col" class="resumes">Experience</th> -->
      <th scope="col" class="resumes">Job City</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
			   
<?php
  
   if(!empty($_POST['experience'])) {

     $experience = $_POST['experience'];
     $apply_position = $_POST['position'];
     $residence = $_POST['resident'];
     $current_emp = $_POST['current_employee'];
     $current_sal = $_POST['current_salary'];
     $job_city = $_POST['current_job_city'];

     $applicantlisting = new posts($conn);
     $applicantlists = $applicantlisting ->applicants_filter_list($experience, $apply_position, $residence, $current_emp, $current_sal, $job_city);
     
     $i = 1;
     
     foreach ($applicantlists as $applicants) { ?>
         
         <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $applicants['apply_date']; ?></td>
            <td><?php echo $applicants['name']; ?></td>
            <td><?php echo $applicants['email']; ?></td>
            <td><?php echo $applicants['experience']; ?></td>
            <td><?php echo $applicants['apply_position']; ?></td>
            <td class="resume"><a href="../uploads/<?php echo $applicants['resume']; ?>" target="blank">https://kenz-plus.com/changan/uploads/<?php echo $applicants['resume']; ?></a></td>
            <td class="resume"><a href="../uploads/profile/<?php echo $applicants['profile_image']; ?>" target="blank">https://kenz-plus.com/changan/uploads/<?php echo $applicants['profile_image']; ?></a></td>
            <td class="resumes"><?php echo $applicants['residence']; ?></td>
            <td class="resumes"><?php echo $applicants['dob']; ?></td>
            <td class="resumes"><?php echo $applicants['current_emp']; ?></td>
            <td class="resumes"><?php echo $applicants['current_sal']; ?></td>
        <!--    <td class="resumes"><?php /** echo $applicants['experience']; **/ ?></td>  -->
            <td class="resumes"><?php echo $applicants['job_city']; ?></td>
            <td><a href="applicant-view.php?postid=<?php echo $applicants['sno']; ?>" class="btn btn-success">View</a></td>
        </tr> 


<?php $i++; } } ?>


  </tbody>

  </table>
  

	
