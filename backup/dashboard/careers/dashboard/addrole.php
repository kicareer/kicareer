<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include('../classes/posts.php');
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4">Preferred Role List</h2>
			 
			 <div class="border rounded p-4">

			  
			   <div class="post_form">
			    
			    <div class="mb-3">
   				 <label class="form-label">Add Preferred Role</label>
    				<input type="text" class="form-control" id="role">
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="btn btn-primary post px-4">Submit</div>
  			  
  			  </div>	
  			  
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
    

            
            <?php 
            
                $rolelisting = new posts($conn);
                $rolelist = $rolelisting ->rolelist();
                
                $i = 1;
            
                foreach($rolelist as $role) { ?>
                
                <tr class="row<?php echo $role['sno']; ?>">
                 <td><i class="fas fa-times remove-list mr-3" data-id="<?php echo $role['sno']; ?>"></i></td>    
                 <td scope="row"><?php echo $i; ?></td>
                 <td><?php echo $role['name']; ?></td>
                 <td><a href="edit-role.php?sno=<?=$role['sno']?>"> <i class="fas fa-edit"></i></a></td>
                </tr>
                    
                    
             <?php $i++; } ?>
			    
			</tbody>

       </table>
			    
			</div>
		</div>
	</div>

	
	<div id="response"></div>

<script>
$(document).ready(function(){
    
    
  $(".post").click(function(){
      
  role = $("#role").val();
 
      
     $.ajax({
                  url:'product-action.php',
                  method:'POST',
                  datatype:'json',
                  data:{
                    action : 'addrole',
                    role : role  
                },
          success:function(html){
                  $('div#response').html(html);
                  $(".post_form").fadeOut();
                  $('.post_form').delay(3000).fadeIn();
                  $('.response').fadeIn();
                  $('.response').html("<div class='alert alert-success px-4 py-3'>Successfully Submitted Form</div>");
                  $('.response').delay(3000).fadeOut();
                  $("#role").val("");
                  window.location.href="?success";
                }
             }) 

  });
  
  
// Remove Item
  
    $(".remove-list").click(function(){
  
  id = $(this).data("id");
      
     $.ajax({
        url:'product-action.php',
        method:'POST',
        datatype:'json',
           data:{
           action : 'remove-role',
           id : id 
              },
        success:function(html){
            $('div#response').html(html);
            $('tr.row'+id).hide();
                }
        }) 

  });
  
});
</script>
	
	
	

	<script type="text/javascript" src="../js/bootstrap.js "></script>
</body>
</html>