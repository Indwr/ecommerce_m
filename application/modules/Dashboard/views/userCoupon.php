<?php include 'header.php' ?>
<div class="content-wrapper" style="min-height: 378px; background:white">
  <style>
.h3cpass
{

  background: #58bdad;
    color: #fff;
    text-align: center;
    font-size: 20px;
    line-height: 28px;
    padding: 10px 0px;
}
.h3cpasss
{

  background: #dc3545;
    color: #fff;
    text-align: center;
    font-size: 20px;
    line-height: 28px;
    padding: 10px 0px;
}


  </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">JustInLife Shopping Coupon's<?php //echo $header;?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php //echo $header;?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php
                foreach($coupon as $key => $c){
                    echo '<div class="col-sm-3">';
                    echo '<img src="'.base_url('uploads/').'coupons-amazing.jpg"  style="max-width:100%" >';
                    if($c['status'] == 0){
                        echo '<h3 class="h3cpass">JustInLife Coupon No. '.($key+1).'<br>'.$c['coupan_code'].'<br> <small></small></h3>';
                    }else{
                        echo '<h3 class="h3cpasss">JustInLife Coupon No. '.($key+1).'<br>'.$c['coupan_code'].'<br> <small></small></h3>';
                    }
                    echo '</div>';
                }
                ?>
              
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
