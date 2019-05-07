<!-- change password modal starts -->
<div id="change_password" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center text-primary"><em>Admin Change Password</em></h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
		  <div class="form-group">
		    <label for="old_pwd">Old Password:</label>
		    <input type="password" class="form-control" id="old_pwd" name="old_pwd" placeholder="Enter Old Password" required autofocus="on">
		    <span id="old_pwd_error"></span>
		  </div>
		  <div class="form-group">
		    <label for="new_pwd">New Password:</label>
		    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Enter New Password" required>
		    <span id="new_pwd_error"></span>
		  </div>
		  <div class="form-group">
		    <label for="con_pwd">Confirm Password:</label>
		    <input type="password" class="form-control" id="con_pwd" name="con_pwd" placeholder="Enter Confirm Password" required>
		    <span id="con_pwd_error"></span>
		  </div>
		  <input type="submit" class="btn btn-success" id="update" value="Update Password">
		</form>
      </div>
    </div>
  </div>
</div>
<!-- channge password modal ends -->