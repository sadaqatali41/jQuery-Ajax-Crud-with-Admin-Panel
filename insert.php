<?php 
date_default_timezone_set('asia/kolkata');
	if($_FILES['file']['name'] != '')
	{
		$full_name = $_POST['full_name'];
		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$cdate = date('Y-m-d H:i:s');
//echo $_FILES['file']['name'];

		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			$image_name = $_FILES['file']['name'];
			$image_tmp_name = $_FILES['file']['tmp_name'];
			$new_image_name = time().'_'.$image_name;
			$image_path = "images/".$new_image_name;
			$image_type = $_FILES['file']['type'];

			if($image_type == "image/jpeg" || $image_type == "image/gif" || $image_type == "image/png" || $image_type == "image/jpg")
			{
				if(move_uploaded_file($image_tmp_name, $image_path))
				{
					$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
					mysqli_query($con,"INSERT INTO crud(fname,uname,pwd,mobile,email,created_date,gender,image_path) VALUES('$full_name','$uname','$pwd','$mobile','$email','$cdate','$gender','$image_path')");
					if(mysqli_affected_rows($con) > 0)
					{
						echo "<p class='alert alert-success'>Your Account Created Successfully. Wait for Your Account Activation by Admin.</p>";
					}
					else
					{
						echo "<p class='alert alert-danger'>Data not Inserted. Please try again.</p>";
					}
				}
				else
				{
					echo "<p class='alert alert-danger'>File not Uplo Successfully.</p>";
				}
			}
			else
			{
				echo "<p class='alert alert-danger'>Invalid File Format.</p>";
			}
		}
		else
		{
			echo "<p class='alert alert-danger'>Please Select File</p>";
		}
	}

 ?>