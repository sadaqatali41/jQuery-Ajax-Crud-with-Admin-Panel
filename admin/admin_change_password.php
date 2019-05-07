<?php 
	session_start();
	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");

	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		$data = array(
			'status'		=> 'failed',
			'message'		=> '<p style="color:red;font-weight:bold;">Unauthorised user</p>'
		);
	}
	else
	{
		$adminid 	= $_SESSION['adminid'];
		$adminname 	= $_SESSION['adminname'];
		$old_pwd	= $_POST['old_pwd'];
		$new_pwd	= $_POST['new_pwd'];
		$con_pwd	= $_POST['con_pwd'];
		
		// check user old password to database password
		$query 	= "SELECT pwd FROM admin WHERE id = '".$adminid."'";
		$result = mysqli_query($con,$query);
		$row 	= mysqli_fetch_array($result);
		$db_pwd = $row['pwd'];

		if($old_pwd != $db_pwd)
		{
			$data = array(
			'status'		=> 'failed',
			'message'		=> '<p style="color:red;font-weight:bold;">Incorrect old password.</p>'
			);
		}
		elseif($db_pwd == $new_pwd)
		{
			$data = array(
			'status'		=> 'failed',
			'message'		=> '<p style="color:red;font-weight:bold;">Old password and new password can not be same.</p>'
			);
		}
		else
		{
			$query = "UPDATE admin SET pwd = '$new_pwd' WHERE id = '$adminid'";
			mysqli_query($con,$query);
			if(mysqli_affected_rows($con) > 0 )
			{
				$data = array(
				'status'		=> 'success',
				'message'		=> '<p style="color:green;font-weight:bold;">Password updated successfully.</p>'
				);
			}
			else
			{
				$data = array(
				'status'		=> 'failed',
				'message'		=> '<p style="color:red;font-weight:bold;">Password not updated successfully. The error is: '.mysqli_error($con).'</p>'
				);
			}
		}
		mysqli_close($con);
		echo json_encode($data);
	}
// echo json_encode('Success');

 ?>