<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include 'shadow.php';
include('../classes/posts.php');

$city=
    "CREATE TABLE IF NOT EXISTS `city`(
    sno int(10) not null primary key auto_increment,
    city varchar(300) not null)";
$esdy_in->exec($city);

?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4"> Preferred City</h2>
			 
			 <div class="border rounded p-4">
  			    <form method="POST">
              <div class="post_form">
                  <div class="mb-3">
                   <label class="form-label">Add City</label>
                    <input type="text" class="form-control" name="city">
                    <div class="form-text"></div>
                  </div>
                  <button class="btn btn-primary post px-4" name="submit_button" >Add city</button>
              </div>   
            </form>	
  			   <div class="response"></div>
            </div>
            <table class="table table-striped table-hover">
      <thead>
          <tr>
            <th></th>
            <th scope="col">Sno</th>
            <th scope="col">Role</th>
            <th scope="col">Edit</th>
          </tr>
      </thead>
  <tbody>
    <form>
    <?php
      $fetch=$esdy_in->prepare("SELECT * FROM city");
      $fetch->execute();
      $c=1;

      foreach ($fetch->fetchAll(PDO::FETCH_ASSOC) as $key) {
        echo'
          <tr>
            <td> <button type="submit" name="delete" style="border:0px; padding:0px; " > <i class="fas fa-times"></i></delete></td>
            <input type="hidden" name="sno" value='.$key['sno'].' ></input> 
            <td scope="col" >'.$c.'</td>
            <td scope="col" >'.$key['city'].'</td>
           <td scope="col" ><a href="edit-city.php?sno='.$key['sno'].'"> <i class="fas fa-edit"></i></a></td>
          </tr>
        ';
        $c++;
      }
    ?>
			    </form>
			</tbody>

       </table>
			    
			</div>
		</div>
	</div>

	
	<div id="response"></div>

	
	
	

	<script type="text/javascript" src="../js/bootstrap.js "></script>

<?php
    if (isset($_POST['submit_button'])) {
    $city=htmlspecialchars(trim($_POST['city']));
    $insert=$esdy_in->prepare("INSERT INTO `city` 
    (city) VALUES(:city)");
    $insert->bindparam(':city',$city);
    $insert->execute();
    if ($insert) {
     echo '<script>window.location.href="?success"</script>';
    }else{
     echo '<script>window.location.href="?failed"</script>';
    }
    $insert=null;
    }

   if(isset($_GET['delete'])){
    $sno=htmlspecialchars(trim($_GET['sno']));
    echo $sno;
    $delete=$esdy_in->prepare("DELETE FROM city WHERE sno=:sno");
    $delete->bindparam(':sno',$sno);
    $delete->execute();
    if($delete){
      echo'<script>window.location.href="?deleted"</script>';
    }
  }
?>
</body>
</html>