<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title><?php echo title;?></title>
      <title><?php echo title;?></title>
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="<?php echo base_url('Assets/')?>plugins/fontawesome-free/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url('Assets/')?>dist/css/adminlte.min.css">
      <link rel="stylesheet" href="<?php echo base_url('Assets/')?>dist/css/custom.css">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <link rel="stylesheet" href="https://winto.in/Assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

      <style>

      body{
         font-family: 'Roboto', sans-serif;
      }
      [class*=sidebar-light-] {
          background:linear-gradient(135deg,#2f3ea0,#ae342d);
          color: #fff;
      }
      [class*=sidebar-light-] .sidebar a {
         color: #fff;
         font-size: 15px;
      }
      [class*=sidebar-light-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-light-] .nav-sidebar>.nav-item:hover>.nav-link {
         background-color: rgba(255,255,255,.1);
         color:#fff;
      }
      [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-treeview {
         border-left: 2px red solid;
         color: #fff;
      }
      [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link {
         color: #fff;
         margin-left: 24px;
      }
      .nav-pills .nav-link:not(.active):hover {
         color: #fff;
      }
      .nav-sidebar > .nav-item .nav-icon {
         color: #fff;
      }
      [class*=sidebar-light] .brand-link {
       background: white;
      }
      .content-wrapper, .navbar-white {
         background-color: rgb(255 255 255);
      }
      li.nav-item.has-treeview i {
         color: #6b788b;
         margin-right: 8px;
      }
      li.nav-item.has-treeview p {
         color: #fff;
      }
      i.right.fas.fa-angle-right {
         left: 0;
      }
      li.nav-item.has-treeview i {
         color: #fff;
         margin-right: 8px;
      }
      </style>
   </head>
   <body class="hold-transition sidebar-mini">
      <?php
      $user_info = userinfo();
      ?>
      <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link menu-toggler" data-widget="pushmenu"  href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-sm-inline-block">
              <img src="<?php echo base_url(logo)?>" alt="Justin Life" class="brand-image"
                 style="max-width: 110px;">
            </li>

         </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-primary elevation-1">
         <!-- Brand Logo -->
         <a href="<?php echo base_url('Franchise');?>" class="brand-link">
         <img src="<?php echo base_url(logo)?>" alt="Justin Life" class="brand-image"
            style="max-width: 110px;">
         <span class="brand-text font-weight-light"><?php echo $user_info->user_id;?></span>
         </a>
         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image" style="background-color:#000;">
                  <img src="<?php echo base_url(logo)?>" class="img-circle elevation-1" alt="User Image">
               </div>
               <div class="info">
                  <a href="<?php base_url('Franchise');?>" class="d-block">Dashboard</a>
               </div>
            </div> -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                  <li class="nav-item has-treeview">
                     <a href="<?php echo base_url('Franchise');?>" class="nav-link active">
                        <i class="fa fa-home"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>                  
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-recycle"></i>
                        <p>
                           Orders
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Franchise/Shopping');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>My Shop</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Franchise/Shopping/order_list');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Invoice History</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Franchise/stockTranser');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Stock Transfer</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="<?php echo base_url('Franchise/logout');?>" class="nav-link">
                        <i class="fas fa-power-off"></i>
                        <p>Logout
                        </p>
                     </a>
                  </li>
               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>
<script>
   function addclass(){
      if($('.sidebar-mini')){
         var id = $(this).data('val');
         if(id == 1){
            $('#toggleid').addClass("sidebar-collapse")
            $(this).data('val').remove();
         }else{
            $('#toggleid').removeClass("sidebar-collapse")
            $(this).data('val').add('1');
         }
      }
   }

</script>
