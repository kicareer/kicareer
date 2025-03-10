<?php

include('db.class.php');  

class posts
{

  public function __construct($conn) {
      $this->dbConn = $conn;
    }


// Show Items

   public function joblist() {
      
      $sql  = "SELECT * FROM post ORDER BY sno ASC";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $joblist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $joblist;
      
    }
    
   
   public function joblistcount() {
      
      $sql  = "SELECT * FROM post";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $joblist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $jobcount = count($joblist);
      
      return $jobcount;
      
    }
    
    
    public function applicantslist() {
      
      $sql  = "SELECT * FROM applicants ORDER BY sno DESC";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $applicantlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $applicantlist;
      
    }
    
     public function applicantlistcount() {
      
      $sql  = "SELECT * FROM applicants";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $applicantlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $applicantlistcount = count($applicantlist);
      
      return $applicantlistcount;
      
    }
    
    
    public function job_applicant_count($id) {
      
      $sql  = "SELECT * FROM applicants WHERE jobid='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $applicantlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $jobapplicantcount = count($applicantlist);
      
      return $jobapplicantcount;
      
    }
    
    
    
     public function rolelist() {
      
      $sql  = "SELECT * FROM role ORDER BY sno DESC";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $rolelist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rolelist;
      
    }
    
    public function locationlist() {
      
      $sql  = "SELECT * FROM locations ORDER BY sno DESC";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $locationslist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $locationslist;
      
    }
    
    
    
    
// Insert Items

   
   public function application_insert($jobid, $name, $email, $phone, $residence, $dob, $profile_image, $current_emp, $current_sal, $experience, $apply_position, $job_city, $notice_period, $resume) {
     
     $apply_date = date("y/m/d");
     $apply_time = date("h:i:s A");

      $sql  = "INSERT INTO applicants (jobid, name, email, phone, residence, dob, profile_image, current_emp, current_sal, experience, apply_position, job_city, notice_period, resume, apply_date, apply_time) VALUES ('$jobid', '$name', '$email', '$phone', '$residence', '$dob', '$profile_image', '$current_emp', '$current_sal', '$experience', '$apply_position', '$job_city', '$notice_period', '$resume', '$apply_date', '$apply_time')";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
   }  
   
   
   public function post_insert($job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $location, $role, $openings, $industry_type, $function_area, $emp_type, $role_category, $education, $skills) {
     
     $post_date = date("y/m/d");
     $post_time = date("h:i:s A");

      $sql  = "INSERT INTO post (job_title, job_description, exper_min, exper_max, salary_min, salary_max, location, role, openings, industry_type, function_area, emp_type, role_category, education, skills, post_date, post_time) VALUES ('$job_title', '$job_description', '$exper_min', '$exper_max', '$salary_min', '$salary_max', '$location', '$role', '$openings', '$industry_type', '$function_area', '$emp_type', '$role_category', '$education', '$skills', '$post_date', '$post_time')";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
   } 
   
   public function role_insert($role) {

      $sql  = "INSERT INTO role (name) VALUES ('$role')";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
   }
   
   
   public function location_insert($location) {

      $sql  = "INSERT INTO locations (name) VALUES ('$location')";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
   } 
   
   
   
// UPDATE


  public function inactive_joblist($id) {
      
      $status = "inactive";
      
      $sql  = "UPDATE post SET status = '$status' WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $update = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $update;
      
    }
    
  
  public function active_joblist($id) {
      
      $status = "active";
      
      $sql  = "UPDATE post SET status = '$status' WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $update = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $update;
      
    }
    
    
  public function post_update($id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $location, $role, $openings, $industry_type, $function_area, $emp_type, $role_category, $education, $skills) {
      
      $sql  = "UPDATE post SET job_title='$job_title', job_description='$job_description', exper_min='$exper_min', exper_max='$exper_max', salary_min='$salary_min', salary_max='$salary_max', location='$location', role='$role', openings='$openings', industry_type='$industry_type', function_area='$function_area', emp_type='$emp_type', role_category='$role_category', education='$education', skills='$skills' WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $workshops = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $workshops;
      
    }
   
   
// Delete   
   
    
   public function remover_job_item($id) {
      
      $sql  = "DELETE FROM post WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
    }
    
    
   public function remover_location_item($id) {
      
      $sql  = "DELETE FROM locations WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
    }
    
    
   public function remover_role_item($id) {
      
      $sql  = "DELETE FROM role WHERE sno='$id'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
    }
    
    
    

}











?>