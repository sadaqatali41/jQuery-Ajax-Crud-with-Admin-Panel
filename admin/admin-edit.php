<?php include '../head-foot/header.php'; ?>
<?php 
	date_default_timezone_set('Asia/kolkata');
	$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
	if(isset($_SESSION['role']) && $_SESSION['role'] != 'major')
	{
		header('location:http://localhost/jquery_ajax_crud/admin/dashboard');
	}
	if(isset($_GET['adminid']))
	{
		$adminid = $_GET['adminid'];
		$result = mysqli_query($con,"SELECT * FROM admin WHERE id = '".$adminid."'");
		if(mysqli_num_rows($result) > 0 )
		{
			$row = mysqli_fetch_object($result);
		}
		else
		{
			setcookie('alert','alert-warning',time()+4,'/');
			setcookie('sms','Sorry! Admin not Found.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
		}
	}
	if(isset($_POST['update_admin']))
	{
		if($_GET['adminid'] == 1)
		{
			setcookie('alert','alert-warning',time()+4,'/');
			setcookie('sms','Sorry! you can not change main admin.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
			exit;
		}

		$fname 	= filterData($_POST['fname']);
		$uname 	= filterData($_POST['uname']);
		$pwd 	= filterData($_POST['pwd']);
		$role 	= filterData($_POST['role']);
		$date 	= date('Y-m-d H:i:s');
		$adminid= $_GET['adminid'];

		$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
		$sql 	= "UPDATE admin SET fname = '$fname', uname = '$uname', pwd = '$pwd', role = '$role', updated_date = '$date' WHERE id = '$adminid'";
		mysqli_query($con,$sql);

		if(mysqli_affected_rows($con) > 0 )
		{
			setcookie('alert','alert-success',time()+4,'/');
			setcookie('sms','Admin Updated Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
		}
		else
		{
			setcookie('alert','alert-danger',time()+4,'/');
			setcookie('sms','Sorry! Admin not Updated.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
		}
	}
	function filterData($data)
	{
		$data = trim($data);
		$data = addslashes($data);
		$data = strip_tags($data);
		return $data;
	}
 ?>
 <?php include 'admin_change_password_form.php'; ?>
 <div class="row">
 	<h1 class="text-info text-center"><i class="fa fa-edit"></i> Edit Admin</h1>
 	<div class="col-md-offset-3 col-md-6 col-xs-12 text-center">
	 	<form method="post" action="">
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		    <input id="fname" type="text" class="form-control" name="fname" placeholder="Enter Full Name" required value="<?php echo $row->fname ?>">
		  </div>
		  <br>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		    <input id="uname" type="text" class="form-control" name="uname" placeholder="Enter User Name" required readonly value="<?php echo $row->uname; ?>">
		  </div>
		  <br>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    <input id="pwd" type="password" class="form-control" name="pwd" placeholder="Enter Password" required value="<?php echo $row->pwd; ?>">
		  </div>
		  <span id="pwd_error"></span>
		  <br>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="fa fa-users"></i></span>
		    <select name="role" required class="form-control">
		    	<option value="" selected disabled>Select Role</option>
		    	<option value="major" <?php echo($row->role=='major'?'selected':'') ?>>Major</option>
		    	<option value="minor" <?php echo($row->role=='minor'?'selected':'') ?>>Minor</option>
		    </select>
		  </div>
		  <br>
		  <input type="submit" id="update_admin" name="update_admin" value="Update Admin" class="btn btn-success pull-right">
		</form>
	</div>
 </div>
<script type="text/javascript" src="../js/admin/change_password.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var patt=/["!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"]/;

		$('#pwd_error').hide();

		var pwd_error = true;
			$('#pwd').keyup(function(){
			validate_password();
		});

		function validate_password()
		{
			var password_admin = $('#pwd').val();

			if(password_admin.length == '')
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Password is Required.");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;

			}
			else if((password_admin.length < 8 ) || (password_admin.length > 15 ) )
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Password Must be <b>Between 8 and 15</b>**");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;
			}
			else if(!patt.test(password_admin))
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Please use Atleast <b>One Special</b> Characters.**");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;
			}
			else if(!/[0-9]/.test(password_admin))
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Please use Atleast <b>One Number [0-9]</b> in Password.**");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;
			}
			else if(!/[a-z]/.test(password_admin))
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Please use Atleast <b>One lowercase Letter [a-z]</b> in Password.**");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;
			}
			else if(!/[A-Z]/.test(password_admin))
			{
				$('#pwd_error').show();
				$('#pwd_error').html("**Please use Atleast <b>One UPPERCASE Letter [A-Z]</b> in Password.**");
				$('#pwd').focus();
				$('#pwd_error').css("color","red");
				pwd_error = false;
				return false;
			}
			else
			{
				$('#pwd_error').hide();
			}
		}

		$('#update_admin').click(function(){

			pwd_error = true;

			validate_password();

			if(pwd_error)
				return true;
			else
				return false;	
		});
	});
</script>
<?php include '../head-foot/footer.php'; ?>