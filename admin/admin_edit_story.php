<?php include '../head-foot/header.php'; ?>
<?php
date_default_timezone_set('Asia/kolkata');
$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
	if(isset($_POST['update_story']))
	{
		$date 	= date('Y-m-d H:i:s');
		$userid = $_POST['userid'];
		$story 	= strip_tags(addslashes(trim($_POST['story'])));
		$sql 	= "SELECT * FROM story WHERE userid = '".$userid."'";
		$result	= mysqli_query($con,$sql);
		if(mysqli_num_rows($result) > 0 )
			$sql = "UPDATE story SET story = '".$story."',updated_date = '".$date."' WHERE userid = '".$userid."'";
		else
			$sql = "INSERT INTO story(userid,story,created_date) VALUES('$userid','$story','$date')";
		mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) > 0 )
		{
			setcookie('alert','alert-success',time()+4,'/');
			setcookie('update','Story Updated Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
		else
		{
			setcookie('alert','alert-danger',time()+4,'/');
			setcookie('update','Story not Updated Successfully.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		}
	} 
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
	if(isset($_GET['id']))
	{
		$userid 	= $_GET['id'];
		$query 		= "SELECT story FROM story WHERE userid = '".$userid."'";
		$result 	= mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0 )
		{
			$row 	= mysqli_fetch_object($result);
			$story	= $row->story;
		}
		else
			$story 	= "";
	}
?>
<div style="width: 50%;margin: auto;">
	<?php if(!empty($story)) : ?>
	<form action="" method="post">
	  <div class="form-group">
	    <label for="story">Your Story:</label>
	    <textarea style="resize: none;" class="form-control" rows="10" id="story" name="story" required placeholder="Write Something about you.." maxlength="500"><?php echo $story ?></textarea>
	    <input type="hidden" name="userid" value="<?php echo $userid ?>">
	  </div>
	  <div class="form-group">
	  	<label id="char_remaining"></label>
	  </div>
	  <input type="submit" name="update_story" value="Update" class="btn btn-info">
	</form>
	<?php else: ?>
		<?php 
			setcookie('alert','alert-warning',time()+4,'/');
			setcookie('update','Sorry! Story not Found.',time()+4,'/');
			header('location:http://localhost/jquery_ajax_crud/admin/all_stories');
		 ?>
	<?php endif; ?>
</div>

<?php include 'admin_change_password_form.php'; ?>

<script type="text/javascript" src="../js/admin/change_password.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('textarea#story').keyup(function(){
			if(($(this).val().length) > 500)
			{
				return false;
			}
			else
			{
				$('#char_remaining').text('Remaining Characters : '+(500-$(this).val().length));
			}
		});
	});
</script>
<?php include '../head-foot/footer.php'; ?>