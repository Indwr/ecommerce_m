<?php include_once('header.php'); ?>
<section class="section-padding bg-dark inner-header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h1 class="mt-0 mb-3 text-white"><?php echo $header;?></h1>
<div class="breadcrumbs">
<p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-white"><?php echo $header;?></span></p>
</div>
</div>
</div>
</div>
</section>


<section class="section-padding bg-white">
<div class="container">
<div class="row">

<div class="col-lg-12 col-md-12 pl-5 pr-5">
    <?php 
        echo $this->session->flashdata('message');
        echo form_open();
        echo form_input(['type' => 'email','name' => 'email','placeholder' => 'Enter Email Address']);
        echo form_submit('submit','Submit');
        echo form_close();
    ?>
  <div class="card-body table-responsive p-0">
                  <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Order ID</th>
                              <th>Reference ID</th>
                              <th>Amount</th>
                              <th>Time</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                            if(!empty($data)): 
                            foreach($data as $key => $d):?>
                        <tr>
                            <th><?php echo ($key+1);?></th>
                            <th><?php echo $d['orderId'];?></th>
                            <th><?php echo $d['referenceId'];?></th>
                            <th><?php echo $d['orderAmount'];?></th>
                            <th><?php echo $d['txTime'];?></th>
                            <th><?php echo $d['txStatus'];?></th>
                        </tr>
                        <?php endforeach;endif;?>

                      </tbody>
                  </table>
                </div>
</div>
</div>
</div>
</section>







<?php include_once('footer.php'); ?>
