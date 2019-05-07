
$(document).ready(function(){
	$('#login_form').on('submit',function(event){
				event.preventDefault();
				var error = '';
				var uname = $('#login_uname').val();
				var pwd = $('#login_pwd').val();
				if(uname == "")
				{
					error = '<strong>User Name is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(pwd == "")
				{
					error = '<strong>Password is Required.</strong>';
					checkValue(error);
					return false;
				}
				else
				{
					$("#login_error").hide();
					$.ajax({

						url : "uservalidation.php",
						type : "POST",
						data : new FormData(this),
						cache : false,
						contentType: false,
						processData: false,
					    success: function(data)
					    {
					    		if(data === "done")
					    		{
					    			$("#user_login_preloader")
					    			.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					    			.fadeOut(3000,function(){
					    			window.location.href = "http://localhost/jquery_ajax_crud/dashboard";
					    			});
					    		}
					    		else
					    		{
					    			$("#user_login_preloader")
					    			.html('<h4 class="alert alert-info bg-success">Loading Please Wait...<br></h4>')
					    			.fadeOut(3000,function(){
					    				$("#login_done").html(data);
					    			});
					    		}
					    }
					});
				}
				
			});

	function checkValue(error)
	{
		$('#login_error').show();
		$('#login_error').html(error);
	}
});