
$(document).ready(function(){
			$('#datas').on('submit',function(event){
				event.preventDefault();
				var error = '';
				var fname = $('#full_name').val();
				var uname = $('#uname').val();
				var pwd = $('#pwd').val();
				var cpwd = $('#cpwd').val();
				var mobile = $('#mobile').val();
				var email = $('#email').val();
				var gender = $('#gender').val();
				var file = $('#file').val();

				if(fname == "")
				{
					error = '<strong>Full Name is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(uname == "")
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
				else if(cpwd == "")
				{
					error = '<strong>Confirm Password is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(pwd != cpwd)
				{
					error = '<strong>Password did not Matched.</strong>';
					checkValue(error);
					return false;
				}
				else if(mobile == "")
				{
					error = '<strong>Mobile Number is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(email == "")
				{
					error = '<strong>Email Address is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(gender == "")
				{
					error = '<strong>Gender is Required.</strong>';
					checkValue(error);
					return false;
				}
				else if(file == "")
				{
					error = '<strong>Image is Required.</strong>';
					checkValue(error);
					return false;
					
				}
				else
				{
					$("#error").hide();
					$.ajax({

						url: "insert.php",
						type: "POST",
						data:  new FormData(this),
						cache : false,
						contentType: false,
						processData: false,
						success:function(data)
						{  
                          $("form").trigger("reset");  
                          $("#user_regis_preloader")
                          .html('<h4 class="alert alert-success bg-success">Loading Please Wait...<br></h4>')
                          .fadeOut(3000,function(){
                          	$("#done").html(data);
                          });    
                     	} 
					});
				}
				
			});

			function checkValue(error)
			{
				$('#error').show();
				$('#error').html(error);
			}
		});