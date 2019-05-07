<?php 
session_start();
$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
{
	header('location:http://localhost/jquery_ajax_crud/home');
	exit();
}
if(isset($_GET['userid']))
{
	$userid = $_GET['userid'];
	$sql 	= "UPDATE story SET status = 1 WHERE userid = '".$userid."'";
		mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) > 0 )
		{
			setcookie('alert','alert-success',time()+4,'/');
			setcookie('update','Action Rollbacked Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
		else
		{
			setcookie('alert','alert-danger',time()+4,'/');
			setcookie('update','Action not Rollbacked Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
}
?>