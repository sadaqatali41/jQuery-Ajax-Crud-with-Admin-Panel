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
$con 	= mysqli_connect('localhost','root','','jquery_ajax_crud');
$sql 	= "SELECT * FROM contact_us WHERE status = 1";
$result = mysqli_query($con,$sql);
?>
<?php include 'admin_change_password_form.php'; ?>
<!-- cookies value starts here -->
<?php if(isset($_COOKIE['alert'])) : ?>
<div id="sms" class="alert <?php echo $_COOKIE['alert'] ?> alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $_COOKIE['sms'] ?></strong>
	<?php if(isset($_COOKIE['undo_id'])) : ?>
		<a href="http://localhost/jquery_ajax_crud/admin/admin-delete-contact-undo/<?php echo $_COOKIE['undo_id'] ?>" class="pull-right">Undo</a>
	<?php endif; ?>
</div>
<?php endif; ?>
<!-- cookies values ends here -->
<h1 class="text-center"><i class="fa fa-users"></i> Contact Us List</h1>
<div class="col-md-12 col-xs-12 text-center table-responsive">
	<table class="table table-bordered bg-warning">
		<thead>
			<tr class="success">
				<th>Serial No.</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Message</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $counter = 1; ?>
			<?php if(mysqli_num_rows($result) > 0 ): ?>
				<?php while($row = mysqli_fetch_object($result)): ?>
					<tr>
						<td><?php echo $counter++ ?></td>
						<td><?php echo ucwords($row->name); ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->mobile; ?></td>
						<td><?php echo $row->message; ?></td>
						<td><?php echo $row->created_date; ?></td>
						<td>
							<div class="btn-group">
								<?php if($_SESSION['role'] == 'major') : ?> 
								<a href="http://localhost/jquery_ajax_crud/admin/admin-delete-contact/<?php echo $row->id ?>" class="btn btn-danger btn-xs" onclick="return del_func()"><i class="fa fa-trash-o"></i> Delete</a>
								<?php else: ?>
								<a href="javascript:void(0)" class="btn btn-danger btn-xs" disabled><i class="fa fa-trash-o"></i> Delete</a>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				<?php endwhile; ?>
			<?php else: ?>
				<tr class="danger">
					<th colspan="7">Sorry! Data not found.</th>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="../js/admin/change_password.js"></script>
<script type="text/javascript">
	function del_func()
	{
		if(confirm('Do you want to delete this admin?'))
			return true;
		else
			return false;
	}
</script>
<?php include '../head-foot/footer.php'; ?>