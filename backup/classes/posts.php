<?php

include('db.class.php');  

class posts
{

  public function __construct($conn) {
      $this->dbConn = $conn;
    }


// Show Items

   public function joblist() {
      
      $sql  = "SELECT * FROM post ORDER BY seq ASC";
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
    
    
    public function job_role_category_list($role_category) {
      
      $sql  = "SELECT * FROM post WHERE role_category='$role_category'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $joblist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      return $joblist;
      
    }
    
    
    public function applicantslist() {
      
      $sql  = "SELECT * FROM applicants ORDER BY sno DESC";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $applicantlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $applicantlist;
      
    }
    
    
     public function applicants_filter_list($experience, $apply_position, $residence, $current_emp, $current_sal, $job_city) {
      
      $sql  = "SELECT * FROM applicants WHERE experience LIKE '%$experience%' AND apply_position LIKE '%$apply_position%' AND residence LIKE '%$residence%' AND current_emp LIKE '%$current_emp%' AND current_sal LIKE '%$current_sal%' AND job_city LIKE '%$job_city%' ORDER BY sno DESC";
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
    
    
    public function job_applicant_city_count($city) {
      
         $sql  = "SELECT * FROM applicants WHERE job_city='$city'";
         $stmt = $this->dbConn->prepare($sql);
         $stmt->execute();
         $city = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $citycount = count($city);
      
         return $citycount;
      
    }
    
    
    public function job_applicant_role_count($rolename) {
      
         $sql  = "SELECT * FROM applicants WHERE role_category='$rolename'";
         $stmt = $this->dbConn->prepare($sql);
         $stmt->execute();
         $role = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $rolecount = count($role);
      
         return $rolecount;
      
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
    
    
    public function posts_role_list($rolename) {
      
      $sql  = "SELECT * FROM applicants as a INNER JOIN post as p ON p.sno = a.jobid WHERE p.role_category='$rolename'";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      $rolelist = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rolelist;
      
    }
    
    
    
    
// Insert Items

   
   public function application_insert($jobid, $name, $email, $phone, $residence, $dob, $profile_image, $current_emp, $current_sal, $experience, $apply_position, $job_city, $notice_period, $resume) {
     
     $apply_date = date("y/m/d");
     $apply_time = date("h:i:s A");

      $sql  = "INSERT INTO applicants (jobid, name, email, phone, residence, dob, profile_image, current_emp, current_sal, experience, apply_position, job_city, notice_period, resume, apply_date, apply_time) VALUES ('$jobid', '$name', '$email', '$phone', '$residence', '$dob', '$profile_image', '$current_emp', '$current_sal', '$experience', '$apply_position', '$job_city', '$notice_period', '$resume', '$apply_date', '$apply_time')";
      $stmt = $this->dbConn->prepare($sql);
      $stmt->execute();
      
   }  
   
   
   public function post_insert($employer_id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $joblocation, $role, $openings, $industry_type, $function_area, $emp_type, $role_category, $education, $skills, $status, $seq) {
     
    $post_date = date("Y/m/d");
    $post_time = date("h:i:s A");

    $sql = "INSERT INTO post (employer_id, job_title, job_description, exper_min, exper_max, salary_min, salary_max, location, role, openings, industry_type, function_area, emp_type, role_category, education, skills, post_date, post_time, status, seq) 
            VALUES (:employer_id, :job_title, :job_description, :exper_min, :exper_max, :salary_min, :salary_max, :location, :role, :openings, :industry_type, :function_area, :emp_type, :role_category, :education, :skills, :post_date, :post_time, :status, :seq)";
    
    $stmt = $this->dbConn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->bindParam(':job_title', $job_title);
    $stmt->bindParam(':job_description', $job_description);
    $stmt->bindParam(':exper_min', $exper_min);
    $stmt->bindParam(':exper_max', $exper_max);
    $stmt->bindParam(':salary_min', $salary_min);
    $stmt->bindParam(':salary_max', $salary_max);
    $stmt->bindParam(':location', $joblocation);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':openings', $openings);
    $stmt->bindParam(':industry_type', $industry_type);
    $stmt->bindParam(':function_area', $function_area);
    $stmt->bindParam(':emp_type', $emp_type);
    $stmt->bindParam(':role_category', $role_category);
    $stmt->bindParam(':education', $education);
    $stmt->bindParam(':skills', $skills);
    $stmt->bindParam(':post_date', $post_date);
    $stmt->bindParam(':post_time', $post_time);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':seq', $seq);

    // Execute the statement
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