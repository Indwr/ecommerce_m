<?php include_once'header.php'; ?>
<style>
  h3 a {
      color: white;
  }
  a h3 {
      color: white;
  }
  .small-box h3 {
    font-size: 20px !important;

}
.small-box {

    min-height: 140px;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0 text-dark">Starter Page</h1>
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo base_url('Admin/Cron/WithdrawCron');?>" class="btn btn-primary">Auto Withdraw</a>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="row">

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Withdraw/incomeLedgar');?>"><h3>Total Payout</h3></a>
                            <p>Total : <?php echo number_format($total_payout,2);?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
















                
                <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><a href="<?php echo base_url('Admin/Management/users/');?>">Total Members</a></h3>
                            <p>Total : <?php echo $total_users;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Management/paidUsers/');?>"><h3>Paid Members</h3></a>
                            <p class="mb-0">Total : <?php echo $paid_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Management/today_joinings/');?>"><h3>Today Joined <br>Members</h3></a>
                            <p class="mb-0">Total : <?php echo $today_joined_users;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a href="<?php echo base_url('Admin/Management/todayPaid/');?>"><h3>Today Paid <br>Members</h3></a>
                            <p class="mb-0">Total : <?php echo $todayPaidUsers;?></p>
                          </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Shoppy Wallet</h3>
                            <p class="mb-0">Wallet Bal.: <?php echo $total_sent_fund;?></p>
                            <p class="mb-0">Used : <?php echo $used_fund;?></p>
                            <p>Requested : <?php echo $requested_fund;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-inr"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>E-Mail</h3>
                            <p class="mb-0">Total : <?php echo $totalEmail;?></p>
                            <p class="mb-0">Read : <?php echo $readEmail;?></p>
                            <p>Unread : <?php echo $unreadEmail;?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>

                    </div>
                </div>


        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
