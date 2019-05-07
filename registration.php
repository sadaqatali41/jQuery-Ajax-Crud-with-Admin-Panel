<?php //include 'head-foot/header.php'; ?>
<div id="registration" class="modal fade" role="dialog">
	<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title text-center text-primary"><strong>SIGN UP FORM</strong></h2>
		      </div>
		      <div class="modal-body">
					<form method="post" id="datas" enctype="multipart/form-data">
						<div class="alert alert-danger text-center" id="error" style="display: none;">
						</div>
						<div class="text-center" id="user_regis_preloader"></div>
						<div class="text-center" id="done"></div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" maxlength="20" minlength="2"autofocus>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="uname" id="uname" class="form-control" placeholder="User Name" maxlength="12" minlength="6">
						</div>
						<span id="uname_error" class="alert alert-danger" style="display: none;"></span>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" maxlength="12" minlength="6">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="password" name="cpwd" id="cpwd" class="form-control" placeholder="Confirm Password" maxlength="12" minlength="6">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" maxlength="10" minlength="10">
						</div>
						<span id="mobile_error" class="alert alert-danger" style="display: none;"></span>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
							<input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
						</div>
						<span id="email_error" class="alert alert-danger" style="display: none;"></span>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-group"></i></span>
							<select name="gender" class="form-control" id="gender">
								<option value="">Select Gender</option>
								<option value="male">Male</option>
								<option class="female">Female</option>
								<option class="others">Others</option>
							</select>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-image"></i></span>
							<input type="file" name="file" id="file" class="form-control">
						</div>
						<br>
						<div class="row">
							<div class="col-sm-offset-2">
								<button type="submit" id="submit" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-danger">Reset</button>
								<span><strong>Already Have an Account. <a href="home.php" style="color: blue;">Login Here.</a></strong></span>
							</div>
						</div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
</div>
<script type="text/javascript" src="js/signup.js"></script>
<script type="text/javascript" src="js/uname-email-mobile.js"></script>
<!-- <script type="text/javascript">
		$(document).ready(function(){

			$('#registration').modal('show');
		});
</script> -->
<?php //include 'head-foot/footer.php'; ?>
