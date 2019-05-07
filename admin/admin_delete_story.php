<?php 
session_start();
$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
{
	header('location:http://localhost/jquery_ajax_crud/home');
	exit();
}
if(isset($_GET['id']))
{
	$userid = $_GET['id'];
	$sql 	= "SELECT * FROM story WHERE userid = '".$userid."'";
	$row	= mysqli_query($con,$sql);
	if(mysqli_num_rows($row) > 0 )
	{
		$sql = "UPDATE story SET status = 0 WHERE userid = '".$userid."'";
		mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) > 0 )
		{
			setcookie('alert','alert-success',time()+4,'/');
			setcookie('update','Story Deleted Successfully.',time()+4,'/');
			setcookie('userid',$userid,time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
		else
		{
			setcookie('alert','alert-danger',time()+4,'/');
			setcookie('update','Story not Deleted Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
	}
	else
	{
		setcookie('alert','alert-warning',time()+4,'/');
		setcookie('update','Sorry!Story not found.',time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
	}
}
?>