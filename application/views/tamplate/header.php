<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/logo_pdam.png">
	<title>Admin - <?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/adminLTE.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/skin-blue.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/icon.css?<?= strtotime(date('Ymd his')) ?>">
	<script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo base_url(); ?>index.php/dashboard" class="logo">
				<span class="logo-mini"><b>A</b>dm</span>
				<span class="logo-lg"><b>A</b>dministrator</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url(); ?>assets/images/img_avatar.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>Administrator</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
				<ul class="sidebar-menu" data-widget="tree" id="menu_sidebar">
					<li class="header">MAIN NAVIGATION</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>dashboard">
							<i class="fa fa-dashboard"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>admin">
							<i class="fa fa-id-card"></i><span>Administrator</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>user">
							<i class="fa fa-users"></i><span>User</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>pela">
							<i class="fa fa-user"></i><span>Pelanggan Reguler</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>mbr">
							<i class="fa fa-user-circle"></i><span>Pelanggan MBR</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>pipa">
							<i class="fa fa-battery-full"></i><span>Pipa</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>pipaRencana">
							<i class="fa fa-battery-half"></i><span>Pipa Rencana</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>tekanan">
							<i class="fa fa-file"></i><span>Data Tekanan</span>
						</a>
					</li>
					<li class="bttn">
						<a href="<?php echo base_url(); ?>master_tekanan">
							<i class="fa fa-file"></i><span>Master Tekanan</span>
						</a>
					</li>

					<li class="bttn">
						<a href="<?php echo base_url(); ?>news">
							<i class="fa fa-newspaper-o"></i><span>Hot News</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>logout">
							<i class="fa fa-sign-out"></i><span>Logout</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>