<?php 
// for user name
if(isset($_POST['uname']))
{
	$uname = $_POST['uname'];

	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con, "SELECT * FROM crud WHERE uname = '$uname'");

	if(mysqli_num_rows($result) == 1)
	{
		echo "ok";
	}
}

// for mobile number
if(isset($_POST['mobile']))
{
	$mobile = $_POST['mobile'];

	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con, "SELECT * FROM crud WHERE mobile = '$mobile'");
	mysqli_close($con);

	if(mysqli_num_rows($result) == 1)
	{
		echo "ok";
	}
}

// for email address
if(isset($_POST['email']))
{
	$email = $_POST['email'];

	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$result = mysqli_query($con, "SELECT * FROM crud WHERE email = '$email'");
	mysqli_close($con);

	if(mysqli_num_rows($result) == 1)
	{
		echo "ok";
	}
}


 ?>