<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>jQuery Ajax Crud Operation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- <script type="text/javascript">
    $(document).ready(function(){
        var path = window.location.pathname.split("/").pop();
        //alert(path);
        if(path=='')
        {
          path = 'home.php';
        }
        var target = $("#myNavbar a[href='"+path+"']");
        target.addClass("addclass");

      });
  </script> -->
  <style type="text/css">
  .addclass{
        background-color: black;
        font-style: italic;
        font-size: 16px;
        box-shadow: 3px 3px 20px 2px lightgreen;
        text-transform: uppercase;
      }
    body{
      height: 200px;
      background-image: linear-gradient(to right, rgba(255,0,0,1),rgba(255,0,0,0));
    }
    .navbar-inverse{
      margin-top: 5px;
    }
    .loader{
    line-height: 340px;
    margin: auto;
    text-align: center;
    width: 100%;
    /*display: none;*/
  }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse" style="border: 2px solid yellow;">
  <div class="container-fluid">
    <div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
  </button>
    <?php if(isset($_SESSION['adminid']) && isset($_SESSION['adminname'])) : ?>
      <a class="navbar-brand" href="http://localhost/jquery_ajax_crud/admin/dashboard">JQuery AJAX</a>
    <?php elseif(isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
    <a class="navbar-brand" href="http://localhost/jquery_ajax_crud/dashboard">JQuery AJAX
      </a>
      <?php else: ?>
      <a class="navbar-brand" href="http://localhost/jquery_ajax_crud/home">JQuery AJAX
      </a>
    <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- admin section starts here -->
        <?php if(isset($_SESSION['adminid']) && isset($_SESSION['adminname'])) : ?>
        <li><a href="http://localhost/jquery_ajax_crud/admin/dashboard"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/article-list"><i class="fa fa-list"></i> Article List</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/deleted-articles"><i class="fa fa-trash"></i> Deleted Articles</a></li>
        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#change_password"><i class="fa fa-lock">
        </i> Change Password</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/all_stories"><i class="fa fa-history">
        </i> All Story</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/admin-list"><i class="fa fa-user">
        </i> Admin List</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/create-admin"><i class="fa fa-user">
        </i> Create Admin</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/contacts"><i class="fa fa-users">
        </i> Contact List</a></li>
        <!-- admin section ends here -->
        <!-- user section starts here -->
        <?php elseif(isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
        <li><a href="http://localhost/jquery_ajax_crud/dashboard"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:void(0)" data-target="#addarticles" data-toggle="modal"><i class="fa fa-plus-circle">
        </i> Add Article</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/deleted-articles"><i class="fa fa-trash">
        </i> Deleted Articles</a></li>
        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#change_password"><i class="fa fa-lock">
        </i> Change Password</a></li>
        <li><a id="show_story" href="javascript:void(0)" data-toggle="modal" data-target="#your_story"><i class="fa fa-history">
        </i> Your Story</a></li>
        <!-- user section ends here -->
        <?php else: ?>
        <li><a href="http://localhost/jquery_ajax_crud/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/about-us"><i class="fa fa-users"></i> About Us</a></li>
        <li><a href="http://localhost/jquery_ajax_crud/contact-us"><i class="fa fa-phone"></i> Contact Us</a></li>
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- admin section starts here -->
        <?php if(isset($_SESSION['adminid']) && isset($_SESSION['adminname'])) : ?>
        <li class="navbar-text" style="color: yellow"><em><?php echo '<span style="color:white;">Hello</span> '.ucwords($_SESSION['adminname']); ?></em></li>
        <li><a href="http://localhost/jquery_ajax_crud/admin/logout"><span class="glyphicon glyphicon-log-out">
        </span> Log Out
        </a></li>
        <!-- admin section ends here -->
        <!-- user section starts here -->
        <?php elseif(isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
        <li class="navbar-text" style="color: yellow"><em><?php echo '<span style="color:white;">Hello</span> '.ucwords($_SESSION['username']); ?></em></li>
        <li><a href="http://localhost/jquery_ajax_crud/logout"><span class="glyphicon glyphicon-log-out">
        </span> Log Out
        </a></li>
        <!-- user section ends here -->
        <?php else: ?>
        <li><a href="javascript:void(0)" data-target="#registration" data-toggle="modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="javascript:void(0)" data-target="#login" data-toggle="modal"><span class="glyphicon glyphicon-log-in">
        </span> Login
        </a></li>
        <li>
          <a href="javascript:void(0)" data-target="#admin_login" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Admin Login
        </a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<h3 class="text-center">JQuery Ajax Crud Operation</h3>
<div class="container">