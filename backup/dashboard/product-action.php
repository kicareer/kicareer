<?php

 include('../classes/posts.php'); 
 
 
 // Select 
   
 
 /**
     $cartitems = new posts($conn);
     $items = $cartitems ->joblist();
     
     $ok = "notok";
     
     foreach ($items as $item) {
         
     }
  **/


// Insert 


  if($_POST['action'] == "addpost") {
      
      $job_title = $_POST['job_title']; 
      $job_description = $_POST['job_description']; 
      $exper_min = $_POST['exper_min']; 
      $exper_max = $_POST['exper_max']; 
      $salary_min = $_POST['salary_min']; 
      $salary_max = $_POST['salary_max']; 
      $location = $_POST['joblocation']; 
      
      $joblocation = str_replace(","," - ",$location);
      
      $role = $_POST['role']; 
      $openings = $_POST['openings']; 
      $industry_type = $_POST['industry_type']; 
      $function_area = $_POST['function_area']; 
      $emp_type = $_POST['emp_type']; 
      $role_category = $_POST['role_category']; 
      $education = $_POST['education']; 
      $skills = $_POST['skills']; 
 
      $addpost = new posts($conn);
      $add_post = $addpost->post_insert($job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $joblocation, $role_category, $openings, $industry_type, $function_area, $emp_type, $role, $education, $skills);  
      
    }
    
    
    if($_POST['action'] == "addrole") {
      
      $role = $_POST['role']; 
 
      $addpost = new posts($conn);
      $add_post = $addpost->role_insert($role);  
      
    }
    
    
     if($_POST['action'] == "addlocation") {
      
      $location = $_POST['joblocation']; 
 
      $addpost = new posts($conn);
      $add_post = $addpost->location_insert($location);  
      
    }


//Update

   if($_POST['action'] == "inactive-list") {
      
      $id = $_POST['id']; 
 
      $inactivepost = new posts($conn);
      $inactivepostitem = $inactivepost->inactive_joblist($id);  
      
    }
    
    
    if($_POST['action'] == "active-list") {
      
      $id = $_POST['id']; 
 
      $inactivepost = new posts($conn);
      $inactivepostitem = $inactivepost->active_joblist($id);  
      
    }
    
    
      if($_POST['action'] == "updatepost") {
      
      $id = $_POST['id']; 
      $job_title = $_POST['job_title']; 
      $job_description = $_POST['job_description']; 
      $exper_min = $_POST['exper_min']; 
      $exper_max = $_POST['exper_max']; 
      $salary_min = $_POST['salary_min']; 
      $salary_max = $_POST['salary_max']; 
      $location = $_POST['location']; 
      $joblocation='';
  		foreach ($location as $a){
    		if ($joblocation=='') {
      			$joblocation = $a;
    		}else{
      			$joblocation .= ', '.$a;
    		}
  		}
		echo $joblocation;
        
      $role = $_POST['role']; 
      $openings = $_POST['openings']; 
      $industry_type = $_POST['industry_type']; 
      $function_area = $_POST['function_area']; 
      $emp_type = $_POST['emp_type']; 
      $role_category = $_POST['role_category']; 
      $education = $_POST['education']; 
      $skills = $_POST['skills']; 
 
      $addpost = new posts($conn);
      $add_post = $addpost->post_update($id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $joblocation, $role, $openings, $industry_type, $function_area, $emp_type, $role_category, $education, $skills);  
      
    }



// Delete 

    if($_POST['action'] == "remove-joblist") {
      
      $id = $_POST['id']; 
 
      $removepost = new posts($conn);
      $removepostitem = $removepost->remover_job_item($id);  
      
    }
    
    
    if($_POST['action'] == "remove-location") {
      
      $id = $_POST['id']; 
 
      $removepost = new posts($conn);
      $removepostitem = $removepost->remover_location_item($id);  
      
    }
    
    
    if($_POST['action'] == "remove-role") {
      
      $id = $_POST['id']; 
 
      $removepost = new posts($conn);
      $removepostitem = $removepost->remover_role_item($id);  
      
    }
    
    


?>         