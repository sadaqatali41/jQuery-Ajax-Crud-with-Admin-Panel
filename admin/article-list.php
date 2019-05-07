<?php include '../head-foot/header.php'; ?>
<?php 
	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
 ?>
<div class="table-responsive">
	<h2 class="text-center"><i class="fa fa-list"></i> All Articles List</h2>
	<table class="table table-bordered">
		<thead>
			<tr style="display: none;">
				<th id="delete_article_sms" colspan="8"></th>
			</tr>
			<tr class="success">
				<th>Serial No.</th>
				<th>Title</th>
				<th>Description</th>
				<th>Images</th>
				<th>Created By</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$con = mysqli_connect('localhost','root','','jquery_ajax_crud');
				$result = mysqli_query($con,"SELECT articles.*,crud.fname FROM articles LEFT JOIN crud ON crud.id = articles.userid");
				$counter = 1;
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $counter++; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td style="width: 28%;"><?php echo $row['body']; ?></td>
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
							<td>
							<div class="btn-group">
								<a href="javascript:void(0)" class="btn btn-info btn-xs edit" id="<?php echo $row['id']; ?>" user_id="<?php echo $row['userid']; ?>"><i class="fa fa-edit"></i> Edit</a>
								<?php if($_SESSION['role'] == 'major') : ?> 
								<a href="javascript:void(0)" class="btn btn-danger btn-xs delete" id="<?php echo $row['id']; ?>" user_id="<?php echo $row['userid']; ?>"><i class="fa fa-trash-o"></i> Delete</a>
								<?php else: ?>
								<a href="javascript:void(0)" class="btn btn-danger btn-xs" disabled><i class="fa fa-trash-o"></i> Delete</a>
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
						          <img src="../<?php echo $row['image_path']; ?>" width="100%" height="100%" class="img-circle">
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
<div id="addarticles" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title text-center text-primary"><strong>ADMIN EDIT ARTICLE</strong></h2>
      </div>
      <div class="modal-body">

        <form id="add_article" method="post" enctype="multipart/form-data">
        			<div id="add_article_preloader"></div>
        			<div id="add_article_error"></div>
        			<div id="add_article_done"></div>
        	<div class="input-group">
			    <span class="input-group-addon"><i class="fa fa-pencil"></i>
			    </span>
			    <input id="title" type="text" class="form-control" name="title" placeholder="Enter Article Title" required autofocus>
			</div>
			<br>
			<div class="input-group">
			    <span class="input-group-addon"><i class="fa fa-address-book-o"></i>
			    </span>
			    <input id="desc" type="text" class="form-control" name="desc" placeholder="Enter Article Description" required>
			</div>
			<br>
			<div class="input-group" id="hidden_article_id">
			    <span class="input-group-addon"><i class="fa fa-file"></i></span>
			    <input id="file" type="file" class="form-control" name="file">
			</div>
			<br>
			<div class="row">
				<div class="col-sm-offset-1 col-sm-4">
					<button type="submit" id="add_articles" class="btn btn-success btn-block"><i class="fa fa-send"></i> Update Article
					</button>
				</div>
				<div class="col-sm-4">
					<button type="reset" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Reset</button>
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
<!-- Edit Functionality for Admin -->
<?php include 'admin_change_password_form.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','.edit',function(){
			var article_id = $(this).attr('id');
			var userid = $(this).attr('user_id');
			//alert(userid);
			$.ajax({
				url: "admin_edit_article.php",
				type: "POST",
				data: {article_id:article_id,userid:userid},
				dataType: "json",
				cache: false,
				success: function(data)
				{
					var image_path = data.image_path;
					// console.log(data);
					// alert(image_path);
					$('.modal-title').after('<img id="image" src="../'+image_path+'" alt="image" class="img-rounded pull-right" style="border: 2px solid red;" height="65" width="75">');
					$('#hidden_article_id').after('<input type="hidden" id="article_id" name="article_id">');
					$('#hidden_article_id').after('<input type="hidden" id="userid" name="userid">');
					$('#title').val(data.title);
					$('#desc').val(data.body);
					$('#article_id').val(data.id);
					$('#userid').val(data.userid);
					$('#addarticles').modal('show');
				},
				error: function(error)
				{
					console.log(arguments);
					alert('there is some error ' +error);
				}

			});
		});

		$('#add_article').on('submit',function(e){
			e.preventDefault();
			$.ajax({

				url : "admin_update_article.php",
				type : "POST",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success : function(data)
				{
					$('#add_article_preloader')
					.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					.fadeOut(3000,function(){
						$('#add_article_done').html(data);
					});
					setTimeout(function(){
						window.location.href = "http://localhost/jquery_ajax_crud/admin/article-list.php";
					},3000);
					//console.log(data);
				},
				error: function(error)
				{
					console.log(arguments);
					alert('there is some error ' +error);
				}
			});
		});

		$(document).on('click','.delete',function(){
			if(confirm('Really, Do You want to Delete this Article'))
			{
				var article_id = $(this).attr('id');
				var userid = $(this).attr('user_id');
				//alert(userid);
				$.ajax({
					url: "admin_delete_article.php",
					type: "POST",
					data: {article_id:article_id,userid:userid},
					cache: false,
					success: function(data)
					{
						alert(data);
						setTimeout(function(){
							window.location.href = "http://localhost/jquery_ajax_crud/admin/article-list.php";
						},3000);
					},
					error:function(error)
					{
						console.log(arguments);
						alert('there is some error ' +error);
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