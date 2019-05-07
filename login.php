<!-- Modal -->
	<div id="login" class="modal fade in" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h2 class="modal-title text-center text-primary"><strong>SING IN FORM</strong>
	        </h2>
	      </div>
	      <div class="modal-body">
	      		<form method="post" id="login_form">
					<div class="alert alert-danger text-center" id="login_error" style="display: none;">
					</div>
					<div class="text-center" id="user_login_preloader"></div>
					<div class="text-center" id="login_done"></div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" name="login_uname" id="login_uname" class="form-control" placeholder="User Name" maxlength="12" minlength="6" autofocus>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" name="login_pwd" id="login_pwd" class="form-control" placeholder="Password" maxlength="12" minlength="6">
					</div>
					<br>
					<div class="row">
						<div class="col-sm-offset-3">
							<button type="submit" id="login_submit" class="btn btn-primary">Login</button>
							<button type="reset" class="btn btn-danger">Reset</button>
							<span><strong>For New User. <a href="home.php" style="color: blue;">Click Here.</a></strong></span>
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
	<script type="text/javascript" src="js/login.js"></script>
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			$('#login').modal('show');
		});
	</script> -->
