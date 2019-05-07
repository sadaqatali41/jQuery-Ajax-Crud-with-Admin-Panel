<?php include 'head-foot/header.php'; ?>
<?php 
	if(!isset($_SESSION['userid']) && !isset($_SESSION['username']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}
 ?>
<div id="user_articles" class="table-responsive"></div>
<div id="addarticles" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title text-center text-primary"><strong>ADD ARTICLE</strong></h2>
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
					<button type="submit" id="add_articles" class="btn btn-success btn-block"><i class="fa fa-send"></i> Add Article
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
<!-- form included here -->
<?php include 'change_password_form.php'; ?>
<?php include 'story_form.php'; ?>
<!-- form included ends here -->
<script type="text/javascript" src="js/add_articles.js"></script>
<script type="text/javascript" src="js/change_password.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#show_story').click(function(){
			var action = 'story';
			$.ajax({
				url: "get_story.php",
				type: "POST",
				data: {action:action},
				dataType: "json",
				success: function(data)
				{
					// console.log(data);
					if(data.status == 'failed')
					{
						$('#story').text(data.message);
					}
					else
					{
						$('#story').text(data.message);
					}
				},
				error: function(error)
				{
					console.log(error);
				}
			});
		});

		// update story
		$('#update_story').click(function(){
			var story = $('#story').val();
			if(story != '')
			{
				var action = 'update';
				$.ajax({
					url: "get_story.php",
					type: "POST",
					data: {story:story,action:action},
					dataType: "json",
					success: function(data)
					{
						console.log(data);
						if(data.status == 'not_found')
						{
							$('#story').text(data.message);
						}
						else if(data.status == 'failed')
						{
							$('#error_sms').html(data.message);
						}
						else
						{
							$('#story').text(data.message);
							$('#error_sms').html(data.display_sms);
						}
					},
					error: function(error)
					{
						console.log(error);
					}
				});
			}
			else
				alert('Please enter some text.');
		});
	});
</script>
<?php include 'head-foot/footer.php'; ?>