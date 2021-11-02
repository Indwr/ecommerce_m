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
                    <h1 class="m-0 text-dark"><?php echo $header;?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header;?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <?php foreach($links as $key => $l):?>
                <div class="col-md-4">
                    <div class="addpart" style="padding:20px">
                        <p style="font-weight:bold"><?php echo $l['title'];?></p>
                        <p><a target="_blank" href="<?php echo $l['link'];?>"><?php echo $l['link'];?></a></p>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
