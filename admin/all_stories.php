<?php include '../head-foot/header.php'; ?>
<style type="text/css">
	div#sms{
		width: 24%;
		position: fixed;
		left: 1%;
		top: 91%;
	}
</style>
<?php 
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
	$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
	$query = "SELECT crud.fname,crud.image_path,crud.id AS crud_userid, story.* FROM crud LEFT JOIN story ON story.userid = crud.id WHERE story.status = 1";
	$result = mysqli_query($con,$query);
 ?>

<!-- cookies value starts here -->
<?php if(isset($_COOKIE['alert'])) : ?>
<div id="sms" class="alert <?php echo $_COOKIE['alert'] ?> alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $_COOKIE['update'] ?></strong>
	<?php if(isset($_COOKIE['userid'])) : ?>
		<a href="http://localhost/jquery_ajax_crud/admin/admin_story_undo/<?php echo $_COOKIE['userid'] ?>" class="pull-right">Undo</a>
	<?php endif; ?>
</div>
<?php endif; ?>
<!-- cookies values ends here -->
<div class="table-responsive">
	<h2 class="text-center"><i class="fa fa-history"></i> All User Stories</h2>
	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>Serial No.</th>
				<th>User Name</th>
				<th>Story</th>
				<th>Images</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $counter = 1; ?>
			<?php if(mysqli_num_rows($result) > 0 ) : ?>
				<?php while($row = mysqli_fetch_object($result)) : ?>
					<tr>
						<td><?php echo $counter++ ?></td>
						<td><?php echo ucwords($row->fname); ?></td>
						<td style="width: 40%;">
							<?php if($row->story != ''): ?>
								<?php echo $row->story; ?>
							<?php else: ?>
								Story not found
							<?php endif; ?>
						</td>
						<td>
							<a href="javascript:void(0)">
								<img src="../<?php echo $row->image_path ?>" width="65" height="65" class="img-rounded" alt="<?php echo ucwords($row->fname) ?>">
							</a>
						</td>
						<td>
							<?php if($row->created_date != ''): ?>
								<?php echo $row->created_date; ?>
							<?php else: ?>
								Not Created yet
							<?php endif; ?>
						</td>
						<td>
							<div class="btn-group">
								<a href="http://localhost/jquery_ajax_crud/admin/admin_edit_story/<?php echo $row->crud_userid ?>" class="btn btn-info btn-md" title="EDIT"><i class="fa fa-edit"></i></a>
								<?php if($_SESSION['role'] == 'major') : ?>
								<a href="http://localhost/jquery_ajax_crud/admin/admin_delete_story/<?php echo $row->crud_userid ?>" class="btn btn-danger btn-md" title="DELETE" onclick="return del_func()"><i class="fa fa-trash-o"></i></a>
								<?php else: ?>
								<a href="javascript:void(0)" class="btn btn-danger btn-md" title="DELETE" disabled><i class="fa fa-trash-o"></i></a>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				<?php endwhile; ?>
			<?php else: ?>
				<tr class="danger">
					<th colspan="6">Sorry! data not found.</th>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php include 'admin_change_password_form.php'; ?>

<!-- image popup starts -->
<div id="image_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="" id="image_show" width="100%" height="100%" class="img-thumbnail">
      </div>
    </div>
  </div>
</div>
<!-- image popup ends -->
<script type="text/javascript" src="../js/admin/change_password.js"></script>
<?php include '../head-foot/footer.php'; ?>
<script type="text/javascript">
	$(window).on('load',function(){
		$('img').click(function(){
			var src 	= $(this).attr('src');
			var title 	= $(this).attr('alt');
			$('.modal-title').html('<em>'+title+'</em>');
			$('#image_show').attr('src',src);
			$('#image_modal').modal({
				backdrop: 'static',
				keyboard: false,
				show: true
			});
		});
	});

	function del_func()
	{
		if(confirm('Do you want to delete this story?'))
			return true;
		else
			return false;
	}
</script>