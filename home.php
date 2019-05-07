<?php include 'head-foot/header.php'; ?>
<?php 
	if(isset($_SESSION['adminid']) && isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/admin/dashboard');
	}
	elseif(isset($_SESSION['userid']) && isset($_SESSION['username']))
	{
		header('location:http://localhost/jquery_ajax_crud/dashboard');
	}
 ?>
<?php include 'login.php'; ?>
<?php include 'registration.php'; ?>
<?php include 'admin/admin-login.php'; ?>
<h1 class="text-center"><i class="fa fa-list"></i> All Public Articles</h1>
<?php 
	$con = mysqli_connect("localhost","root","","jquery_ajax_crud");
	$query = "SELECT articles.*, crud.fname FROM articles LEFT JOIN crud ON crud.id = articles.userid";
	$result = mysqli_query($con,$query);
 ?>
 	<?php if(mysqli_num_rows($result) > 0 ): ?>
 		<table class="table table-bordered table-hovered">
 			<thead>
 				<tr class="success">
					<th>Serial No.</th>
					<th>Title</th>
					<th>Description</th>
					<th>Created By</th>
					<th>Created Date</th>
					<th>Image</th>
					<th>Updated Date</th>
				</tr>
 			</thead>
 			<tbody>
	 		<?php $counter = 1; while($row = mysqli_fetch_array($result)) : ?>
	 			<tr>
					<td><?php echo $counter++; ?></td>
					<td><?php echo $row['title']; ?></td>
					<td style="width: 35%;"><?php echo $row['body']; ?></td>
					<td><?php echo ucwords($row['fname']); ?></td>
					<td><?php echo $row['created_date']; ?></td>
					<td>
						<a href="javascript:void(0)">
							<img src="<?php echo $row['image_path']; ?>" height="65" width="65" class="img-circle" title="<?php echo $row['title'] ?>">
						</a>
					</td>
					<td>
						<?php if($row['updated_date'] != '') : ?>
							<?php echo $row['updated_date']; ?>
						<?php else : ?>
							not updated
						<?php endif; ?>
					</td>
				</tr>
	 		<?php endwhile; ?>
 			</tbody>
 		</table>
 	<?php else: ?>
 		<p class="alert alert-danger text-center">Sorry! Article not Found.</p>
 	<?php endif; ?>
<?php include 'head-foot/footer.php'; ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <img src="" id="image_modal" width="100%" height="100%">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(window).on('load',function(){
		$('img').on('click',function(){
			var src 	= $(this).attr('src');
			var title 	= $(this).attr('title');
			$('#image_modal').attr('src',src);
			$('.modal-title').html('Title is : <em style="color:red;">'+title+'</em>');
			$('#myModal').modal('show');
		});
	});
</script>