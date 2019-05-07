<?php 
	session_start();
	date_default_timezone_set('Asia/kolkata');

	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");

	if(!isset($_SESSION['userid']) && !isset($_SESSION['username']))
	{
		$data = array(
			'status'		=> 'failed',
			'message'		=> '<p style="color:red;">Unauthorised user</p>',
		);
	}
	elseif($_POST['action'] == 'story')
	{
		$userid 	= $_SESSION['userid'];
		$username 	= $_SESSION['username'];
		
		$data = get_data($userid);	

	}
	elseif($_POST['action'] == 'update')
	{
		$userid 	= $_SESSION['userid'];
		$username 	= $_SESSION['username'];
		$story 		= $_POST['story'];
		$update 	= date('Y-m-d H:i:s');

		$query = "SELECT * FROM story WHERE userid = '$userid'";

		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0 )
		{
			$query = "UPDATE story SET story = '$story', updated_date = '$update' WHERE userid = '$userid'";
		}
		else
		{
			$query = "INSERT INTO story(userid,story,created_date) VALUES('$userid','$story','$update')";
		}
		
		mysqli_query($con,$query);
		
		if(mysqli_affected_rows($con) > 0 )
		{
			// Now get updated record
			$data = get_data($userid);
		}
		else
		{
			$data = array(
				'status'		=> 'failed',
				'message'		=> '<p style="color:red;">Some problem occured</p>'
			);
		}

	}
	else
	{
		$data = array(
			'status'		=> 'failed',
			'message'		=> 'No Action Performed'
		);
	}

	echo json_encode($data);

	function get_data($userid)
	{
		$query 	= "SELECT * FROM story WHERE userid = '".$userid."'";
		$result = mysqli_query($GLOBALS['con'],$query);

		if(mysqli_num_rows($result) > 0 )
		{
			$row = mysqli_fetch_array($result);

			$data = array(
				'status'		=> 'success',
				'message'		=> $row['story'],
				'display_sms'	=> '<p style="color:green;">Data updated successfully</p>'
				);
		}
		else
		{
			$data = array(
				'status'		=> 'not_found',
				'message'		=> 'Write something about you which is special for you.'
			);
		}

		return $data;
	}

 ?>