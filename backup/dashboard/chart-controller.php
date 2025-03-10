<?php
include 'shadow.php';
if (isset($_GET['chart1'])) {
	$data=[];
	$get_data=$esdy_in->prepare("SELECT sno,job_title FROM post");
	$get_data->execute();
	foreach ($get_data->fetchAll(PDO::FETCH_ASSOC) as $key1) {
		$get_jobs=$esdy_in->prepare("SELECT COUNT(sno) as total FROM applicants WHERE jobid=:jobid");
		$get_jobs->bindParam(':jobid',$key1['sno']);
		$get_jobs->execute();
		$fetch_jobs=$get_jobs->fetch(PDO::FETCH_ASSOC);
		$get_jobs=null;
		array_push($data, array('position' => $key1['job_title'],'count' => $fetch_jobs['total']));
	}
	echo json_encode($data);
	$get_data=null;
}

if (isset($_GET['chart2'])) {

	$data=[];
	$get_data=$esdy_in->prepare("SELECT name FROM `locations` ");
	$get_data->execute();
	foreach ($get_data->fetchAll(PDO::FETCH_ASSOC) as $key1) {
		$get_jobs=$esdy_in->prepare("SELECT COUNT(sno) as total FROM applicants WHERE job_city=:job_city");
		$get_jobs->bindParam(':job_city',$key1['name']);
		$get_jobs->execute();
		$fetch_jobs=$get_jobs->fetch(PDO::FETCH_ASSOC);
		$get_jobs=null;
		array_push($data, array('location' => $key1['name'],'count' => $fetch_jobs['total']));
	}
	echo json_encode($data);
	$get_data=null;
}

?>