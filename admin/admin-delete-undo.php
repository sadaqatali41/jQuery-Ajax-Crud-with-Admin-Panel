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
	$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
	$sql 	= "UPDATE admin SET status = 1 WHERE id = '".$adminid."'";
	mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) > 0)
	{
		setcookie('alert','alert-success',time()+4,'/');
		setcookie('sms','Action undone successfully.',time()+4,'/');
	}
	else
	{
		setcookie('alert','alert-danger',time()+4,'/');
		setcookie('sms','Action not rollbacked.',time()+4,'/');
	}
	header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
}