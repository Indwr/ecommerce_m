<?php include_once'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
?>
<style>
.user-profile-detail span {
    padding: 13px 0;
    display: block;
    text-align: center;
    border-top: 1px solid rgba(0, 0, 0, 0.10);
}
.user-profile-detail {
    background: #fff;
    box-shadow: 0 2px 6px 0 rgba(218, 218, 253, 0.65), 0 2px 6px 0 rgba(206, 206, 238, 0.54);
    padding: 27px 29px;
    border-radius: 10px;
}
/*
.widget.widget-card .widget-card-cover .cover-bg {

    background: #58bdad !important;
    opacity: 0.8 !important;
}*/
.widget .widget-title, .widget .widget-title a {
    font-size: 18px !important;

}
.widget-inline-list {

    font-size: 15px !important;

}
.content-wrapper .small-box h3 {
    font-size: 20px;
    color: #fff;
}
.content-wrapper .small-box {
    border-radius: 0px 40px;
    min-height: 110px !important;
}/*
.widget.widget-card .widget-card-cover .cover-bg.with-gradient {
    background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 1) 100%);
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgb(88, 189, 173) 100%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgb(88, 189, 173) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000', GradientType=0);
}*/
.modal-body img {
    max-width: 100%;
}
marquee {
    background: #ec682e;
    margin: 0px 20px;
    padding: 6px 0;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    border-radius: 4px;
    margin-bottom: 20px;
}
.bg-img{
    background-image:url('https://dealtaukri.com/uploads/line.svg');
}
.inverse-mode .widget.widget-card, .widget.widget-card.inverse-mode {
    color: #fff;
    border-radius: 0px 40px;
}
.widget.widget-card.with-min-height {
    min-height: 120px;
}
.small-box>.inner {
    padding: 17px 0;
    text-align: center;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark" style="font-weight:bold">Welcome <?php echo $userinfo->name;?>, (<?php echo $userinfo->user_id;?>)</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <marquee><?php echo $news['news'];?></marquee>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-lg-6 col-sm-6">
                    <!-- BEGIN widget -->
                    <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode pd-top" style="background:linear-gradient(45deg,#226cc5,#6cd975);border-radius:10px;">
                        <!-- BEGIN widget-card-cover -->
                        <div class="widget-card-cover">
                            <div class="cover-bg"></div>
                            <img src="http://45.56.84.216/~amazingd/Assets/dist/img/bg-7.jpg" alt="">
                        </div>
                        <!-- END widget-card-cover -->
                        <!-- BEGIN widget-card-content -->

                        <!-- END widget-card-content -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content bottom p-b-5">
                        <div class="row">
                            <div class="col-12 col-md-4">
                            <div style="background:white;padding:5px; text-align:center">
                            <img style="max-height:100px" src="<?php echo $userinfo->image != '' ? base_url('uploads/'.$userinfo->image) : 'http://icons.iconarchive.com/icons/visualpharm/must-have/256/User-icon.png';?>">
                            </div></div>
                            <div class="col-12 col-md-7">
                            <div class="text-right">

                                <span id="date-time">Joining Date:  <?php
                                echo $userinfo->created_at;?></span>
                                <h3 class="m-b-2">Welcome back,
                                    <span id="Mem_Name1"><?php
                                    echo $userinfo->name;?></span> !
                                </h3>
                                <p class="opacity-7" id="RefLink102">
                                    <a style="background:red; padding: 5px; color:white;display: inline-block;" href="<?php echo base_url('/Dashboard/User/Register/?sponser_id='.$userinfo->user_id)?>" target="_blank">Share Link: <?php echo ($userinfo->user_id)?></a>
                                </p>
                            </div>
                            </div>
                            </div>
                            <!-- BEGIN row -->

                            <!-- END row -->
                        </div>
                        <!-- END widget-card-content -->
                    </div>
                    <!-- END widget -->
                </div>
                <!-- END col-6 -->

                <div class="col-md-6 col-sm-6">
                    <div class="colum-bg">
                        <div class="row">
                                <!-- BEGIN col-6 -->
                                <div class="col-12 col-md-6">
                                    <!-- BEGIN widget -->
                                    <ul class="widget widget-list m-b-0 no-bg inverse-mode">
                                        <li>
                                            <!-- BEGIN widget-list-container -->
                                            <a href="<?php echo base_url('Dashboard/User/Downline')?>" class="widget-list-container">
                                                <div class="widget-list-media icon p-l-0">
                                                    <i class="ti-user bg-gradient-blue"></i>
                                                </div>
                                                <div class="widget-list-content">
                                                    <h4 class="widget-title">My Team</h4>
                                                    <!--<div class="widget-desc hidden-xs">Directs, Non-Directs</div>-->
                                                    <ul class="widget-inline-list widget-desc hidden-xs">
                                                        <li>Non-Directs</li>
                                                    </ul>
                                                </div>
                                            </a>
                                            <!-- END widget-list-container -->
                                        </li>
                                        <li>
                                            <!-- BEGIN widget-list-container -->
                                            <a href="<?php echo base_url('Dashboard/User/Directs')?>" class="widget-list-container">
                                                <div class="widget-list-media icon p-l-0">
                                                    <i class="ti-anchor bg-gradient-purple"></i>
                                                </div>
                                                <div class="widget-list-content">
                                                    <h4 class="widget-title">My Referral
                                                    </h4>
                                                    <div class="widget-desc hidden-xs text-white">Directs</div>
                                                </div>
                                            </a>
                                            <!-- END widget-list-container -->
                                        </li>

                                    </ul>
                                    <!-- END widget -->
                                </div>
                                <!-- END col-6 -->
                                <!-- BEGIN col-6 -->
                                <div class="col-12 col-md-6">
                                    <!-- BEGIN widget -->
                                    <ul class="widget widget-list m-b-0 no-bg inverse-mode">
                                        <li>
                                            <!-- BEGIN widget-list-container -->
                                            <a href="<?php echo base_url('Dashboard/Support/Inbox')?>" class="widget-list-container">
                                                <div class="widget-list-media icon p-l-0">
                                                    <i class="ti-ticket bg-gradient-orange"></i>
                                                </div>
                                                <div class="widget-list-content">
                                                    <h4 class="widget-title">Ticket </h4>
                                                    <ul class="widget-inline-list widget-desc hidden-xs">
                                                        <li>Inbox</li>
                                                        <li>Compose</li>
                                                    </ul>
                                                </div>
                                            </a>
                                            <!-- END widget-list-container -->
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('Dashboard/User/password_reset/')?>" class="widget-list-container">
                                                <div class="widget-list-media icon p-l-0">
                                                    <i class="ti-settings bg-gradient-silver"></i>
                                                </div>
                                                <div class="widget-list-content">
                                                    <h4 class="widget-title">Settings</h4>
                                                    <!--<div class="widget-desc hidden-xs">Accounts, Login password</div>-->
                                                    <ul class="widget-inline-list widget-desc hidden-xs">

                                                        <li>Login password</li>
                                                    </ul>
                                                </div>
                                            </a>
                                            <!-- END widget-list-container -->
                                        </li>
                                    </ul>
                                    <!-- END widget -->
                                </div>
                                <!-- END col-6 -->
                            </div>
                        </div>
                </div>

                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <!-- BEGIN widget -->
                    <div class="widget widget-card inverse-mode with-min-height bg-img" style="background-color:#0db2de !important;">
                        <!-- BEGIN widget-card-cover -->
                        <div class="widget-card-cover">
                            <div class="cover-bg with-gradient"></div>
                            <img src="http://45.56.84.216/~amazingd/Assets/dist/img/bg-2.jpg" alt="">
                        </div>
                        <!-- END widget-card-cover -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content">
                            <div class="dropdown dropdown-icon pull-right">
                                <a data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="/Deposit-By-Wallet.html">Deposit By E-Wallet</a>
                                    </li>
                                    <li>
                                        <a href="/Deposit-History.html">Deposit History </a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="widget-title">
                                <b>Current Package</b>
                            </h4>
                        </div>
                        <!-- END widget-card-content -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content bottom">
                            <!-- <div class="widget-card-icon bg-gradient-purple">
                                <i class="ti-control-backward"></i>
                            </div> -->
                            <div class="widget-card-info">
                                <h4 class="widget-title">
                                    <a href="#" id="TOTAL_DEPOSIT">Rs. <?php
                                    echo $userinfo->package_amount;?></a>
                                </h4>
                                <ul class="widget-inline-list">
                                    <li>Total Deposit till now</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END widget-card-content -->
                    </div>
                    <!-- END widget -->
                    <!-- BEGIN widget -->

                    <!-- END widget -->
                </div>
                <!-- END col-3 -->
                <div class="col-xl-3 col-lg-6 col-sm-6">
                     <div class="widget widget-card inverse-mode with-min-height bg-img" style="background-color:#5A8DEE !important">
                        <!-- BEGIN widget-card-cover -->
                        <div class="widget-card-cover">
                            <div class="cover-bg with-gradient"></div>
                            <img src="http://45.56.84.216/~amazingd/Assets/dist/img/bg-6.jpg" alt="">
                        </div>
                        <!-- END widget-card-cover -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content">
                            <div class="dropdown dropdown-icon pull-right">
                                <a data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="/Fund-Request.html">Fund-Request</a>
                                    </li>
                                    <li>
                                        <a href="/Fund-Request.html">Fund-Request Status</a>
                                    </li>
                                    <li>
                                        <a href="/FWallet-Transaction-History.html">Transaction History</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="widget-title">Shoppy Wallet</h4>
                        </div>
                        <!-- END widget-card-content -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content bottom">
                            <!-- <div class="widget-card-icon bg-gradient-red">
                                <i class="ti-control-forward"></i>
                            </div> -->
                            <div class="widget-card-info">
                                <h4 class="widget-title">
                                    <a href="/Dashboard.html#" id="MAR">Rs. <?php echo $wallet_balance['wallet_balance'];?></a>
                                </h4>
                                <ul class="widget-inline-list">
                                    <li>Available On Shoppy Wallet </li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END widget-card-content -->
                    </div>
                </div>
                <!-- BEGIN col-3 -->
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <!-- BEGIN widget -->
                    <div class="widget widget-card inverse-mode with-min-height bg-img" style="background-color:#00CFDD !important">
                        <!-- BEGIN widget-card-cover -->
                        <div class="widget-card-cover">
                            <div class="cover-bg with-gradient"></div>
                            <img src="http://45.56.84.216/~amazingd/Assets/dist/img/bg-5.jpg" alt="">
                        </div>
                        <!-- END widget-card-cover -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content">
                            <div class="dropdown dropdown-icon pull-right">
                                <a href="/Dashboard.html#" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="<?php echo base_url('Dashboard/withdraw_history')?>">Withdrawal Request</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('Dashboard/withdraw_history')?>">Withdrawal Status</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="widget-title">TOTAL WITHDRAWAL</h4>
                        </div>
                        <!-- END widget-card-content -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content bottom">
                            <!-- <div class="widget-card-icon bg-gradient-orange">
                                <i class="ti-stats-up"></i>
                            </div> -->
                            <div class="widget-card-info">
                                <h4 class="widget-title">
                                    <a href="" id="TotWithdrawal">Rs. <?php echo $total_withdrawal['total_withdrawal']?></a>
                                </h4>
                                <ul class="widget-inline-list">
                                    <li>Total Withdrawal till now</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END widget-card-content -->
                    </div>
                    <!-- END widget -->
                    <!-- BEGIN widget -->

                    <!-- END widget -->
                </div>
                <!-- END col-3 -->
                <div class="col-xl-3 col-lg-6 col-sm-6">
             <div class="widget widget-card inverse-mode with-min-height bg-img" style="background-color:#FF5B5C !important">

                        <!-- END widget-card-cover -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content">
                            <div class="dropdown dropdown-icon pull-right">
                                <a href="/Dashboard.html#" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Transaction History</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="widget-title">
                                <b>TOTAL BONUS</b>
                            </h4>
                        </div>
                        <!-- END widget-card-content -->
                        <!-- BEGIN widget-card-content -->
                        <div class="widget-card-content bottom">
                           <!--  <div class="widget-card-icon  bg-gradient-green">
                                <i class="ti-wallet"></i>
                            </div> -->
                            <div class="widget-card-info">
                                <h4 class="widget-title text-ellipsis">
                                    <a href="<?php echo base_url('Dashboard/User/income_ledgar');?>" id="DED">Rs. <?php echo round($total_income['total_income'],2);?></a>
                                </h4>
                                <ul class="widget-inline-list">
                                    <li>Total Income </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END widget-card-content -->
                    </div>
        </div>

            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-info bg-img" style="background-color:#34495e !important">
                        <div class="inner">
                            <h3>Today's Income</h3>
                            <p>Total : <?php echo round($today_income['today_income'],2); ?></p>
                        </div>
                        <!-- <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6" style="display:none">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>E-Wallet</h3>
                            <p class="mb-0">Wallet Bal.: <?php echo $wallet_balance['wallet_balance']; ?></p>
                            <p class="mb-0">Requested : <?php echo $requested_fund['requested_fund']; ?></p>
                            <p>Released : <?php echo $released_fund['released_fund']; ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#16a086 !important">
                        <div class="inner">
                            <h3>Matching Bonus</h3>
                            <p>Total : <?php echo round($matching_bonus['matching_bonus'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#f39c11 !important">
                        <div class="inner">
                            <h3>Senior Support Bonus</h3>
                            <p>Total : <?php echo round($direct_level_income['direct_level_income'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#16a086 !important">
                        <div class="inner">
                            <h3>Team Performance Income</h3>
                            <p>Total : <?php echo round($team_performace_bonus['team_performace_bonus'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-success bg-img" style="background-color:#297fb8 !important">
                        <div class="inner">
                            <h3>Star Royalty (Pending: <?php echo 40000 - round($silver_income['silver_income'],2); ?>)</h3>
                            <p>Total : <?php echo round($silver_income['silver_income'],2); ?></p>
                        </div>
                      <!--   <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>

                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#e84c3d !important">
                        <div class="inner">
                            <h3>Ruby Royalty (Pending: <?php echo 40000 - round($gold_income['gold_income'],2); ?>)</h3>
                            <p>Total : <?php echo round($gold_income['gold_income'],2); ?></p>
                        </div>
                        <!-- <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>
 -->
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#8d44ad !important">
                        <div class="inner">
                            <h3>Royal Royalty (Pending: <?php echo 80000 - round($platinum_income['platinum_income'],2); ?>)</h3>
                            <p>Total : <?php echo round($platinum_income['platinum_income'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>
 -->
                    </div>
                </div>




                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#f39c11 !important">
                        <div class="inner">
                            <h3>Club Income</h3>
                            <p>Total : <?php echo round($club_income['club_income'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-success bg-img" style="background-color:#297fb8 !important">
                        <div class="inner">
                            <h3>Repurchase Level Income</h3>
                            <p>Total : <?php echo round($repurchase_level_income['repurchase_level_income'],2); ?></p>
                        </div>
                        <!-- <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>

                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#e84c3d !important">
                        <div class="inner">
                            <h3>Car Fund</h3>
                            <p>Total : <?php echo round($car_fund['car_fund'],2); ?></p>
                        </div>
                      <!--   <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#8d44ad !important">
                        <div class="inner">
                            <h3>House Fund</h3>
                            <p>Total : <?php echo round($house_fund['house_fund'],2); ?></p>
                        </div>
                      <!--   <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>


                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#e84c3d !important">
                        <div class="inner">
                            <h3>Travel Fund </h3>
                            <p>Total : <?php echo round($travel_fund['travel_fund'],2); ?></p>
                        </div>
                        <!-- <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#8d44ad !important">
                        <div class="inner">
                            <h3>Life Time Royalty</h3>
                            <p>Total : <?php echo round($life_time_royalty['life_time_royalty'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning bg-img" style="background-color:#8d44ad !important">
                        <div class="inner">
                            <h3>Charity Fund</h3>
                            <p>Total : Rs. 0</p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div> -->

                    </div>
                </div>

                <!-- ./col -->
                <div class="col-xl-3 col-lg-6 col-12 col-sm-6" style="display:none">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Total Payout</h3>
                            <p>Total : <?php echo round($total_income['total_income'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div> -->
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Current Payout</h3>
                            <p>Total : <?php echo round($income_balance['income_balance'],2); ?></p>
                        </div>
                       <!--  <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div> -->
                    </div>
                </div>

            <div class="row">
                <h1 class="w-100">Team Summary</h1>
                <hr>
                <div class="col-md-4">
                    <div class="user-profile-detail">
                        <img src="">
                        <div class="">

                            <span><strong>Profile Detail</strong></span>
                            <span><strong>User ID</strong> : <?php echo $user['user_id'];?></span>
                            <span><strong>Name </strong> : <?php echo $user['name'];?></span>
                            <span><strong>Sponsor</strong>: <?php echo $user['sponser_id'];?></span>
                            <span><strong>Mobile </strong> : <?php echo $user['phone'];?></span>
                            <span><strong>Package Name </strong>: <?php echo $packageName['title'];?></span>
                            <span><strong>Joining Date </strong>: <?php echo $user['created_at'];?></span>
                            <span><strong>Active Date </strong>: <?php echo $user['topup_date'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Total Directs</h3>
                            <p>Total : <?php echo ($paid_directs['paid_directs']+$free_directs['free_directs']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Paid Directs</h3>
                            <p>Total : <?php echo $paid_directs['paid_directs']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Total Left Team</h3>
                            <p>Total : <?php echo $totalLeftTeam['team']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Active Left Team</h3>
                            <p>Total : <?php echo $teamLeftPaid['team']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Total Right Team</h3>
                            <p>Total : <?php echo $totalRightTeam['team']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Active Right Team</h3>
                            <p>Total : <?php echo $teamRightPaid['team']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Total Left PV</h3>
                            <p>Total : <?php echo $user['leftPower']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Total Right PV</h3>
                            <p>Total : <?php echo $user['rightPower']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Today Left PV</h3>
                            <p>Total : <?php echo ($user['leftPower'] - $lastPV['left_bv']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="small-box bg-danger bg-img" style="background-color:#FDAC41 !important">
                        <div class="inner">
                            <h3>Today Right PV</h3>
                            <p>Total : <?php echo ($user['rightPower'] - $lastPV['right_bv']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
<?php //include_once'footer.php'; ?>
<?php if($popup['status'] == 0):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title"><?php// echo $popup['caption'];?></h4> -->
            </div>
            <div class="modal-body">

                <?php
                if($popup['type'] == 'video')
                    echo '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'.$popup['media'].'"></iframe>';
              else
                  echo '<img src="'.base_url('uploads/'.$popup['media']).'">';
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
