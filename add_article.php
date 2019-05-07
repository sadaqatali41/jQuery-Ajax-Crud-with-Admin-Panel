<?php 
	session_start();
	date_default_timezone_set('asia/kolkata');
	$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
	if(isset($_SESSION['userid']) && isset($_SESSION['username']))
	{
		if(isset($_FILES['file']['name']))
		{
			$userid = $_SESSION['userid'];
			$title = strip_tags(addslashes($_POST['title']));
			$desc = strip_tags(addslashes($_POST['desc']));
			$fname = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$ftype = $_FILES['file']['type'];
			$fpath = 'article_photos/'.substr(time().'_'.$fname, 10);
			$cdate = date('Y-m-d H:i:s');

			if($ftype == "image/jpeg" || $ftype == "image/gif" || $ftype == "image/png" || $ftype == "image/jpg")
			{
				if(move_uploaded_file($tmp_name, $fpath))
				{
					if(isset($_POST['article_id']))
					{
						$article_id = $_POST['article_id'];
						$updated_date = date('Y-m-d H:i:s');
						mysqli_query($con,"UPDATE articles SET title = '$title',body = '$desc',image_path = '$fpath',updated_date = '$updated_date' WHERE userid = '$userid' AND id = '$article_id'");
						if(mysqli_affected_rows($con) == 1)
						{
							echo "<p class='alert alert-success text-center'><strong>Article Updated Successfully.</strong></p>";
						}
						else
						{
							echo "<p class='alert alert-danger text-center'><strong>Article not Updated Successfully.</strong></p>";
							echo mysql_error($con);
						}

					}
					else
					{
						mysqli_query($con,"INSERT INTO articles(userid,title,body,image_path,created_date) VALUES ('$userid','$title','$desc','$fpath','$cdate')");
						if(mysqli_affected_rows($con) == 1)
						{
							echo "<p class='alert alert-success text-center'><strong>Article Inserted Successfully.</strong></p>";
						}
						else
						{
							echo "<p class='alert alert-danger text-center'><strong>Article not Inserted Successfully.</strong></p>";
							echo mysql_error($con);
						}
					}
				}
			}
		}
		if(isset($_POST['action']))
		{
			$userid = $_SESSION['userid'];
			$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
			$result = mysqli_query($con,"SELECT * FROM articles WHERE userid = '".$userid."'");
			if(mysqli_num_rows($result) > 0 )
			{
				$counter = 1;
				?>
				<h1 class="text-center"><i class="fa fa-list"></i> All Article List</h1>
				<table class="table table-bordered">
				<thead>
					<tr class="success">
						<th>Serial No.</th>
						<th>Title</th>
						<th>Description</th>
						<th>Created Date</th>
						<th>Image</th>
						<th>Updated Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = mysqli_fetch_array($result)) : ?>
					<tr>
						<td><?php echo $counter++; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td style="width: 35%;"><?php echo $row['body']; ?></td>
						<td><?php echo $row['created_date']; ?></td>
						<td><a href="#pic_<?php echo $row['id']; ?>" data-toggle="modal"><img src="<?php echo $row['image_path']; ?>" height="65" width="65" class="img-circle">
						</td></a><td>
							<?php if($row['updated_date'] != '') : ?>
								<?php echo $row['updated_date']; ?>
							<?php else : ?>
								not updated
							<?php endif; ?>
						</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-info btn-xs edit" name="edit" id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Edit</button>
								<button type="button" class="btn btn-danger btn-xs del" id="<?php echo $row['id']; ?>" name="delete"><i class="fa fa-trash-o"></i> Delete</button>
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
						          <img src="<?php echo $row['image_path']; ?>" width="200" height="200" class="img-circle">
						        </div>
						      </div>
						    </div>
						</div>
					<?php endwhile; ?>
				</tbody>
				</table>
				<?php
			}
			else
			{
				echo "<p class='alert alert-warning text-center'><strong>Sorry! Data not Found.</strong></p>";
			}
		}
	}
 ?>