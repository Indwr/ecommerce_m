<?php
$siteContent = siteContent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="MLM Soft Solutions">
<meta name="author" content="MLM Soft Solutions">
<title><?php echo title; ?></title>

<link rel="icon" type="image/png" href="<?php echo base_url('uploads/'); ?>favi.png">

<link href="<?php echo base_url('SiteAssets/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo base_url('SiteAssets/'); ?>vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('SiteAssets/'); ?>vendor/select2/css/select2-bootstrap.css" />
<link href="<?php echo base_url('SiteAssets/'); ?>vendor/select2/css/select2.min.css" rel="stylesheet" />

<link href="<?php echo base_url('SiteAssets/'); ?>css/osahan.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>vendor/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>vendor/owl-carousel/owl.theme.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.dropdown {
    display: inline;
}
button#dropdownMenuButton {
    background: transparent;
}
</style>
</head>
<body>
<div class="modal fade login-modal-main" id="bd-example-modal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body">
<div class="login-modal">
<div class="row">
<div class="col-lg-6 pad-right-0">
<div class="login-modal-left">
</div>
</div>
<div class="col-lg-6 pad-left-0">
<button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><i class="mdi mdi-close"></i></span>
<span class="sr-only">Close</span>
</button>
<form>
<div class="login-modal-right">

<div class="tab-content">
<div class="tab-pane active" id="login" role="tabpanel">
<h5 class="heading-design-h5">Login to your account</h5>
<fieldset class="form-group">
<label>Enter Email/Mobile number</label>
<input type="text" class="form-control" placeholder="+91 123 456 7890">
</fieldset>
<fieldset class="form-group">
<label>Enter Password</label>
<input type="password" class="form-control" placeholder="********">
</fieldset>
<fieldset class="form-group">
<button type="submit" class="btn btn-lg btn-secondary btn-block">Enter to your
account</button>
</fieldset>
<div class="login-with-sites text-center">
<p>or Login with your social profile:</p>
<button class="btn-facebook login-icons btn-lg"><i class="mdi mdi-facebook"></i>
Facebook</button>
<button class="btn-google login-icons btn-lg"><i class="mdi mdi-google"></i>
Google</button>
<button class="btn-twitter login-icons btn-lg"><i class="mdi mdi-twitter"></i>
Twitter</button>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="customCheck1">
 <label class="custom-control-label" for="customCheck1">Remember me</label>
</div>
</div>
<div class="tab-pane" id="register" role="tabpanel">
<h5 class="heading-design-h5">Register Now!</h5>
<fieldset class="form-group">
<label>Enter Email/Mobile number</label>
<input type="text" class="form-control" placeholder="+91 123 456 7890">
</fieldset>
<fieldset class="form-group">
<label>Enter Password</label>
<input type="password" class="form-control" placeholder="********">
</fieldset>
<fieldset class="form-group">
<label>Enter Confirm Password </label>
<input type="password" class="form-control" placeholder="********">
</fieldset>
<fieldset class="form-group">
<button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your
Account</button>
</fieldset>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="customCheck2">
<label class="custom-control-label" for="customCheck2">I Agree with <a href="#">Term and Conditions</a></label>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="text-center login-footer-tab">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
</li>
</ul>
</div>
<div class="clearfix"></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="navbar-top pt-2 pb-2">
<div class="container">
<div class="row">
<div class="col-md-6">
<a href="#" class="mb-0 text-white" style="font-size: 16px;font-weight: 500;letter-spacing: 3px;">
 	<img src="<?php echo base_url('uploads/phone-icon.png');?>" class="mobile-icon"><?php echo $siteContent['phone'];?></a>
 	<a href="#" class="mb-0 text-white ml-2" style="font-size: 16px;font-weight: 500;letter-spacing:1px;">
 	<img src="<?php echo base_url('uploads/gmail-icon.png');?>" class="mobile-icon"><?php echo $siteContent['email'];?></a>
</div>
<div class="col-md-6 text-right">
<a href="#" class="text-white ml-3 mr-3">Franchise/Merchant Login</a>
<?php 
	if(!empty($this->session->userdata['user_id']) && $this->session->userdata['role'] == 'U'){
		$userinfo = userinfo();
		echo 'Welcome '.$userinfo['name'];
		echo '<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="'.base_url('Site/Main/tracking').'">Track Order</a>
					<a class="dropdown-item" href="'.base_url('Site/Main/orderHistory').'">All Orders</a>
					<a class="dropdown-item" href="'.base_url('Site/Profile').'">Profile</a>
					<a class="dropdown-item" href="'.base_url('Site/Main/logout').'"><i class="mdi mdi-lock"></i>Log Out</a>
				</div>
			</div>';
	}else{?>
		<a href="<?php echo base_url('Site/Main/login'); ?>"  class="text-white ml-3 mr-3"><i class="mdi mdi-lock"></i> Sign In</a>
		<a href="<?php echo base_url('Dashboard/User/Register'); ?>" class="text-white"><i class="mdi mdi-account-circle"></i> Register</a>
<?php } ?>
</div>
 </div>
</div>
</div>
<nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
<div class="container">
<a class="navbar-brand" href="/"> <img style="max-width:200px" src="<?php echo base_url('SiteAssets/'); ?>img/logo.png" alt="logo"> </a>
<button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-collapse" id="navbarNavDropdown ">
<div class="navbar-nav mr-auto mt-5 mt-lg-2 margin-auto top-categories-search-main">
<div class="top-categories-search">
<div class="input-group">

<input class="form-control" placeholder="Search products in Your City" aria-label="Search products in Your City" type="text">
<span class="input-group-btn">
<button class="btn btn-secondary" type="button"><i class="mdi mdi-file-find"></i>
Search</button>
</span>
</div>
</div>
</div>
<div class="my-2 my-lg-0">
<ul class="list-inline main-nav-right">
<li class="list-inline-item cart-btn">
<a href="<?php echo base_url('Site/Main/cart');?>" class="btn btn-link border-none"><i class="mdi mdi-cart"></i>
My Cart <small class="cart-value"><?php if(!empty($_SESSION['cart'])) { echo count($_SESSION['cart']);}?></small></a>
</li>
</ul>
</div>
</div>
</div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
<div class="container">
<div class="collapse navbar-collapse" id="navbarText">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<!-- <li class="nav-item">
<a class="nav-link shop" href="/"><span class="mdi mdi-store"></span> Super Store</a>
</li> -->
<li class="nav-item">
<a href="/" class="nav-link">Home</a>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Company
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="<?php echo base_url('Site/Main/company');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>Company Profile</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/news');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> News</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/about');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>About US</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/bank');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Bank Detail</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/legal');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Legal</a>
<a class="dropdown-item" href="<?php echo base_url('uploads/'.$siteContent['pdf']);?>" download><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Download PDF Files</a>
</div>
</li>
<li class="nav-item">
<a href="<?php echo base_url('Site/Main/shop');?>" class="nav-link">Products</a>
</li>

<li class="nav-item">
<a href="<?php echo base_url('Site/Main/venderList');?>" class="nav-link">Vender Add</a>
</li>
<!-- <li class="nav-item">
<a href="/" class="nav-link">Achievers</a>
</li> -->
<!-- <li class="nav-item">
<a href="/" class="nav-link">Franchise</a>
</li> -->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Franchise</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="<?php echo base_url('Franchise/');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>Franchise Login</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/franchise');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Franchise List</a>
</div>
</li>
<!-- <li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
My Account
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="my-profile.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Profile</a>
<a class="dropdown-item" href="my-address.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Address</a>
<a class="dropdown-item" href="wishlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Wish List </a>
<a class="dropdown-item" href="orderlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Order List</a>
</div>
</li>
 -->
 <!-- <li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Blog Page
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="blog.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>
Blog</a>
<a class="dropdown-item" href="blog-detail.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog Detail</a>
</div>
</li> -->


<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Media & Gallery</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="<?php echo base_url('Site/Main/videos');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>videos</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/images');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Images</a>
<a class="dropdown-item" href="<?php echo base_url('Site/Main/achiever');?>"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>Achievers</a>

</div>
</li>
<li class="nav-item">
<a class="nav-link" href="<?php echo base_url('Site/Main/contact');?>">Contact</a>
</li>
</ul>
</div>
</div>
</nav>
