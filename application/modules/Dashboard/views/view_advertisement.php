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
.addpart {
    text-align: center;
    background: #ffe8cd;
        text-align: left;
    border: 3px #eb6830 solid;
}
.addpart img {
    width: 100%;
    height: 224px;
    margin-bottom: 0px;
}


  </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Ads</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Ads</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <?php foreach($users as $key => $u):?>
                <div class="col-md-4">
                  <div class="addpart">
                    <img src="<?php echo base_url('uploads/'.$u['image']);?>">
                    <p style="    padding: 20px 10px;
    margin: 0px;
    background: #3989c5;
    color: #fff;">Business Name: <?php echo $u['name'];?><br>
                  Business City: <?php echo $u['city'];?><br>
                    Business State: <?php echo $u['state'];?></p>
                </div></div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
