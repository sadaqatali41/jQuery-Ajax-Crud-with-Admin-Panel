
$(document).ready(function(){
	
	load_user_articles();

	$('#add_article').on('submit',function(e){

		e.preventDefault();
		var title = $('#title').val();
		var desc = $('#desc').val();
		var file = $('#file').val();

		if(title.length < 3)
		{
			$('#add_article_error').html('<p class="alert alert-danger text-center"><strong>Title Length Should be Greater Than 2 Charecters.</strong></p>');
			return false;
		}
		else if(desc.length < 10 )
		{
			$('#add_article_error').html('<p class="alert alert-danger text-center"><strong>Title Description Should be Greater Than 10 Charecters.</strong></p>');
			return false;
		}
		else if(file == '')
		{
			$('#add_article_error').html('<p class="alert alert-danger text-center"><strong>Please Upload File.</strong></p>');
			return false;
		}
		else
		{
			$('#add_article_error').hide();
			$.ajax({

				url : "add_article.php",
				type : "POST",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success : function(data)
				{
					load_user_articles();

					$("#add_article").trigger("reset");
					$('#add_article_preloader')
					.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					.fadeOut(3000,function(){
						$('#add_article_done').html(data);
					});
				}
			});
		}
	});
	function load_user_articles()
	{
		var action = 'articles_list';
		$.ajax({
			url : "add_article.php",
			type : "POST",
			data : {action:action},
			success : function(data)
			{
				$('#user_articles').html(data);
			}
		});
	}
// Edit Article JS Code

	$(document).on('click','.edit',function(){
		var article_id = $(this).attr('id');

		$.ajax({

			url: "edit_article.php",
			type: "POST",
			data: {article_id:article_id},
			dataType: "json",
			cache: false,
			success: function(data)
			{
				var image_path = data.image_path;
				//alert(image_path);
				$('.modal-title').after('<img id="image" src="'+image_path+'" alt="image" class="img-rounded pull-right" style="border: 2px solid red;" height="65" width="75">');
				$('#hidden_article_id').after('<input type="hidden" id="article_id" name="article_id">');
				$('#title').val(data.title);
				$('#desc').val(data.body);
				$('#article_id').val(data.id);
				$('h2').text('EDIT ARTICLE');
				$('#add_articles').text('Update');
				$('#addarticles').modal('show');
				//load_user_articles();
			},
			error: function(error)
			{
				console.log(arguments);
				alert('there is some error ' +error);
			}

		});
	});
// Delete Articles
	$(document).on('click','.del',function(){
		var article_id = $(this).attr('id');

		swal({
			  title: "Warning!",
			  text: "Do You want to Delete This Article ?",
			  icon: "warning",
			  buttons: ["NO","YES"],
			  dangerMode: true,
			})
			.then((Delete) => {
			  if(Delete) 
			  {
			  	$.ajax({

			  		url: "delete_article.php",
			  		type: "POST",
			  		data: {article_id:article_id},
			  		cache: false,
			  		success: function(data)
			  		{
			  			if(data === "OK")
			  			{
			  				swal({
							   	title : "Success",
							   	text: "Your Article Deleted Successfully",
							    icon: "success",
							});
							load_user_articles();
			  			}
			  			else if(data === "NOT")
			  			{
			  				swal({
							   	title : "Danger",
							   	text: "Your Article NOT Deleted Successfully",
							    icon: "danger",
							});
			  			}
			  			else
			  			{
			  				swal({
							   	title : "Warning",
							   	text: "Article NOT Found",
							    icon: "warning",
							});
			  			}
			  		},
			  		error: function(error)
			  		{
			  			console.log(arguments);
						alert('there is some error ' +error);
			  		}
			  	});
			  } 
			  else 
			  {
			    swal({
			    	title: "Safe!",
			    	text: "Your Article is Safe!",
			    	icon: "success",
			    });
			  }
			});
	});
});