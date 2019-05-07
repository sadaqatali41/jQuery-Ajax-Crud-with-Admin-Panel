<?php include 'head-foot/header.php'; ?>
<style type="text/css">
	div#sms{
		width: 24%;
		position: fixed;
		left: 1%;
		top: 91%;
		z-index: 99;
	}
</style>
<?php 
date_default_timezone_set('Asia/kolkata');
if(isset($_POST['submit']))
{
	$name 		= filterData($_POST['name']);
	$email 		= filterData($_POST['email']);
	$mobile 	= filterData($_POST['mobile']);
	$desc 		= filterData($_POST['message']);
	$date 		= date('Y-m-d H:i:s');
	$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
	$sql = "INSERT INTO contact_us(name, email, mobile, message, created_date) VALUES('$name','$email','$mobile','$desc','$date')";
	mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) > 0 )
	{
		setcookie('alert','alert-success',time()+4,'/');
		setcookie('sms','Thnaks, we will reach you soon.',time()+4,'/');
	}
	else
	{
		setcookie('alert','alert-danger',time()+4,'/');
		setcookie('sms','Problem occured, please try again.',time()+4,'/');
	}
	header('location:http://localhost/jquery_ajax_crud/contact-us');
}
function filterData($data)
{
	$data = trim($data);
	$data = addslashes($data);
	$data = strip_tags($data);
	return $data;
}

 ?>
<!-- cookies value starts here -->
<?php if(isset($_COOKIE['alert'])) : ?>
<div id="sms" class="alert <?php echo $_COOKIE['alert'] ?> alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $_COOKIE['sms'] ?></strong>
</div>
<?php endif; ?>
<!-- cookies values ends here -->
<h1 class="text-center"><i class="fa fa-phone"></i> Contact Us</h1>
<div class="row">
	<div class="col-sm-6">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
			</div>
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
			</div>
			<div class="form-group">
				<label for="mobile">Mobile Number:</label>
				<input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
			</div>
			<div class="form-group">
				<label for="message">Description:</label>
				<textarea name="message" class="form-control" rows="6" placeholder="Enter Message" style="resize: none;" required></textarea>
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</form>
	</div>
	<div class="col-sm-6">
		<h4>Location ETA</h4>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15229.420897934424!2d78.44304369999999!3d17.394732199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb971f00000001%3A0xaec5635e880feae6!2sMasjid-e-Azizia!5e0!3m2!1sen!2sin!4v1556562054893!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-12">
		<h4>Direction ETA</h4>
		<iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d30455.280955020266!2d78.43609013099535!3d17.416100534346782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3bcb90cf112f2597%3A0x645326ea2ab31d1b!2sAmeerpet+Metro+Station%2C+Sai+Sarathi+Nagar%2C+Ameerpet%2C+Hyderabad%2C+Telangana!3m2!1d17.435788199999998!2d78.4445612!4m5!1s0x3bcb971f00000001%3A0xaec5635e880feae6!2sMasjid-e-Azizia%2C+MEHDIPATNAM%2C+Royal+Colony%2C+Humayun+Nagar%2C+Hyderabad%2C+Telangana+500264!3m2!1d17.3959694!2d78.4428987!5e0!3m2!1sen!2sin!4v1556562487028!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
</div>
<?php include 'head-foot/footer.php'; ?>