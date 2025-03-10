<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include 'shadow.php';
include('../classes/posts.php');
$sno=htmlspecialchars(trim($_GET['sno']));
$fetch=$esdy_in->prepare("SELECT name FROM locations WHERE sno=:sno");
$fetch->bindparam(':sno',$sno);
$fetch->execute();
$data=$fetch->fetch(PDO::FETCH_ASSOC);
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4"><a href="addlocation.php"><i class="far fa-arrow-alt-circle-left"></i></a> Preferred Job Location</h2>
			 
			 <div class="border rounded p-4">

			  <form method="POST">
			   <div class="">
			    
			    <div class="mb-3">
   				 <label class="form-label">    Edit Preferred Job Location</label>
    				<input type="text" name="location" class="form-control" id="" value="<?=$data['name']?>" required>
    				<div class="form-text"></div>
  				</div>
          <button type="submit" name="submit" class="btn btn-primary post px-4" >Edit Location </button>
  				
  			  
  			  </div>
          </form>	
  			  
  			   <div class="response"></div>
  				
            </div>
            
            
            <table class="table table-striped table-hover">
      <thead>
   
  </thead>
  

       </table>
			    
			</div>
		</div>
	</div>

	

	
	
	

	<script type="text/javascript" src="../js/bootstrap.js "></script>

  <?php
    if(isset($_POST['submit'])){
      $sno=htmlspecialchars(trim($_GET['sno']));
      $location=htmlspecialchars(trim($_POST['location']));
      $update=$esdy_in->prepare("UPDATE  locations SET name=:location WHERE sno=:sno");
      $update->bindparam(':location',$location);
      $update->bindparam(':sno',$sno);
      $update->execute();
      if($update){
        echo'<script>window.location.href="?sno='.$sno.'&edit-success"</script>';
      }
      else{
        echo'<script>window.location.href="?edit-failed"</script>';
      }
    }
  ?>
</body>
</html>