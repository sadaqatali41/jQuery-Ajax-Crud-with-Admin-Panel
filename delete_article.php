<?php 
session_start();
if(!isset($_POST['article_id']))
{
	header('location:http://localhost/jquery_ajax_crud/home');
	exit();
}
else
{
	$article_id = $_POST['article_id'];
	$user_id = $_SESSION['userid'];
	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con,"SELECT * FROM articles WHERE userid = '$user_id' AND id = '$article_id'");
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$query = "INSERT INTO delete_articles(id,userid,title,body,image_path,created_date,updated_date) SELECT id,userid,title,body,image_path,created_date,updated_date FROM articles WHERE userid = '$user_id' AND id = '$article_id'";
		mysqli_query($con,$query);
		//unlink($row['image_path']);
		mysqli_query($con,"DELETE FROM articles WHERE userid = '$user_id' AND id = '$article_id'");
		if(mysqli_affected_rows($con) > 0)
		{
			echo "OK";
		}
		else
		{
			echo "NOT";
		}
	}
	else
	{
		echo "ARTILCE-NOT-FOUND";
	}
}

 ?>