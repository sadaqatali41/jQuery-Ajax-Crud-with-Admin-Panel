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
		$fpath = '';
		if(!empty($_FILES['file']['name']))
		{
			$fname = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$ftype = $_FILES['file']['type'];
			$fpath = 'article_photos/'.substr(time().'_'.$fname, 10);
			$udate = date('Y-m-d H:i:s');

			if($ftype == "image/jpeg" || $ftype == "image/gif" || $ftype == "image/png" || $ftype == "image/jpg")
			{
				if(move_uploaded_file($tmp_name, "../".$fpath))
				{
					$message = "<p class='alert alert-success text-center'><strong>Article Updated Successfully.</strong></p>";
				}
				else
				{
					$message = "<p class='alert alert-danger text-center'><strong>Article not Updated Successfully.</strong></p>";
				}
			}
			else
			{
				$message = "<p class='alert alert-danger text-center'><strong>Invalid File Type.</strong></p>";
			}
		}
		$userid 	= strip_tags(addslashes($_POST['userid']));
		$article_id = strip_tags(addslashes($_POST['article_id']));
		$title 		= strip_tags(addslashes($_POST['title']));
		$desc 		= strip_tags(addslashes($_POST['desc']));
		$updated_date = date('Y-m-d H:i:s');

		if(!empty($fpath))
		{
			$query = "UPDATE articles SET title = '$title',body = '$desc',image_path = '$fpath',updated_date = '$updated_date' WHERE userid = '$userid' AND id = '$article_id'";
		}
		else
		{
			$query ="UPDATE articles SET title = '$title',body = '$desc',updated_date = '$updated_date' WHERE userid = '$userid' AND id = '$article_id'";
		}
		mysqli_query($con,$query);

		if(mysqli_affected_rows($con) == 1)
		{
			$message = "<p class='alert alert-success text-center'><strong>Article Updated Successfully.</strong></p>";
		}
		else
		{
			$message = "<p class='alert alert-danger text-center'><strong>Article not Updated Successfully.</strong></p> {".mysql_error($con)."}";
		}
		echo $message;
	}

 ?>