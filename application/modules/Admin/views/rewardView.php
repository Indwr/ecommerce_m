<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo str_replace("%20", " ", $header); ?></h1>
            <button type="button" id="export" class="btn btn-default"><i class="fas fa-download"></i>Export</button>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo str_replace('%20',' ',$header);?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th><th>User ID</th><th>Name</th><th>Left PV</th><th>Right PV</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $key => $r):?>
                                <tr>
                                    <td><?php echo $key+1;?></td>
                                    <td><?php echo $r['user_id'];?></td>                                    
                                    <td><?php echo $r['name'];?></td>
                                    <td><?php echo $r['leftPower'];?></td>
                                    <td><?php echo $r['rightPower'];?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
<script>
$("#export").click(function(){
  $("#tableexcel").table2excel({
    filename:"File.xls",
  });
});
</script>