<?php 
	if(!empty($_POST['action']))
	{
		?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <table class="table table-bordered">
	<thead>
		<tr class="warning">
			<th>Serial No.</th>
			<th>Full Name</th>
			<th>User Name</th>
			<th>Mobile No.</th>
			<th>Email Address</th>
			<th>DateTime</th>
			<th>Gender</th>
			<th>Image</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$counter = 1;
		$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
		$result = mysqli_query($con,"SELECT * FROM crud ORDER BY created_date DESC");
		if(mysqli_num_rows($result) > 0 )
		{
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr>
					<th><?php echo $counter++ ?></th>
					<th><?php echo ucwords($row['fname']); ?></th>
					<th><?php echo ucfirst($row['uname']); ?></th>
					<th><?php echo $row['mobile']; ?></th>
					<th><?php echo $row['email']; ?></th>
					<th><?php echo $row['created_date']; ?></th>
					<th><?php echo ucfirst($row['gender']); ?></th>
					<th>
						<?php if($row['image_path'] != '') : ?>
						<a href="#pic_<?php echo $row['id']; ?>" data-toggle="modal"><img src="../<?php echo $row['image_path']; ?>" class='img-circle' width='65' height='65'></a>
						<?php else : ?>
							No Image
						<?php endif; ?>
					</th>
					<th>
						<?php if($row['status'] == 0) : ?>
						<a class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Inactive</a>
						<?php else : ?>
						<a class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active</a>
						<?php endif; ?>
					</th>
					<th>
					<a id="<?php echo $row['id'];?>" user_status="<?php echo $row['status'];?>" class="btn btn-info btn-xs status"><i class="fa fa-cogs"></i> Action</a>	
					</th>
				</tr>
				<div class="modal fade" id="pic_<?php echo $row['id']; ?>" role="dialog">
						    <div class="modal-dialog modal-sm">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title"><?php echo ucwords($row['fname']); ?> <i style="color: red;">Photo</i>
						          </h4>
						        </div>
						        <div class="modal-body">
						          <img src="../<?php echo $row['image_path']; ?>" width="260" height="200" class="img-thumbnail">
						        </div>
						      </div>
						    </div>
						</div>
				<?php
			}
		}
		else
		{
			?>
			<tr class="warning">
				<th colspan="10">Data not Found</th>
			</tr>
			<?php
		}

	?>
	</tbody>
</table>
		<?php
	}

	if(isset($_POST['action1']))
	{
		$user_id = $_POST['user_id'];
		$user_status = $_POST['user_status'];
		
		if($user_status == 0)
		{
			$user_status = 1;
		}
		else
		{
			$user_status = 0;
		}

		$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
		mysqli_query($con,"UPDATE crud SET status = '$user_status' WHERE id = '$user_id'");
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<p class='alert alert-success'><strong>Status For This User is Changed Successfully.</strong></p>";
		}
		else
		{
			echo "<p class='alert alert-danger'><strong>Status not Changed Successfully.</strong></p>";
		}
	}

 ?>
 