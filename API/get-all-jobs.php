<?php
include('../classes/posts.php');

if (isset($_GET['get_all_jobs'])) {
    if (isset($_GET['employer_id']) && !empty($_GET['employer_id'])) {
        // For subdomain - get specific employer's jobs
        $employer_id = $_GET['employer_id'];
        $stmt = $conn->prepare("SELECT * FROM post WHERE employer_id = ? AND (status = '' OR status = 'active')");
        $stmt->execute([$employer_id]);
        $joblists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // For main domain - get all jobs
        $joblisting = new posts($conn);
        $joblists = $joblisting->joblist();
    }

    foreach ($joblists as $joblist) { 
        if($joblist['status'] == "" || $joblist['status'] == "active") {
            ?>
            <?php
                if (isset($_GET['login'])) {
                $id=htmlspecialchars(trim($_GET['id']));
                }
            ?>
            <article onclick="window.location.href='apply.php?login&postid=<?php echo $joblist['sno']; ?>';">
                <div class="card card-article" style="cursor: pointer;">
                    <p class="m-0">
                      <b><?php echo $joblist['job_title']; ?></b><br>
                      <span><?php echo $joblist['role']; ?></span>
                    </p>
                    <div class="p-0 m-0">
                       <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">

                           <?php
                                 if ($joblist['exper_min']!='') {
                                     ?>
                                      <li>
                            <i class="icon-clipboard "></i> 
                            <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></li>
                                     <?php
                                 }else {
                                     echo "";
                                 }

                             ?>

                             
                           

                             <?php
                                 if ($joblist['salary_min']!='') {
                                     ?>
                                      <li>
                            <i class="fas fa-coins text-muted mr-2"></i>
                             <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></li>
                                     <?php
                                 }else {
                                     echo "";
                                 }

                             ?>
                          
                             <?php
                                 if ($joblist['location']!='') {
                                     ?>
                                     <li>
                                        <i class="icon-map-pin"></i>
                                         <?php echo $joblist['location']; ?>
                                     </li>
                                     <?php
                                 }else {
                                     echo "";
                                 }

                             ?>

                       </ul>
                        <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 5px 0px">
                           <li class="two-lines"><i class="icon-file"></i> &nbsp;<?php echo $joblist['job_description']; ?></li>
                        </ul>
                        
                    </div>
                    <div class="breadcrumb m-0 p-0 p-t-5">
                        <ul>
                            <li><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?> </li>
                            <li><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?> </li>
                        </ul>
                    </div>
                    <div style="margin-bottom: -10px !important;">
                            
                            <?php
                                $fetch = $conn->prepare("SELECT * FROM applicants WHERE applied_id=:applied_id AND jobid=:jobid");
                                $fetch->bindParam(':applied_id', $userRow['id']);
                                $fetch->bindParam(':jobid', $joblist['sno']);
                                $fetch->execute();
                                if ($fetch->rowCount()>0) {
                            ?>
                                <button class="btn btn-success mt-2 ml-2 mobi-btn" style="float: right;"><i class="fas fa-check"></i> Applied</button>
                            <?php
                                } else {
                            ?>
                                <a href="application.php?login&id=<?= $id ?>&postid=<?= $joblist['sno'] ?>&jobtitle=<?= $joblist['job_title'] ?>&rolecategory=<?= $joblist['role_category'] ?>" style="float: right;" class="btn btn-success mt-2 ml-2 mobi-btn"><i class="fas fa-arrow-right"></i> Apply Now</a>
                            <?php
                                }
                            ?>
                            <a href="apply.php?login&postid=<?php echo $joblist['sno']; ?> " class="btn btn-primary mt-2" style="background:#1778bc;border-color:#1778bc;float: right;"><i class="fas fa-eye"></i></i> View Details</a>
                        </div>
                </div>
            </article>

            <?php 
        } 
    }
}

if (isset($_GET['sort_jobs'])) {
    $departments = htmlspecialchars(trim($_GET['departments']));
    $emp_type = htmlspecialchars(trim($_GET['emp_type']));
    $industry_type = htmlspecialchars(trim($_GET['industry_type']));
    
    $sql = "SELECT * FROM post WHERE (status = '' OR status = 'active')";
    $params = array();
    
    // Add employer filter if on subdomain
    if (isset($_GET['employer_id']) && !empty($_GET['employer_id'])) {
        $sql .= " AND employer_id = :employer_id";
        $params[':employer_id'] = $_GET['employer_id'];
    }
    
    if (!empty($departments)) {
        $sql .= " AND role = :role";
        $params[':role'] = $departments;
    }
    if (!empty($emp_type)) {
        $sql .= " AND emp_type = :emp_type";
        $params[':emp_type'] = $emp_type;
    }
    if (!empty($industry_type)) {
        $sql .= " AND industry_type = :industry_type";
        $params[':industry_type'] = $industry_type;
    }
    
    $sql .= " ORDER BY seq ASC";
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $joblists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($joblists)) {
        foreach ($joblists as $joblist) {
            ?>
            <?php
                if (isset($_GET['login'])) {
                $id=htmlspecialchars(trim($_GET['id']));
                }
            ?>
            <article onclick="window.location.href='apply.php?login&postid=<?php echo $joblist['sno']; ?>';">
                <div class="card card-article" style="cursor: pointer;">
                    <p class="m-0">
                      <b><?php echo $joblist['job_title']; ?></b><br>
                      <span><?php echo $joblist['role']; ?></span>
                    </p>
                    <div class="p-0 m-0">
                       <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                           <li><i class="icon-clipboard "></i> <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></li>
                           <li><i class="fas fa-coins text-muted mr-2"></i> <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></li>
                           <li><i class="icon-map-pin"></i> <?php echo $joblist['location']; ?></li>
                       </ul>
                        <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 5px 0px">
                           <li class="two-lines"><i class="icon-file"></i> &nbsp;<?php echo $joblist['job_description']; ?></li>
                        </ul>
                        
                    </div>
                    <div class="breadcrumb m-0 p-0 p-t-5">
                        <ul>
                            <li><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?> </li>
                            <li><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?> </li>
                        </ul>
                    </div>
                    <div style="margin-bottom: -10px !important;">
                            
                            <?php
                                $fetch = $conn->prepare("SELECT * FROM applicants WHERE applied_id=:applied_id AND jobid=:jobid");
                                $fetch->bindParam(':applied_id', $userRow['id']);
                                $fetch->bindParam(':jobid', $joblist['sno']);
                                $fetch->execute();
                                if ($fetch->rowCount()>0) {
                            ?>
                                <button class="btn btn-success mt-2 ml-2 mobi-btn" style="float: right;"><i class="fas fa-check"></i> Applied</button>
                            <?php
                                } else {
                            ?>
                                <a href="application.php?login&id=<?= $id ?>&postid=<?= $joblist['sno'] ?>&jobtitle=<?= $joblist['job_title'] ?>&rolecategory=<?= $joblist['role_category'] ?>" style="float: right;" class="btn btn-success mt-2 ml-2 mobi-btn"><i class="fas fa-arrow-right"></i> Apply Now</a>
                            <?php
                                }
                            ?>
                            <a href="apply.php?login&postid=<?php echo $joblist['sno']; ?> " class="btn btn-primary mt-2" style="background:#1778bc;border-color:#1778bc;float: right;"><i class="fas fa-eye"></i></i> View Details</a>
                        </div>
                </div>
            </article>

            <?php 
        }
    } else {
        echo "<div class='text-center p-5 bg-light border card card-article'>No jobs found matching your criteria</div>";
    }
}

if (isset($_GET['search_jobs'])) {
    // echo json_encode($_GET);
    // exit;
	$job=trim($_GET['job']);
	$experience=trim($_GET['experience']);
	$location=(trim($_GET['location']));
	$sql = "SELECT * FROM post WHERE status='active'";
	if (!empty($job)) {
		$sql.=" AND job_title LIKE '%".$job."%'";
	}
    if (!empty($experience)) {
        $sql.=" AND exper_min <= '".$experience."' AND exper_max >= '".$experience."'";
    }
	
	if (!empty($location)) {
		$sql.=" AND location LIKE '%".$location."%'";
	}
	// $sql.="ORDER BY seq ASC";
    // echo $sql;
    // exit;
	$stmt = $conn->prepare($sql);
    $stmt->execute();
    $joblists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($joblists)) {
       
    foreach ($joblists as $joblist) { 
        if($joblist['status'] == "" || $joblist['status'] == "active") {
            ?>
            <?php
                if (isset($_GET['login'])) {
                $id=htmlspecialchars(trim($_GET['id']));
                }
            ?>
            <article onclick="window.location.href='apply.php?login&postid=<?php echo $joblist['sno']; ?>';">
                <div class="card card-article" style="cursor: pointer;">
                    <p class="m-0">
                      <b><?php echo $joblist['job_title']; ?></b><br>
                      <span><?php echo $joblist['role']; ?></span>
                    </p>
                    <div class="p-0 m-0">
                       <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                           <li><i class="icon-clipboard "></i> <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></li>
                           <li><i class="fas fa-coins text-muted mr-2"></i> <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></li>
                           <li><i class="icon-map-pin"></i> <?php echo $joblist['location']; ?></li>
                       </ul>
                        <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 5px 0px">
                           <li class="two-lines"><i class="icon-file"></i> &nbsp;<?php echo $joblist['job_description']; ?></li>
                        </ul>
                        
                    </div>
                    <div class="breadcrumb m-0 p-0 p-t-5">
                        <ul>
                            <li><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?> </li>
                            <li><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?> </li>
                        </ul>
                    </div>
                    <div style="margin-bottom: -10px !important;">
                            
                            <?php
                                $fetch = $conn->prepare("SELECT * FROM applicants WHERE applied_id=:applied_id AND jobid=:jobid");
                                $fetch->bindParam(':applied_id', $userRow['id']);
                                $fetch->bindParam(':jobid', $joblist['sno']);
                                $fetch->execute();
                                if ($fetch->rowCount()>0) {
                            ?>
                                <button class="btn btn-success mt-2 ml-2 mobi-btn" style="float: right;"><i class="fas fa-check"></i> Applied</button>
                            <?php
                                } else {
                            ?>
                                <a href="application.php?login&id=<?= $id ?>&postid=<?= $joblist['sno'] ?>&jobtitle=<?= $joblist['job_title'] ?>&rolecategory=<?= $joblist['role_category'] ?>" style="float: right;" class="btn btn-success mt-2 ml-2 mobi-btn"><i class="fas fa-arrow-right"></i> Apply Now</a>
                            <?php
                                }
                            ?>
                            <a href="apply.php?login&postid=<?php echo $joblist['sno']; ?> " class="btn btn-primary mt-2" style="background:#1778bc;border-color:#1778bc;float: right;"><i class="fas fa-eye"></i></i> View Details</a>
                        </div>
                </div>
            </article>

            <?php 
        } 
    }
}
else{
    // echo $sql;
    echo "<div class='text-center p-5 bg-light border card card-article'>No matching job found</div>";
}

}

// Add employer_id filter to your queries if it's provided
if (isset($_GET['employer_id']) && !empty($_GET['employer_id'])) {
    $employer_id = $_GET['employer_id'];
    
    // Modify your existing queries to include employer_id filter
    if (isset($_GET['get_all_jobs'])) {
        $query = "SELECT * FROM post WHERE employer_id = :employer_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':employer_id', $employer_id);
    }
    
    if (isset($_GET['sort_jobs'])) {
        // Add employer_id to your filter query
        $query = "SELECT * FROM post WHERE employer_id = :employer_id";
        if (!empty($departments)) {
            $query .= " AND role = :role";
        }
        if (!empty($emp_type)) {
            $query .= " AND emp_type = :emp_type";
        }
        // ... other filters ...
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':employer_id', $employer_id);
        // Bind other parameters...
    }
    
    if (isset($_GET['job']) || isset($_GET['experience']) || isset($_GET['location'])) {
        $query = "SELECT * FROM post WHERE employer_id = :employer_id";
        if (!empty($_GET['job'])) {
            $query .= " AND job_title LIKE :job_title";
        }
        if (!empty($_GET['experience'])) {
            $query .= " AND experience = :experience";
        }
        if (!empty($_GET['location'])) {
            $query .= " AND location = :location";
        }
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':employer_id', $employer_id);
        // Bind other parameters...
    }
}
?>