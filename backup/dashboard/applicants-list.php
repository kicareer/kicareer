<?php
include 'headers.php';
include('../classes/posts.php');
include 'shadow.php';
include 'top-nav.php';
include 'navigation.php';
?>


<?php if(isset($_SESSION['username'])) { } else {
    
    echo "<script>location.replace('login.php')</script>";
    
} ?>

<div class="container-fluid">    
	<div class="row justify-content-center">
		    
			<div class="col-md-12 py-4">
				
			 <div class="rounded p-4">
			   
			   <div class="row">
			        <div class="col-md-6">
                        <h2 class="">Applicant List</h2>
                        <?php
                            if (isset($_GET['search'])) {
                                echo '<a href="?">(&times; Clear Search)</a>';
                            }
                            if (isset($_GET['sort'])) {
                                echo '<a href="?">(&times; Clear Filter)</a>';
                            }
                        ?>
                    </div>
			        <div class="col-md-12 text-end p-b-20">
                        <!-- <button onclick="exportReportToExcel(this)"  class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Excel</button> -->
                        <?php
                            if (isset($_GET['sort'])) {
                                echo '
                                    <form action="download-applications.php">
                                        <input type="hidden" name="field" value="'.$_GET['field'].'">
                                        <input type="hidden" name="table" value="'.$_GET['table'].'">
                                        <input type="hidden" name="sort" value="'.$_GET['sort'].'">
                                        <button type="submit" name="sorting" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Excel</button>
                                    </form>';
                            }elseif(isset($_GET['search'])) {
                                echo '
                                    <form action="download-applications.php">
                                        <input type="hidden" name="field" value="'.$_GET['field'].'">
                                        <input type="hidden" name="table" value="'.$_GET['table'].'">
                                        <input type="hidden" name="percentile" value="'.$_GET['percentile'].'">
                                        <input type="hidden" name="term" value="'.$_GET['term'].'">
                                        <button type="submit" name="search" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Excel</button>
                                    </form>';
                            }else{
                                echo '
                                    <form action="download-applications.php">
                                        <button type="submit" name="all" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Excel</button>
                                    </form>';
                            }
                        ?>
			        </div>
			   </div>		  
			  
			  
    		<!-- Data  -->	  
    			  
    			  <div class="applicant-date-filter">

        <table class="default-table" id="tbl1" style="width:100%;" border="1">
            <thead style="background: #0089BA;color:white;white-space: nowrap;">
                <tr>
                    <td style="padding:4px;">
                        <div style="position: relative;"># 
                            <span style="cursor: pointer;" onclick="if(getElementById('id_filter').style.display=='block'){getElementById('id_filter').style.display='none'}else{getElementById('id_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="id_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="?table=a&field=sno&sort=asc">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="?table=a&field=sno&sort=desc">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="sno" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="no" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Date 
                            <span style="cursor: pointer;" onclick="if(getElementById('date_filter').style.display=='block'){getElementById('date_filter').style.display='none'}else{getElementById('date_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="date_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="?table=a&field=apply_date&sort=asc">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="?table=a&field=apply_date&sort=asc">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="apply_date" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="date" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Applied Job <span style="cursor: pointer;" onclick="if(getElementById('appliedjob_filter').style.display=='block'){getElementById('appliedjob_filter').style.display='none'}else{getElementById('appliedjob_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="appliedjob_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="?table=p&field=sno&sort=asc">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="?table=p&field=sno&sort=desc">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="sno" name="field">
                                    <input type="hidden" value="p" name="table">
                                    <input type="hidden" value="no" name="percentile">
                                    <select style="width:100%" required="" name="term">
                                        <option value="">--SELECT--</option>
                                        <?php
                                            $get_posts=$esdy_in->prepare("SELECT sno,job_title FROM post ORDER BY sno ASC");
                                            $get_posts->execute();
                                            foreach($get_posts->fetchAll(PDO::FETCH_ASSOC) as $all_posts){
                                                echo '<option value="'.$all_posts['sno'].'">'.$all_posts['job_title'].'</option>';
                                            }
                                            $get_posts=null;
                                        ?>
                                    </select><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Name <span style="cursor: pointer;" onclick="if(getElementById('name_filter').style.display=='block'){getElementById('name_filter').style.display='none'}else{getElementById('name_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="name_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="name" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Email <span style="cursor: pointer;" onclick="if(getElementById('email_filter').style.display=='block'){getElementById('email_filter').style.display='none'}else{getElementById('email_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="email_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="email" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Phone <span style="cursor: pointer;" onclick="if(getElementById('phone_filter').style.display=='block'){getElementById('phone_filter').style.display='none'}else{getElementById('phone_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="phone_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="phone" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Residence <span style="cursor: pointer;" onclick="if(getElementById('res_filter').style.display=='block'){getElementById('res_filter').style.display='none'}else{getElementById('res_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="res_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="job_city" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Dob <span style="cursor: pointer;" onclick="if(getElementById('dob_filter').style.display=='block'){getElementById('dob_filter').style.display='none'}else{getElementById('dob_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="dob_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="dob" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Experience <span style="cursor: pointer;" onclick="if(getElementById('exp_filter').style.display=='block'){getElementById('exp_filter').style.display='none'}else{getElementById('exp_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="exp_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="experience" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <select name="term" required="" style="width:100%">
                                        <option value="">--SELECT--</option>
                                        <option value="0">0 Years</option>
                                        <option value="1">1 Years</option>
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
                                    <br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Current Employment <span style="cursor: pointer;" onclick="if(getElementById('curemp_filter').style.display=='block'){getElementById('curemp_filter').style.display='none'}else{getElementById('curemp_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="curemp_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="current_emp" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Salary <span style="cursor: pointer;" onclick="if(getElementById('salary_filter').style.display=='block'){getElementById('salary_filter').style.display='none'}else{getElementById('salary_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="salary_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="current_sal" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <!-- <td style="padding:4px;">
                        <div style="position: relative;">
                            Applying Position <span style="cursor: pointer;" onclick="if(getElementById('apppos_filter').style.display=='block'){getElementById('apppos_filter').style.display='none'}else{getElementById('apppos_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="apppos_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="apply_position" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td> -->
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            City <span style="cursor: pointer;" onclick="if(getElementById('city_filter').style.display=='block'){getElementById('city_filter').style.display='none'}else{getElementById('city_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="city_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="job_city" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="yes" name="percentile">
                                    <input type="" name="term" required="" style="width:100%"><br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">
                        <div style="position: relative;">
                            Notice Period <span style="cursor: pointer;" onclick="if(getElementById('notice_filter').style.display=='block'){getElementById('notice_filter').style.display='none'}else{getElementById('notice_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                            <div id="notice_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                                <a href="">
                                    <i class="fas fa-caret-up"></i> Ascending
                                </a>
                                <hr class="no-margin">
                                <a href="">
                                    <i class="fas fa-caret-down"></i> Descending
                                </a>
                                <hr class="no-margin">
                                <form>
                                    <input type="hidden" value="notice_period" name="field">
                                    <input type="hidden" value="a" name="table">
                                    <input type="hidden" value="no" name="percentile">
                                    <select name="term" required="" style="width:100%">
                                          <option value="">--SELECT--</option>
                                          <option value="One Week">One Week</option>
                                          <option value="Two Week">Two Weeks</option>
                                          <option value="One Month">One Month</option>
                                          <option value="Two Months">Two Months</option>
                                          <option value="More">More</option>
                                    </select>
                                    <br>
                                    <button type="submit" name="search">Search</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="padding:4px;">Profile Image </td>
                    <td style="padding:4px;">Resume </td>
                    <td style="padding:4px;">Kenz Resume </td>
                </tr>
            </thead>
            <tbody style="white-space: nowrap;">
                <?php
                if (isset($_GET['sort'])) {
                    
                    if (isset($_GET['table'])) {
                        $table=htmlspecialchars(trim($_GET['table']));
                    }else{
                        $table='a';
                    }
                    if (isset($_GET['field'])) {
                        $field=htmlspecialchars(trim($_GET['field']));
                    }else{
                        $field='sno';
                    }
                    if (isset($_GET['sort'])) {
                        $sort=htmlspecialchars(trim($_GET['sort']));
                    }else{
                        $sort='asc';
                    }
                    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid ORDER BY $table.$field $sort ");
                }elseif(isset($_GET['search'])){
                    $field=htmlspecialchars(trim($_GET['field']));
                    $table=htmlspecialchars(trim($_GET['table']));
                    $term=htmlspecialchars(trim($_GET['term']));
                    $percentile=htmlspecialchars(trim($_GET['percentile']));
                    if ($percentile=='yes') {
                        $term='%'.$term.'%';
                    }else{
                        $term=$term;
                    }

                    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid WHERE $table.$field LIKE :term ");
                    $getjobs->bindParam(':term',$term);
                }else{
                    $getjobs=$esdy_in->prepare("SELECT a.*,p.job_title FROM applicants a LEFT JOIN post p ON p.sno=a.jobid ORDER BY a.sno desc");
                }
                    $getjobs->execute();
                    if ($getjobs->rowCount()>0) {
                        $c=1;
                        foreach ($getjobs->fetchAll(PDO::FETCH_ASSOC) as $value) {
                            $d=explode('/', $value['apply_date']);
                            $date=$d[2].'/'.$d[1].'/'.$d[0];
                            echo '<tr>
                                <td style="padding:4px"><a href="applicant-view.php?postid='.$value['sno'].'">'.$value['sno'].'</a></td>
                                <td style="padding:4px">'.$date.'</td>
                                <td style="padding:4px">'.$value['job_title'].'</td>
                                <td style="padding:4px">'.$value['name'].'</td>
                                <td style="padding:4px">'.$value['email'].'</td>
                                <td style="padding:4px">'.$value['phone'].'</td>
                                <td style="padding:4px">'.$value['residence'].'</td>
                                <td style="padding:4px">'.$value['dob'].'</td>
                                <td style="padding:4px">'.$value['experience'].'</td>
                                <td style="padding:4px">'.$value['current_emp'].'</td>
                                <td style="padding:4px">'.$value['current_sal'].'</td>
                                
                                <td style="padding:4px">'.$value['job_city'].'</td>
                                <td style="padding:4px">'.$value['notice_period'].'</td>
                                <td style="padding:4px"><a href="https://kenz-innovations.com/careers/uploads/profile/'.$value['profile_image'].'" target="_blank">https://kenz-innovations.com/careers/uploads/profile/'.$value['profile_image'].'</a></td>
                                <td style="padding:4px"><a href="https://kenz-innovations.com/careers/uploads/'.$value['resume'].'" target="_blank">https://kenz-innovations.com/careers/uploads/'.$value['resume'].'</a></td>
                                <td style="padding:4px"><a href="https://kenz-innovations.com/careers/uploads/'.$value['kenz_resume'].'" target="_blank">https://kenz-innovations.com/careers/uploads/'.$value['kenz_resume'].'</a></td>
                            </tr>
                            ';
                        $c++;
                        }
                    }else{
                        echo '<tr>
                            <td colspan="16"><center>--No data found--</center></td>
                        </tr>';
                    }
                    $getjobs=null;
                ?>
            </tbody>
        </table>
    </div> 			
</div>
				
				
			</div>
		</div>
		
</div>
	
	
 <style>
 
 td.resume, th.resume {
    display: none !important;
}
     
 </style>

  

	<script type="text/javascript" src="../js/bootstrap.js "></script>
    <!-- <script type="text/javascript" src="exportToExcel.js "></script> -->
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script type="text/javascript">
function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `export.xlsx`, // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}

</script>


 
 
</body>
</html>