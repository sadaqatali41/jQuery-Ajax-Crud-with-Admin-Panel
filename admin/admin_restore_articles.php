<?php 
	$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
	session_start();
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}

	if(isset($_POST['action']) && $_POST['action'] == 'restore')
	{
		$id 	= $_POST['id'];
		$userid = $_POST['userid'];

		$query = "INSERT INTO articles(id,userid,title,body,image_path,created_date,updated_date) SELECT id,userid,title,body,image_path,created_date,updated_date FROM delete_articles WHERE id = '$id' AND userid = '$userid'";
		mysqli_query($con,$query);
		if(mysqli_affected_rows($con) > 0 )
		{
			$sms = "Article Restored";
		}
		else
		{
			$sms = "Restored Error:-".mysqli_error($con);
		}

		$query = "DELETE FROM delete_articles WHERE id = '$id' AND userid = '$userid'";
		mysqli_query($con,$query);
		if(mysqli_affected_rows($con) > 0 )
		{
			$sms .= " AND Deleted Successfully.";
		}
		else
		{
			$sms .= "<br>Deleted Error:-".mysqli_error($con);
		}
		echo $sms;
		mysqli_close($con);
	}
	if(isset($_POST['action']) && $_POST['action'] == 'delete')
	{
		$id 	= $_POST['id'];
		$userid = $_POST['userid'];

		$query = "DELETE FROM delete_articles WHERE id = '$id' AND userid = '$userid'";
		mysqli_query($con,$query);
		if(mysqli_affected_rows($con) > 0 )
		{
			$sms = "Article Permanently Deleted Successfully.";
		}
		else
		{
			$sms = "Deleted Error:-".mysqli_error($con);
		}
		echo $sms;
		mysqli_close($con);
	}
?>
