<?php include '../head-foot/header.php'; ?>
<?php 
	date_default_timezone_set('Asia/kolkata');
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
	if(isset($_POST['submit']))
	{
		$fname 	= filterData($_POST['fname']);
		$uname 	= filterData($_POST['uname']);
		$pwd 	= filterData($_POST['pwd']);
		$date 	= date('Y-m-d H:i:s');

		$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
		$sql 	= "INSERT INTO admin(fname,uname,pwd,created_date) 
					VALUES('$fname','$uname','$pwd','$date')";
		mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) > 0 )
		{
			setcookie('alert','alert-success',time()+4,'/');
			setcookie('sms','Admin Created Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/admin-list');
		}
		else
		{
			setcookie('alert','alert-danger',time()+4,'/');
			setcookie('sms','Sorry! Admin not Created.',time()+4,'/');
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
 	<h1 class="text-center"><i class="fa fa-user"></i> Create Admin</h1>
 	<div class="col-md-offset-3 col-md-6 col-xs-12 text-center">
	 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		    <input id="fname" type="text" class="form-control" name="fname" placeholder="Enter Full Name" required>
		  </div>
		  <br>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		    <input id="uname" type="text" class="form-control" name="uname" placeholder="Enter User Name" required>
		  </div>
		  <span id="uname_error"></span>
		  <br>
		  <div class="input-group">
		    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		    <input id="pwd" type="password" class="form-control" name="pwd" placeholder="Enter Password" required>
		  </div>
		  <span id="pwd_error"></span>
		  <br>
		  <input type="submit" id="submit" name="submit" value="Create Admin" class="btn btn-success pull-right">
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

		$('#submit').click(function(){

			pwd_error = true;

			validate_password();

			if(pwd_error)
				return true;
			else
				return false;	
		});

		$('#uname').keyup(function(){
			var uname = $(this).val();
			if(uname != '')
			{
				if(uname.length > 7)
				{
					$.ajax({

					url: "http://localhost/jquery_ajax_crud/admin/check_admin_uname.php",
					type: "POST",
					data: {uname:uname},
					dataType: "json",
					success:function(data)
					{
						if(data.status == 'no')
						{
							$('#uname_error').html(data.sms);
							$('#submit').attr('disabled',true);
						}
						else
						{
							$('#uname_error').html(data.sms);
							$('#submit').removeAttr('disabled');
						}
					},
					error: function(error)
					{
						console.log(error);
					}
				});
				}
				else
				{
					$('#uname_error').html('**User Name should be greater than 7 characters**');
					$('#uname_error').css('color','red');
					return false;
				}
			}
			else
			{
				$('#uname_error').html('**User Name is Required**');
				$('#uname_error').css('color','red');
				return false;
			}
		});
	});
</script>
<?php include '../head-foot/footer.php'; ?>