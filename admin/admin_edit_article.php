<?php 
session_start();

if(isset($_POST['article_id']))
{
	$user_id = $_POST['userid'];
	$article_id = $_POST['article_id'];
	$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
	$result = mysqli_query($con,"SELECT * FROM articles WHERE userid = '$user_id' AND id = '$article_id'");
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
		echo json_encode($row);
	}
	else
	{
		echo json_encode("no");
	}
}
else
{
	header('location:http://localhost/jquery_ajax_crud/admin/dashboard.php');
	exit();
}

 ?>