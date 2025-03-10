<?php
$page= basename($_SERVER['PHP_SELF']);
if ($page=='applicants-list.php') {
	$style='style="padding-top:50px;"';
}else{
	$style='style=""';
}
?>
<div class="col-md-12 p-0 pt-2 pb-3 border-bottom"  <?=$style?>>
	<ul type="none" class="mb-0"  <?=$style?>>
			<li  style="display: inline-block;padding-right: 30px">
				<a href="index.php" class="reset-anchor">
					<center>
						<i class="fas fa-tachometer-alt h1 mb-1"></i>
						<div><b>Dashboard</b></div>
					</center>
				</a>
			</li>
			<li  style="display: inline-block; padding-right: 30px;">
				<a href="masters.php" class="reset-anchor">
					<center>
						<i class="fas fa-file h1 mb-1"></i>
						<div><b>Masters</b></div>
					</center>
				</a>
			</li>
			<li  style="display: inline-block; padding-right: 30px;">
				<a href="job-list.php" class="reset-anchor">
					<center>
						<i class="fas fa-users h1 mb-1"></i>
						<div><b>Job Listing</b></div>
					</center>
				</a>
			</li>
			<li  style="display: inline-block; padding-right: 30px;">
				<a href="applicants-list.php" class="reset-anchor">
					<center>
						<i class="far fa-file-alt h1 mb-1"></i>
						<div><b>Applications</b></div>
					</center>
				</a>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<a href="settings.php" class="reset-anchor">
					<center>
						<i class="fas fa-cogs h1 mb-1"></i>
						<div><b>Settings</b></div>
					</center>
				</a>
			</li>
			
		<!--	
			<li  style="display: inline-block;padding-right: 30px">
				<center>
					<img src="../images/procurement.png" style="height: 40px;width:50px">
					<p><b>Procurement</b></p>
				</center>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<center>
					<img src="../images/maintenance.png" style="height: 40px;width:50px">
					<p><b>Services</b></p>
				</center>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<center>
					<img src="../images/card.png" style="height: 40px;width:55px">
					<p><b>Job Card</b></p>
				</center>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<center>
					<img src="../images/employee.png" style="height: 40px;width:50px">
					<p><b>HRM</b></p>
				</center>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<a href="invoice.php" class="reset-anchor">
					<center>
						<img src="../images/invoice.png" style="height: 40px;width:50px">
						<p><b>Invoicing</b></p>
					</center>
				</a>
			</li>
			<li  style="display: inline-block;padding-right: 30px">
				<a href="accounts-dashboard.php" class="reset-anchor">
					<center>
						<img src="../images/sales.png" style="height: 41px;width:50px;">
					</center>
					<p><b>Accounts</b></p>
				</a>
			</li>
			<li style="display: inline-block;">
				<a href="user-settings.php" class="reset-anchor">
					<img src="../images/worker.png" style="height: 41px;width:50px;margin-left: 30px;">
					<?php
						if ($page=='user-settings.php' || $page=='user-permission.php'|| $page=='user-master.php' || $page=='user-roles.php'||$page=='edit-user-role.php'||$page=='new-user-roles.php'|| $page=='edit-user.php' || $page=='view-user.php' || $page=='user-profile.php') {
							echo '<p class="nav-active"><b> User Management</b></p>';
						}else{
							echo '<p><b> User Management</b></p>';
						}
					?>
				</a>
			</li>
		   -->	
			
	</ul>
</div>