<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include('../classes/posts.php');
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4">Manage Your Password</h2>
			 
			 <div class="border rounded p-4">

			  
			<div class="post_form">
			    <form method="post">
    			    <div class="mb-3">
       				 <label class="form-label">Enter New Password</label>
        				<input type="password" class="form-control" id="pass" required="" name="pass" placeholder="***********">
        				<div class="form-text"></div>
      				</div>
                    <div class="mb-3">
                     <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="c_pass" required=""  placeholder="***********">
                        <div class="form-text"></div>
                    </div>
                    <div id="pass_err"></div>
                    <div>
                        <button type="submit" name="changepass" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </form>
  				
  			</div>	
  			  
  			   <div class="response m-t-20">
            <?php
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> '.$_GET['success'].'</div>';
                }

            ?>       
               </div>
  				
            </div>
			    
			</div>
		</div>
	</div>

	
	<div id="response"></div>
	<script type="text/javascript" src="../js/bootstrap.js "></script>
    <script type="text/javascript">
        $("#c_pass").on('change paste keyup keydown',function(){
            var pass=$("#pass").val();
            var c_pass=$("#c_pass").val();
            if (pass!=c_pass) {
                $("#pass_err").html('<span style="color:red">Your passwords dont match</span>');
            }else{
                $("#pass_err").html('');
            }
        });
    </script>
</body>
</html>
<?php
if (isset($_POST['changepass'])) {
    $pass=$_POST['pass'];
    $content='<?php $password="'.$pass.'"?>';
    $fp = fopen("password.php","wb");
    if( $fp == false ){
        //do debugging or logging here
    }else{
        fwrite($fp,$content);
        fclose($fp);
    }
    echo '<script>window.location.href="?success=Password changed successfully."</script>';
}

?>