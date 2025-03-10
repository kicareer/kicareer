<?php
include 'headers.php';
include('../classes/posts.php');

$jobcount = new posts($conn);
$joblistcount = $jobcount ->joblistcount();

$applicantcount = new posts($conn);
$applicantlistcount = $applicantcount ->applicantlistcount();

?>

<?php
	include 'top-nav.php';
?>

<?php

if(isset($_SESSION['username'])) { } else {
    
    echo "<script>location.replace('login.php')</script>";
    
}


?>


<div class="container-fluid">
	<?php
		include 'navigation.php';
	?>
</div>
	<div class="container-fluid m-t-20">
	    <div class="row">
	        
	        
	        <?php

                  $locationlisting = new posts($conn);
                  $locationlist = $locationlisting ->locationlist();
              
                  foreach($locationlist as $location) { 
                  
                  $city = $location['name']; ?>
                     
                     <div class="col-md-2 mb-4">
	    		<div style="width:100%;background: #0089BA;color: white;padding:10px;">
	    			<h3 class="no-margin">
	    			    <?php
	    			    
	    			    $citycounts = new posts($conn);
                        $citycount = $citycounts ->job_applicant_city_count($city);
                        
                        echo $citycount;
	    			    
	    			    ?></h3>
	    			<p class="no-margin"><?php echo $location['name']; ?></p>
	    		</div>
	    	</div>
                
                
                <?php  $i++; } 
	        
	        ?>
	        
	        
	        <?php
                   
                   /**
	    			    $rolecounts = new posts($conn);
                        $rolecount = $citycounts ->rolelist();
                        
                        $role_total = count($rolecount);

                        
                        $roletotal = $role_total;
                        
                         $r = 0;
                        
                        foreach($rolecount as $role) {
                            
                            
                         if($r < 4) {
                            
                            $role_category = $role['name'];
                            $allposts = new posts($conn);
                            $allpost = $allposts ->job_role_category_list($role_category);
                        
                            $total_applicant_count = "";
                            $postcount = "";

                              foreach($allpost as $posts) { 
                            
                            $postcount = "yes";
                           
                             $id = $posts['sno'];
                        
                             $applicantcounts = new posts($conn);
                             $applicantcount = $applicantcounts ->job_applicant_count($id);
                             
                             $applicant_count = $applicantcount;
                        
                              $total_applicant_count += $applicant_count;
                        
                            }
                            
                            
                               if(($postcount == "yes")) {
                                
                                $rolepercentage = ($total_applicant_count/$role_total)*360;
                                 echo $rolepercentage . ", ";
                
                                 } else {
                                $total_applicant_count = "0";
                                $rolepercentage = ($total_applicant_count/$role_total)*360;
                                 echo $rolepercentage . ", ";
                            }
                            
                            $r++;
                            
                         } else {
                             
                             
                              $role_category = $role['name'];
                            $allposts = new posts($conn);
                            $allpost = $allposts ->job_role_category_list($role_category);
                        
                            $total_applicant_count = "";
                            $postcount = "";

                              foreach($allpost as $posts) { 
                            
                            $postcount = "yes";
                           
                           $id = $posts['sno'];
                        
                             $applicantcounts = new posts($conn);
                             $applicantcount = $applicantcounts ->job_applicant_count($id);
                             
                             $applicant_count = $applicantcount;
                        
                              $total_applicant_count += $applicant_count;
                        
                            }
                            
                            
                               if(($postcount == "yes")) {
                                
                                $rolepercentage = ($total_applicant_count/$role_total)*360;
                                 echo $rolepercentage;
                
                                 } else {
                                $total_applicant_count = "0";
                                $rolepercentage = ($total_applicant_count/$role_total)*360;
                                 echo $rolepercentage;
                            }
                             
                             
                             
                         }  }
                         
                         
                         **/
 
	    			    
	    			    ?>


	    	<div class="col-md-12">
	    		<hr>
	    	</div>

	    	<div class="col-md-12">
	    		<center><h3 class="no-margin">Job wise applicants.</h3></center>
	    		<div id="chart1"></div>
	    	</div>
        <div class="col-md-12"><hr></div>
	    	<div class="col-md-12">
	    		<center>
	    			<h3 class="no-margin">City wise applicants</h3>
	    		</center>
	    		<div id="chart2"></div>
	    	</div>
	    </div>
	</div>

	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/apexcharts.min.js"></script>
<script type="text/javascript">
window.onload=function(){
	chart1();
	chart2();
}

////////////////CHART 1////////////////
function chart1(){
  url="chart-controller.php";
  data="chart1=";
  $.ajax({
    type:"GET",url:url,data:data,cache:false,crossDomain:false,
    beforeSend:function(){},
    success:function(data){
      data=$.trim(data);
      if (data!='no') {
        obj=$.parseJSON(data);
        var positions=new Array();
        var counts=new Array();
        $.each(obj,function(key,value){
          positions.push(value.position);
          c=Number(value.count);
          counts.push(c);
        });
        // alert(positions);
        // alert(counts);

        // chart

          var options = {
            series: [{
            name: 'Applicants',
            data: counts
          }],
            chart: {
            height: 350,
            type: 'bar',
          },
          plotOptions: {
            bar: {
              borderRadius: 10,
              dataLabels: {
                position: 'top', // top, center, bottom
              },
            }
          },
          dataLabels: {
            enabled: true,
            formatter: function (val) {
              return val;
            },
            offsetY: -20,
            style: {
              fontSize: '12px',
              colors: ["#304758"]
            }
          },
          
          xaxis: {
            categories: positions,
            position: 'top',
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            },
            crosshairs: {
              fill: {
                type: 'gradient',
                gradient: {
                  colorFrom: '#D8E3F0',
                  colorTo: '#BED1E6',
                  stops: [0, 100],
                  opacityFrom: 0.4,
                  opacityTo: 0.5,
                }
              }
            },
            tooltip: {
              enabled: true,
            }
          },
          yaxis: {
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false,
            },
            labels: {
              show: false,
              formatter: function (val) {
                return val ;
              }
            }
          
          },
          title: {
            text: 'Job wise applicants',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
              color: '#444'
            }
          }
          };

          var chart = new ApexCharts(document.querySelector("#chart1"), options);
          chart.render(); 
        // chart

      }else{

      }
    }
  });
}
////////////////CHART 1////////////////

////////////////CHART 2////////////////
function chart2(){
  url="chart-controller.php";
  data="chart2=";
  $.ajax({
    type:"GET",url:url,data:data,cache:false,crossDomain:false,
    beforeSend:function(){},
    success:function(data){
      data=$.trim(data);
      if (data!='no') {
        obj=$.parseJSON(data);
        var positions=new Array();
        var counts=new Array();
        $.each(obj,function(key,value){
          positions.push(value.location);
          c=Number(value.count);
          counts.push(c);
        });
        // alert(positions);
        // alert(counts);

        //CHART

          var options = {
            series: counts,
            chart: {
            width: 380,
            type: 'pie',
          },
          labels: positions,
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
          };

          var chart = new ApexCharts(document.querySelector("#chart2"), options);
          chart.render();
        //CHART

      }else{

      }
    }
  });
}
////////////////CHART 2////////////////




</script>
</body>
</html>