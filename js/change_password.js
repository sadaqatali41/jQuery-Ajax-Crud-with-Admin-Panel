$(document).ready(function(){

	var patt=/["!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"]/;

	$('#old_pwd_error').hide();
	$('#new_pwd_error').hide();
	$('#con_pwd_error').hide();

	var old_pwd_error = true;
	var new_pwd_error = true;
	var con_pwd_error = true;

	$('#old_pwd').keyup(function(){
		validate_old_password();
	});

	function validate_old_password()
	{
		var password_val = $('#old_pwd').val();

		if(password_val.length == '')
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Password is Required.");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;

		}
		else if((password_val.length < 8 ) || (password_val.length > 15 ) )
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Password Must be <b>Between 8 and 15</b>**");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;
		}
		else if(!patt.test(password_val))
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Please use Atleast <b>One Special</b> Characters.**");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;
		}
		else if(!/[0-9]/.test(password_val))
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Please use Atleast <b>One Number [0-9]</b> in Password.**");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;
		}
		else if(!/[a-z]/.test(password_val))
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Please use Atleast <b>One lowercase Letter [a-z]</b> in Password.**");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;
		}
		else if(!/[A-Z]/.test(password_val))
		{
			$('#old_pwd_error').show();
			$('#old_pwd_error').html("**Please use Atleast <b>One UPPERCASE Letter [A-Z]</b> in Password.**");
			$('#old_pwd').focus();
			$('#old_pwd_error').css("color","red");
			old_pwd_error = false;
			return false;
		}
		else
		{
			$('#old_pwd_error').hide();
		}
	}

	$('#new_pwd').keyup(function(){
		validate_new_password();
	});

	function validate_new_password()
	{
		var old_password = $('#new_pwd').val();

		if(old_password.length == '')
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Password is Required.");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;

		}
		else if((old_password.length < 8 ) || (old_password.length > 15 ) )
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Password Must be <b>Between 8 and 15</b>**");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;
		}
		else if(!patt.test(old_password))
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Please use Atleast <b>One Special</b> Characters.**");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;
		}
		else if(!/[0-9]/.test(old_password))
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Please use Atleast <b>One Number [0-9]</b> in Password.**");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;
		}
		else if(!/[a-z]/.test(old_password))
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Please use Atleast <b>One lowercase Letter [a-z]</b> in Password.**");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;
		}
		else if(!/[A-Z]/.test(old_password))
		{
			$('#new_pwd_error').show();
			$('#new_pwd_error').html("**Please use Atleast <b>One UPPERCASE Letter [A-Z]</b> in Password.**");
			$('#new_pwd').focus();
			$('#new_pwd_error').css("color","red");
			new_pwd_error = false;
			return false;
		}
		else
		{
			$('#new_pwd_error').hide();
		}
	}

	$('#con_pwd').keyup(function(){
		validate_con_password();
	});

	function validate_con_password()
	{
		var conpass = $('#con_pwd').val();
		var password_val = $('#new_pwd').val();

		if(password_val != conpass)
		{
			$('#con_pwd_error').show();
			$('#con_pwd_error').html("**Password Did not <b>Matched</b>.**");
			$('#con_pwd').focus();
			$('#con_pwd_error').css("color","red");
			con_pwd_error = false;
			return false;

		}
		else
		{
			$('#con_pwd_error').hide();
		}
	}

	$('#update').click(function(event){
		event.preventDefault();

		old_pwd_error = true;
		new_pwd_error = true;
		con_pwd_error = true;

		validate_old_password();
		validate_new_password();
		validate_con_password();

		if(old_pwd_error && new_pwd_error && con_pwd_error)
		{
			var old_pwd = $('#old_pwd').val();
			var new_pwd = $('#new_pwd').val();
			var con_pwd = $('#con_pwd').val();
			$('#update').attr('disabled',true);

			$.ajax({
				url: "http://localhost/jquery_ajax_crud/change_password.php",
				type: "POST",
				data: {old_pwd:old_pwd,new_pwd:new_pwd,con_pwd:con_pwd},
				dataType: "json",
				success: function(data)
				{
					if(data.status == 'failed')
					{
						$('#con_pwd_error').show();
						$('#con_pwd_error').html(data.message);
						setTimeout(function(){
							$('#con_pwd_error').fadeOut('slow');
						},3000);

						setTimeout(function(){
							$('#update').removeAttr('disabled');
						},3000);
					}
					else
					{
						$('#con_pwd_error').show();
						$('#con_pwd_error').html(data.message);
						setTimeout(function(){
							$('#con_pwd_error').fadeOut('slow');
						},3000);
						// close modal after success
						setTimeout(function(){
							$('#change_password').modal('hide');
							$('.modal-backdrop').hide();
						},4000);
					}
				},
				error:function(error)
				{
					//console.log(arguments);
					console.log(error);
				}
			});
		}
		else
		{
			return false;
		}
	});
});