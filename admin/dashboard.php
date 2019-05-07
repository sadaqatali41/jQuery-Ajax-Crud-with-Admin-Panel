<?php 
	include("../head-foot/header.php");

	if(!isset($_SESSION['adminid']) && !isset($_SESSION['adminname']))
	{
		header('location:http://localhost/jquery_ajax_crud/home');
		exit();
	}

 ?>
 <style type="text/css">
 	body{
		height: 200px;
	    background-image: linear-gradient(to right, rgba(255,0,0,1), rgba(255,0,0,0)); 
}
 </style>
<h2 class="text-center"><i class="fa fa-list"> All User List</i></h2>
<span id="status_change"></span>
<div id="user_data"></div>
<?php include 'admin_change_password_form.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){

		load_user_data();

		function load_user_data()
		{
			var action = "fetch";
			$.ajax({
				url : "get_user_data.php",
				type : "POST",
				data : {action:action},
				success : function(data)
				{
					$('#user_data').html(data);
				}
			});
		}
		$(document).on('click','.status',function(){
			var action = "status_change";
			var user_id = $(this).attr('id');
			var user_status = $(this).attr('user_status');
			$('#status_change').html('');
			swal({
				  title: "Changing the Status!",
				  text: "Do You Want to Change Status of This User ?",
				  icon: "warning",
				  buttons: ["NO","YES"],
				  dangerMode: true,
				})
				.then((change) => {
				  if (change) {
				  	$.ajax({
							url : "get_user_data.php",
							type : "POST",
							data : {action1:action,user_id:user_id,user_status:user_status},
							success : function(data)
							{	
								if(data != '')
								{
										load_user_data();
										//$('#status_change').html(data);
										swal({
									    		title: "Success",
									    		text: "Status Changed Successfully",
									    		icon: "success",
				    					});
								}
							}
						});
				  }
				  else
				  {
				    swal({
				    	title: "Status",
				    	text: "Status of the User is Remain Same.",
				    	icon:"success",
				    });
				  }
				});

		});

	});
</script>
<script type="text/javascript" src="../js/admin/change_password.js"></script>
<?php include("../head-foot/footer.php"); ?>