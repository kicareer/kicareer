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
                            <h3>Arrange Sequence</h3>
                        </div>
                       <div class="col-md-6">
                            <a href="?clear_seq" class="btn btn-sm btn-primary" style="float:right">Clear Sequence</a>
                        </div>
    			   </div>
                   <div class="row">
                        <?php
                            $get_posts=$esdy_in->prepare("SELECT sno,job_title,seq FROM post ORDER BY sno ASC");
                            $get_posts->execute();
                            if ($get_posts->rowCount()>0) {

foreach ($get_posts->fetchAll(PDO::FETCH_ASSOC) as $key) {
    echo '
        <div class="col-md-2">
            <div style="width:100%;height:auto;padding:20px;border:1px solid #d3d3d3;border-radius:5px;margin-bottom:5px;">
                <div style="height:50px;margin-bottom:5px;">'.$key['job_title'].'</div>
                <hr>
                <form>
                    <label>Existing Position : '.$key['seq'].'</label>
                    <input type="hidden" class="" name="sno" value="'.$key['sno'].'" style="width:100%" readonly="">
                    <select name="change_seq" onchange="this.form.submit()" style="width:100%">
                        <option value="">--SELECT--</option>
                    ';
                        $get_number=$esdy_in->prepare("SELECT count(sno) as total FROM post");
                        $get_number->execute();
                        $get_total=$get_number->fetch(PDO::FETCH_ASSOC);
                        for ($i=1; $i <= $get_total['total'] ; $i++) { 
                            if ($i!=$key['seq']) {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        }
                        $get_number=null;
        echo '
                    </select>
                </form>
            </div>
        </div>';
}
                            }else{

                            }
                            $get_posts=null;
                        ?>
                   </div>  				
                </div>
			</div>
		</div>
	</div>
	


<script type="text/javascript" src="../js/bootstrap.js "></script>

 
</body>
</html>
<?php
if (isset($_GET['clear_seq'])) {
    $update=$esdy_in->prepare("UPDATE post SET seq=NULL");
    $update->execute();
    if ($update) {
        echo '<script>window.location.href="?cleared"</script>';
    }else{
        echo '<script>window.location.href="?faile"</script>';
    }
    $update=null;
}

if (isset($_GET['change_seq'])) {
    $sno=htmlspecialchars(trim($_GET['sno']));
    $change_seq=htmlspecialchars(trim($_GET['change_seq']));
    
    $check_seq=$esdy_in->prepare("UPDATE post SET seq=NULL WHERE seq=:seq");
    $check_seq->bindParam(':seq',$change_seq);
    $check_seq->execute();
    $check_seq=null;

    $update=$esdy_in->prepare("UPDATE post SET seq=:seq WHERE sno=:sno");
    $update->bindParam(':seq',$change_seq);
    $update->bindParam(':sno',$sno);
    $update->execute();
    if ($update) {
        echo '<script>window.location.href="?success"</script>';
    }else{
        echo '<script>window.location.href="?failed"</script>';
    }
    $update=null;


}


$esdy_in=null;
?>
