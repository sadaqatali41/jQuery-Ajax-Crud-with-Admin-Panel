<?php
session_start(); 
date_default_timezone_set('Asia/kolkata');
if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
{
	header('location:http://localhost/jquery_ajax_crud/home');
	exit();
}
$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');

if(isset($_GET['undo_id']))
{
	$id 	= $_GET['undo_id'];
	$date 	= date('Y-m-d H:i:s');
	$sql	= "UPDATE contact_us SET status = 1, updated_date = '$date' WHERE id = '$id'";
	mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) > 0)
	{
		setcookie('alert','alert-success',time()+4,'/');
		setcookie('sms','Action rollbacked successfully.',time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/contacts');
	}
	else
	{
		setcookie('alert','alert-danger',time()+4,'/');
		setcookie('sms','Action not rollbacked successfully.',time()+4,'/');
		header('location:http://localhost/jquery_ajax_crud/admin/contacts');
	}
}
?>