<?php include_once('header.php'); ?>
<section class="section-padding bg-dark inner-header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h1 class="mt-0 mb-3 text-white">Franchise List</h1>
<div class="breadcrumbs">
<p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-white">Franchise List</span></p>
</div>
</div>
</div>
</div>
</section>


<section class="section-padding bg-white">
<div class="container">
<div class="row">

<div class="col-lg-12 col-md-12 pl-5 pr-5">
  <div class="card-body table-responsive p-0">
                  <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Franchise Type</th>
                              <th>Name</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Code</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($data as $key => $d):?>
                        <tr>
                            <th><?php echo ($key+1);?></th>
                            <th><?php echo $d['franchise_type'];?></th>
                            <th><?php echo $d['name'];?></th>
                            <th><?php echo $d['address'];?></th>
                            <th><?php echo $d['city'];?></th>
                            <th><?php echo $d['state'];?></th>
                            <th><?php echo $d['code'];?></th>
                        </tr>
                        <?php endforeach;?>

                      </tbody>
                  </table>
                </div>
</div>
</div>
</div>
</section>







<?php include_once('footer.php'); ?>
