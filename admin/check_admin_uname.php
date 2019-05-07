<?php 
	$uname = $_POST['uname'];
	$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
	$result = mysqli_query($con,"SELECT * FROM admin WHERE uname = '".$uname."'");
	if(mysqli_num_rows($result) > 0 )
	{
		$data = array(
			'status'	=> 'no',
			'sms'		=> '<span style="color:red;font-weight:bold;">This User Name is already exists</span>'
		);
	}
	else
	{
		$data = array(
			'status'	=> 'yes',
			'sms'		=> '<span style="color:green;font-weight:bold;">This User Name is available</span>'
		);
	}
	echo json_encode($data);

 ?>