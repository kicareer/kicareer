<?php
include 'headers.php';
include('../classes/posts.php');
?>
<?php
if (isset($_POST['upload_resume'])) {
	echo 'asd';
}
?>
<?php
	include 'top-nav.php';
?>
<div class="container-fluid">
	<?php
		include 'navigation.php';
	?>
</div>
	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-12 py-4">
			    
			 	<div class="row">
			       <div class="col-md-6"><h2 class="mb-4">Upload Kenz Resume</h2> </div>
			       <div class="col-md-6 text-end text-right">
			       </div>
			    </div>   
				
				<div class="border rounded p-4">
	  				<div class="row">
	  					<div class="col-md-12">
	  						<!-- <form method="post" enctype="multipart/form-data">
	  							<div class="form-group">
	  								<label>Upload Document (Only PDF/DOC Allowed)</label>
		  							<input type="file" class="form-control" name="kenz_resume" required="">
	  							</div>
	  							<div class="form-group">
	  								<button type="submit" name="upload_resume" class="btn btn-sm btn-primary"><i class="fas fa-upload"></i> Upload</button>
	  							</div>
	  						</form> -->
<form name="myForm" METHOD="POST" ACTION="" enctype="multipart/form-data">
  <input type="hidden" name="postid" value="<?=$_GET['postid']?>">
  <input type="file" class="form-control" required="" name="filebutton" id="filebutton">
  <input type="submit" class="btn btn-sm btn-primary m-t-10" name="submit" id="submit">
</form>

	  					</div>
	  				</div>
	            </div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>
<?php 
	if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
		// var_dump($_FILES, $_POST); 
		$postid=htmlspecialchars(trim($_GET['postid']));
		$temp = explode(".", $_FILES["filebutton"]["name"]);
		$ext = pathinfo($_FILES['filebutton'], PATHINFO_EXTENSION);
		$custom_name = $postid.'-kenz.'.end($temp);
		$newfilename = $custom_name;
		$file=$newfilename;
		$update=$conn->prepare("UPDATE applicants SET kenz_resume=:kenz_resume WHERE sno=:sno");
		$update->bindParam(':kenz_resume',$newfilename);
		$update->bindParam(':sno',$postid);
		$update->execute();
		if ($update) {
			move_uploaded_file($_FILES["filebutton"]["tmp_name"],"../uploads/" . $newfilename);
			echo '<script>window.location.href="applicant-view.php?postid='.$postid.'"</script>';
		}else{
			echo '<script>alert("")</script>';
		}
		$update=null;
	}
?>