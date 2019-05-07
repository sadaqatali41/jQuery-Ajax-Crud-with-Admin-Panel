
$(document).ready(function(){
	$('#admin_form').on('submit',function(event){
				event.preventDefault();
				var error = '';
				var uname = $('#admin_uname').val();
				var pwd = $('#admin_pwd').val();
				if(uname == "")
				{
					error = '<strong class="alert alert-danger">User Name is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(pwd == "")
				{
					error = '<strong class="alert alert-danger">Password is Required.</strong>';
					checkValue(error);
					return false;
				}
				else
				{
					$("#admin_error").hide();
					$.ajax({

						url : "admin/adminvalidation.php",
						type : "POST",
						data : new FormData(this),
						cache : false,
						contentType: false,
						processData: false,
					    success: function(data)
					    {
					    	if(data === "ok")
					    	{
					    		$("#admin_login_preloader")
					    		.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					    		.fadeOut(3000,function(){
					    		window.location.href = "http://localhost/jquery_ajax_crud/admin/dashboard";
					    		});
					    	}
					    	else
					    	{
					    		$("#admin_login_preloader")
					    		.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					    		.fadeOut(3000,function(){
					    			$("#admin_done").html(data);
					    		});
					    	}
					    }
					});
				}
				
			});

	function checkValue(error)
	{
		$('#admin_error').show();
		$('#admin_error').html(error);
	}
});