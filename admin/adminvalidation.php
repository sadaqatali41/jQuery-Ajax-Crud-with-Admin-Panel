<?php 
session_start();

if(isset($_POST['admin_uname']) && isset($_POST['admin_pwd']))
{
	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con, "SELECT * FROM admin WHERE uname = '".$_POST['admin_uname']."' AND pwd = '".$_POST['admin_pwd']."'");
	mysqli_close($con);

	if(mysqli_num_rows($result) == 1)
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['adminid'] 	= $row['id'];
		$_SESSION['adminname'] 	= $row['fname'];
		$_SESSION['role'] 		= $row['role'];

		echo "ok";
	}
	else
	{
		echo "<span class='alert alert-danger'>User Name or Password may be Incorrect.</span>";
	}
}

 ?>