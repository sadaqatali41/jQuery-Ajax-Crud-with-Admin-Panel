<?php 
	session_start();
	session_destroy();
	header('location:http://localhost/jquery_ajax_crud/home');

 ?>