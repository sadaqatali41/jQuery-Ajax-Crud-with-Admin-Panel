<?php include '../head-foot/header.php'; ?>
<?php 
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
 ?>
 <div class="table-responsive">
	<h2 class="text-center"><i class="fa fa-list"></i> Deleted Articles List</h2>
	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>Serial No.</th>
				<th>Title</th>
				<th>Description</th>
				<th>Images</th>
				<th>Created By</th>
				<th>Created AT</th>
				<th>Updated AT</th>
				<th>Deleted AT</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
				$result = mysqli_query($con,"SELECT delete_articles.*, crud.fname FROM delete_articles LEFT JOIN crud ON crud.id = delete_articles.userid");
				$counter = 1;
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $counter++; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td style="width: 22.6%;"><?php echo $row['body']; ?></td>
							<td><a href="#pic_<?php echo $row['id']; ?>" data-toggle="modal"><img src="../<?php echo $row['image_path']; ?>" width='65' height='65' class='img-rounded'></a></td>
							<td><?php echo ucwords($row['fname']); ?></td>
							<td><?php echo ucwords($row['created_date']); ?></td>
							<td>
								<?php if($row['updated_date'] != '') : ?>
									<?php echo $row['updated_date']; ?>
									<?php else: ?>
										<?php echo "Not Updated"; ?>
									<?php endif; ?>
							</td>
							<td><?php echo $row['deleted_date']; ?></td>
							<td>
								<div class="btn-group">
									<?php if($_SESSION['role'] == 'major') : ?>
									<a href="javascript:void(0)" class="btn btn-danger btn-xs delete" title="Delete" data-id="<?php echo $row['id'] ?>" data-user_id="<?php echo $row['userid'] ?>"><i class="fa fa-trash-o"></i></a>
									<a href="javascript:void(0)" class="btn btn-info btn-xs restore" title="Restore" data-id="<?php echo $row['id'] ?>" data-user_id="<?php echo $row['userid'] ?>"><i class="fa fa-window-restore"></i></a>
									<?php else: ?>
									<a href="javascript:void(0)" class="btn btn-danger btn-xs" title="Delete" disabled><i class="fa fa-trash-o"></i></a>
									<a href="javascript:void(0)" class="btn btn-info btn-xs" title="Restore" disabled><i class="fa fa-window-restore"></i></a>
									<?php endif; ?>
								</div>
							</td>
						</tr>
						<div class="modal fade" id="pic_<?php echo $row['id']; ?>" role="dialog">
						    <div class="modal-dialog modal-sm">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title"><?php echo $row['title']; ?> <i style="color: red;">Photo</i>
						          </h4>
						        </div>
						        <div class="modal-body">
						          <img src="../<?php echo $row['image_path']; ?>" width="200" height="200" class="img-circle">
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
					<tr>
						<th colspan="8">Data not Found.</th>
					</tr>
					<?php
				}
			 ?>
		</tbody>
	</table>
</div>

<?php include 'admin_change_password_form.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		// Restore Artices
		$(document).on('click','.restore',function(){
			if(confirm('Do You Really want to Restore this Article?'))
			{
				var id 		= $(this).data('id');
				var userid 	= $(this).data('user_id');
				var action	= "restore";
				$.ajax({
					url: "admin_restore_articles.php",
					type: "POST",
					data: {id:id,userid:userid,action:action},
					success: function(data){
						alert(data);
						setTimeout(function(){
							window.location.href = "http://localhost/jquery_ajax_crud/admin/deleted-articles";
						},3000);
					}
				});
			}
			else
			{
				return false;
			}
		});
		// Delete Articles
		$(document).on('click','.delete',function(){
			if(confirm('Do You Really want to Delete this Article Permanently?'))
			{
				var id 		= $(this).data('id');
				var userid 	= $(this).data('user_id');
				var action	= "delete";
				$.ajax({
					url: "admin_restore_articles.php",
					type: "POST",
					data: {id:id,userid:userid,action:action},
					success: function(data){
						alert(data);
						setTimeout(function(){
							window.location.href = "http://localhost/jquery_ajax_crud/admin/deleted-articles";
						},3000);
					}
				});
			}
			else
			{
				return false;
			}
		});
	});
</script>
<script type="text/javascript" src="../js/admin/change_password.js"></script>
<?php include '../head-foot/footer.php'; ?>