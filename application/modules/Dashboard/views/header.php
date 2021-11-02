<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
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
         <a href="<?php echo base_url('Dashboard');?>" class="brand-link">
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
                  <a href="<?php base_url('Dashboard/User');?>" class="d-block">Dashboard</a>
               </div>
            </div> -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                  <li class="nav-item has-treeview">
                     <a href="<?php echo base_url('Dashboard/User/');?>" class="nav-link active">
                        <i class="fa fa-home"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="far fa-user"></i>
                        <p>
                           My Profile
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Profile');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Profile Edit</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/password_reset/');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Password Manager</p>
                           </a>
                        </li>
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/trans_password/');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Transaction Password Manager</p>
                           </a>
                        </li> -->
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/BankDetails/');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Kyc Manager</p>
                           </a>
                        </li>
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/id_card/');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>ID Card</p>
                           </a>
                        </li> -->
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/tds_charges');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>TDs Charges</p>
                           </a>
                        </li> -->
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-layer-group"></i>
                        <p>
                           My Genelogy
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/PoolTree/'.$user_info->user_id);?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Repurchase Tree</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Tree/'.$user_info->user_id);?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Direct Tree View</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Directs');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>My Direct Team</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Downline');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Downline List</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Downline/L');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>My Left Downline</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Downline/R');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>My Right Downline</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/GenelogyTree/'.$user_info->user_id);?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Genelogy Tree View</p>
                           </a>
                        </li>
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/Genelogy');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Genelogy View</p>
                           </a>
                        </li> -->

                        <?php
                        // $pool_count = pool_count();
                        // for($i = 1 ; $i <= $pool_count->pool_count;$i++){
                        //    echo'<li class="nav-item">
                        //          <a href="'.base_url('Dashboard/User/Pool/'.$user_info->user_id.'/'.$i).'" class="nav-link">
                        //             <i class="right fas fa-angle-right"></i>
                        //             <p>Pool '.$i.'</p>
                        //          </a>
                        //       </li>';
                        // }
                        ?>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview menu-open">
                     <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$user_info->user_id);?>" target="_blank" class="nav-link">
                        <i class="far fa-registered"></i>
                        <p>
                           Register New User
                        </p>
                     </a>
                  </li>
                  <!-- <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-recycle"></i>
                        <p>
                        My Coupons
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Task/userCoupan');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p> My Coupons</p>
                           </a>
                        </li>
                     </ul>
                  </li> -->
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-recycle"></i>
                        <p>Welcome Letter
                        <i class="right fas fa-angle-left"></i> </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/welcomeLetter'); ?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>View Letter</p>
                           </a>                           
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/idcard'); ?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>ID Card</p>
                           </a>                           
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/visitingcard'); ?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Visiting Card</p>
                           </a>                           
                        </li>
                     </ul>
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
                           <a href="<?php echo base_url('Dashboard/Shopping   ');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>My Shop</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Shopping/order_list');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Invoice History</p>
                           </a>
                        </li>
                        <?php
                        if($user_info->paid_status == 1){
                           // echo'<li class="nav-item">
                           //          <a href="'.base_url('Dashboard/Shopping/PaidInvoice/').'" class="nav-link">
                           //             <i class="right fas fa-angle-right"></i>
                           //             <p>Activation  Invoice</p>
                           //          </a>
                           //       </li>';
                        }
                        ?>
                        <!-- <li class="nav-item">
                           <a href="<?php //echo base_url('Dashboard/User/Profile');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Pending Orders</p>
                           </a>
                        </li> -->
                     </ul>
                  </li>

                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-wallet"></i>
                        <p>
                          Add Wallet Request
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Fund/Request_fund');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Request Wallet</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Fund/requests');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Wallet Request History</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Fund/transfer_fund');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Transfer Wallet Money</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Fund/wallet_ledger');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Wallet History</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fab fa-product-hunt"></i>
                        <p>
                           Payout Reports
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <?php $incomes = incomes();
                        foreach($incomes as $key => $income){
                           echo' <li class="nav-item">
                                    <a href="'.base_url('Dashboard/User/Income/'.$key).'" class="nav-link">
                                       <i class="right fas fa-angle-right"></i>
                                       <p>'.$income.'</p>
                                    </a>
                                 </li>';
                        }
                        ?>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Matching_business');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Business Matching</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/User/income_ledgar');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Payout Summary</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Task/payout_summary');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Payout Summary Datewise</p>
                           </a>
                        </li>
                     </ul>
                  </li>


                  <?php
                  // if($user_info->role == 'F'){
                     ?>
                        <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                              <i class="fas fa-user-alt"></i>
                              <p>
                                 Topup
                                 <i class="right fas fa-angle-left"></i>
                              </p>
                           </a>
                           <ul class="nav nav-treeview" style="display: none;">
                              <li class="nav-item">
                                 <a href="<?php echo base_url('Dashboard/ActivateAccount');?>" class="nav-link">
                                    <i class="right fas fa-angle-right"></i>
                                    <p>Member Topup</p>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a href="<?php echo base_url('Dashboard/upgradeAccount');?>" class="nav-link">
                                    <i class="right fas fa-angle-right"></i>
                                    <p>Upgrade Account</p>
                                 </a>
                              </li>
                           </ul>
                        </li>
                     <?php
                  // }
                  ?>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-user-alt"></i>
                        <p>
                           Rewards
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/reward');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Reward List</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-user-alt"></i>
                        <p>
                           Advertisement
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/createAdvertisement');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Add Advertisement</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/Advertisement');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>View Advertisement</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Settings/socialLink');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>View Social Links</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>
                           Withdraw Money
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw')?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Withdraw</p>
                           </a>
                        </li> -->
                        <!-- <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/TaskIncomeWithdraw')?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Task Income Withdraw</p>
                           </a>
                        </li> -->
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/withdraw_history')?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Withdraw Summary</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        <p>
                           Support
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Support/Inbox');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Current Ticket Report</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Support/Outbox');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Closed Ticket Report</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url('Dashboard/Support/ComposeMail');?>" class="nav-link">
                              <i class="right fas fa-angle-right"></i>
                              <p>Raise Ticket</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item has-treeview">
                     <a href="<?php echo base_url('Dashboard/User/logout');?>" class="nav-link">
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
