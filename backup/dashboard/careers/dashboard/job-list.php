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
                        <h2>Current Openings</h2> 
                        <?php
                            if (isset($_GET['search'])) {
                                echo '<a href="?">(&times; Clear Search)</a>';
                            }
                            if (isset($_GET['sort'])) {
                                echo '<a href="?">(&times; Clear Filter)</a>';
                            }
                        ?>
                    </div>
			         <div class="col-md-6 text-end text-right">
                       
                        <a href="job-post-sequence.php" class="btn btn-success">Arrange Sequence</a>

                       <a href="Job-post-form.php" class="btn btn-primary">Post New Job</a>
                    </div>
			   </div>
               <div class="row">
                   <div class="col-md-12">
                       <table class="default-table" id="tbl1" style="width:100%;" border="1">
<thead style="background: #0089BA;color:white;white-space: nowrap;">
    <tr>
        <th style="padding:4px;"></th>
        <th style="padding:4px;">
            <div style="position: relative;"># 
                <span style="cursor: pointer;" onclick="if(getElementById('id_filter').style.display=='block'){getElementById('id_filter').style.display='none'}else{getElementById('id_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>

                <div id="id_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?field=seq&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?field=seq&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="seq" name="field">
                        <input type="hidden" value="no" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Date 
                <span style="cursor: pointer;" onclick="if(getElementById('date_filter').style.display=='block'){getElementById('date_filter').style.display='none'}else{getElementById('date_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                
                <div id="date_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?table=a&field=post_date&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?table=a&field=post_date&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="post_date" name="field">
                        <input type="hidden" value="a" name="table">
                        <input type="hidden" value="no" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Job Title
                <span style="cursor: pointer;" onclick="if(getElementById('job_title_filter').style.display=='block'){getElementById('job_title_filter').style.display='none'}else{getElementById('job_title_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                
                <div id="job_title_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?table=a&field=job_title&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?table=a&field=job_title&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="sjob_titleno" name="field">
                        <input type="hidden" value="a" name="table">
                        <input type="hidden" value="yes" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Location 
                <span style="cursor: pointer;" onclick="if(getElementById('loc_filter').style.display=='block'){getElementById('loc_filter').style.display='none'}else{getElementById('loc_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                
                <div id="loc_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?table=a&field=location&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?table=a&field=location&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="location" name="field">
                        <input type="hidden" value="a" name="table">
                        <input type="hidden" value="yes" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Role
                <span style="cursor: pointer;" onclick="if(getElementById('role_filter').style.display=='block'){getElementById('role_filter').style.display='none'}else{getElementById('role_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                
                <div id="role_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?table=a&field=role&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?table=a&field=role&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="role" name="field">
                        <input type="hidden" value="a" name="table">
                        <input type="hidden" value="yes" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Openings
                <span style="cursor: pointer;" onclick="if(getElementById('openings_filter').style.display=='block'){getElementById('openings_filter').style.display='none'}else{getElementById('openings_filter').style.display='block'}"><i class="fas fa-caret-down"></i></span>
                
                <div id="openings_filter" style="position: absolute;background: white;color:black;font-weight: normal;border:1px solid black;padding:4px;display: none;">
                    <a href="?table=a&field=openings&sort=asc">
                        <i class="fas fa-caret-up"></i> Ascending
                    </a>
                    <hr class="no-margin">
                    <a href="?table=a&field=openings&sort=desc">
                        <i class="fas fa-caret-down"></i> Descending
                    </a>
                    <hr class="no-margin">
                    <form>
                        <input type="hidden" value="openings" name="field">
                        <input type="hidden" value="a" name="table">
                        <input type="hidden" value="no" name="percentile">
                        <input type="" name="term" required="" style="width:100%"><br>
                        <button type="submit" name="search">Search</button>
                    </form>
                </div>
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Applied
            </div>
        </th>
        <th style="padding:4px;">
            <div style="position: relative;">Action</div>
        </th>
    </tr>
</thead>
                            <tbody>
<?php
    if (isset($_GET['sort'])) {
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
        $get_list=$esdy_in->prepare("SELECT * FROM post ORDER BY $field $sort");
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

        $get_list=$esdy_in->prepare("SELECT * FROM post WHERE $field LIKE :term ");
        $get_list->bindParam(':term',$term);
    }else{
        $get_list=$esdy_in->prepare("SELECT * FROM post ORDER BY seq ASC");
    }
    $get_list->execute();
    if ($get_list->rowCount()>0) {
        foreach($get_list->fetchAll(PDO::FETCH_ASSOC) as $key1){
            $getcount=$esdy_in->prepare("SELECT count(jobid) as count FROM applicants WHERE jobid=:jobid");
            $getcount->bindParam(':jobid',$key1['sno']);
            $getcount->execute();
            $fetchcount=$getcount->fetch(PDO::FETCH_ASSOC);
            $getcount=null;
            echo '<tr>
                <td style="padding:4px"><center><i class="fas fa-times remove-list mr-3" data-id="'.$joblist['sno'].'"></i></center></td>
                <td style="padding:4px">'.$key1['seq'].'</td>
                <td style="padding:4px">'.$key1['post_date'].'</td>
                <td style="padding:4px">'.$key1['job_title'].'</td>
                <td style="padding:4px">'.$key1['location'].'</td>
                <td style="padding:4px">'.$key1['role'].'</td>
                <td style="padding:4px">'.$key1['openings'].'</td>
                <td style="padding:4px">'.$fetchcount['count'].'</td>
                <td style="padding:4px">
                <div class="d-inline">
                 <a href="job-edit.php?postid='.$key1['sno'].'" target="blank"><i class="fas fa-edit edit-list mr-3 h5" data-id="'.$key1['sno'].'"></i></a>
                 ';
                   if($key1['status'] == "" || $key1['status'] == "active") {
                       echo "<i class='fas fa-eye-slash inactive-list active" . $key1['sno'] . " mr-3 h5' data-id='" . $key1['sno'] . "'></i>";
                   } else {  
                       echo "<i class='fas fa-eye active-list mr-3 inactive" . $key1['sno'] . "  h5' data-id='" . $key1['sno'] . "'></i>";
                   }
                 echo '

                 <a href="job-view.php?postid='.$key1['sno'].'"><i class="fas fa-arrow-circle-right h5"></i></a>
                </div> 
                 </td>
            </tr>';
        }
    }else{
        echo '<tr>
            <td colspan="9"><center>No data found</center></td>
        </tr>';
    }
    $get_list=null;
?>


                            </tbody>
                       </table>
                   </div>
               </div>
			    
			  
			 <div class="datafilter">

               <div id="response"></div>
               
             </div>    
  				
            </div>
				
				
			</div>
		</div>
	</div>
	
	


<script>
$(document).ready(function(){
    
    
  $(".remove-list").click(function(){
  
  id = $(this).data("id");
  alert(id)
      
     $.ajax({
        url:'product-action.php',
        method:'POST',
        datatype:'json',
           data:{
           action : 'remove-joblist',
           id : id 
              },
        success:function(html){
            $('div#response').html(html);
            $('tr.row'+id).hide();
                }
        }) 

  });
  
  
  // Active & inactive 
  
  
  $(".inactive-list").click(function(){
  
  id = $(this).data("id");
  $(this).removeClass("fa-eye-slash");
  $(this).addClass("fa-eye");
      
     $.ajax({
        url:'product-action.php',
        method:'POST',
        datatype:'json',
           data:{
           action : 'inactive-list',
           id : id 
              },
        success:function(html){
            $('div#response').html(html);
            
                }
        }) 

  });
  
  
  
  
  $(".active-list").click(function(){
  
  id = $(this).data("id");
  $(this).removeClass("fa-eye");
  $(this).addClass("fa-eye-slash");
      
     $.ajax({
        url:'product-action.php',
        method:'POST',
        datatype:'json',
           data:{
           action : 'active-list',
           id : id 
              },
        success:function(html){
            $('div#response').html(html);
                }
        }) 

  });
  
  
  
});
</script>

  

<script type="text/javascript" src="../js/bootstrap.js "></script>
	<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable(); 
      $('#example').DataTable( {  
      dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]

    });
 });  
 </script> 
 
</body>
</html>