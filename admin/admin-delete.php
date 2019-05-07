<?php 
session_start();
date_default_timezone_set('Asia/kolkata');
if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
{
	header('location:http://localhost/jquery_ajax_crud/home');
	exit();
}
if(isset($_GET['adminid']))
{
	$adminid = $_GET['adminid'];
	$date 	 = date('Y-m-d H:i:s');
	if($adminid == 1)
	{
		setcookie('alert','alert-warning',time()+4,'/');
		setcookie('sms','Sorry! you can not delete main admin.',time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
		exit;
	}
	$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
	$sql 	= "UPDATE admin SET status = 0, updated_date = '$date' WHERE id = '".$adminid."'";
	mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) > 0)
	{
		setcookie('alert','alert-success',time()+4,'/');
		setcookie('sms','Admin deleted successfully.',time()+4,'/');
		setcookie('adminid',$adminid,time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
	}
	else
	{
		setcookie('alert','alert-danger',time()+4,'/');
		setcookie('sms','Admin not deleted successfully.',time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
	}
}