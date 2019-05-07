<?php 
session_start();

if(isset($_POST['login_uname']) && isset($_POST['login_pwd']))
{
	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con, "SELECT * FROM crud WHERE uname = '".$_POST['login_uname']."' AND pwd = '".$_POST['login_pwd']."'");
	mysqli_close($con);

	if(mysqli_num_rows($result) == 1)
	{
		$row  = mysqli_fetch_array($result);
		if($row['status'] == 0)
		{
			echo "<span class='alert alert-danger'>Your Account is not Activated. Please Contact to Admin.</span>";
		}
		else
		{
			$_SESSION['userid'] = $row['id'];
			$_SESSION['username'] = $row['fname'];
			$_SESSION['usermobile'] = $row['mobile'];
			$_SESSION['useremail'] = $row['email'];
			
			echo "done";
		}
	}
	else
	{
		echo "<span class='alert alert-danger'>User Name or Password may be Incorrect.</span>";
	}
}

 ?>