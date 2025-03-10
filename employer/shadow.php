<?php
	$servername="localhost";
	$username="root";
	$password="";
	$db="wtxoeyoq_career_portal_new";
try{
	$esdy_in=new pdo("mysql:host=$servername;dbname=$db;charset=utf8",$username,$password);
	$esdy_in->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "connection failed".$e->getMessage();
}
?>