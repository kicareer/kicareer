<?php
include 'headers.php';
include 'top-nav.php';
include 'navigation.php';
include('../classes/posts.php');
	?>

	<div class="container">
	    
		<div class="row justify-content-center">
		    
			<div class="col-md-9 py-5">
				
			 	
			 <h2 class="mb-4">Preferred Job Location</h2>
			 
			 <div class="border rounded p-4">

			  
			   <div class="post_form">
			    
			    <div class="mb-3">
   				 <label class="form-label">Add Preferred Job Location</label>
    				<input type="text" class="form-control" id="joblocation" required>
    				<div class="form-text"></div>
  				</div>
  				
  				<div class="btn btn-primary post px-4">Add Location</div>
  			  
  			  </div>	
  			  
  			   <div class="response"></div>
  				
            </div>
            
            
            <table class="table table-striped table-hover">
      <thead>
    <tr>
      <th scope="col"></th>    
      <th scope="col">S.no</th>
      <th scope="col">Location</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    

            
            <?php 
            
                $locationlisting = new posts($conn);
                $locationlist = $locationlisting ->locationlist();
                
                $i = 1;
            
                foreach($locationlist as $location) { ?>
                
                <tr class="row<?php echo $location['sno']; ?>">
                 <td><i class="fas fa-times remove-list mr-3" data-id="<?php echo $location['sno']; ?>"></i></td> 
                 <td scope="row"><?php echo $i; ?></td>
                 <td><?php echo $location['name']; ?></td>
                 <td><a href="edit-location.php?sno=<?=$location['sno']?>&name"> <i class="fas fa-edit"></i></a></td>
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
      
  joblocations = $("#joblocation").val();
      
     $.ajax({
                  url:'product-action.php',
                  method:'POST',
                  datatype:'json',
                  data:{
                    action : 'addlocation',
                    joblocation : joblocations
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
           action : 'remove-location',
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