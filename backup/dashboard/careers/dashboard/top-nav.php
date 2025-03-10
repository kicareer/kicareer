<?php
$page= basename($_SERVER['PHP_SELF']);
if ($page=='applicants-list.php') {
	$style='style="position:fixed;z-index:999999"';
}else{
	$style='style=""';
}
?>
<div class="top_bar_new" <?=$style?>>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="">
				<span>
					<p class="float-right p-t-10"><a href="logout.php?logout" class="reset-anchor"><i class="fas fa-power-off"></i> Logout</a></p>
					<a href="index.php" class="reset-anchor">
						<p class="p-t-10">
							<span class="m-t-10"><b>Talent Management</b></span>
						</p>
					</a>
				</span>
			</div>
		</div>
	</div>
</div>