<?php 
session_start();
date_default_timezone_set('asia/kolkata');
$con = mysqli_connect('localhost','root','','jquery_ajax_crud');

	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
	else
	{
		$user_id 	= strip_tags(addslashes($_POST['userid']));
		$article_id = strip_tags(addslashes($_POST['article_id']));

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
				$message = "Article Deleted Successfully.";
			}
			else
			{
				$message = "Article not Deleted Successfully.";
			}
		}
		else
		{
			$message = "Sorry! Article not Found.";
		}
		echo $message;
	}
 ?>