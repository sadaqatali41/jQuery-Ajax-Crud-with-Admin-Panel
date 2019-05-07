
$(document).ready(function(){
	$('#uname').focusout(function(){

		var uname = $('#uname').val();
		$.ajax({

			url : "checkdata.php",
			type : "POST",
			data : {uname:uname},
			success : function(data)
			{
				if(data === 'ok')
				{
					$('#uname_error').show();
					$('#submit').hide();
					$('#uname_error').fadeOut(5000).html('User Name Allready Exist.');

				}
				else
				{
					$('#uname_error').hide();
					$('#submit').show();
				}
			}
		});
	});
	$('#mobile').focusout(function(){

		var mobile = $('#mobile').val();
		$.ajax({

			url : "checkdata.php",
			type : "POST",
			data : {mobile:mobile},
			success : function(data)
			{
				if(data === 'ok')
				{
					$('#mobile_error').show();
					$('#submit').hide();
					$('#mobile_error').fadeOut(5000).html('Mobile Number Allready Exist.');

				}
				else
				{
					$('#mobile_error').hide();
					$('#submit').show();
				}
			}
		});
	});
	$('#email').focusout(function(){

		var email = $('#email').val();
		$.ajax({

			url : "checkdata.php",
			type : "POST",
			data : {email:email},
			success : function(data)
			{
				if(data === 'ok')
				{
					$('#email_error').show();
					$('#submit').hide();
					$('#email_error').fadeOut(5000).html('Email Address Allready Exist.');

				}
				else
				{
					$('#email_error').hide();
					$('#submit').show();
				}
			}
		});
	});
});