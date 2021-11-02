<?php include'header.php' ?>
<div class="content-wrapper">
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                    
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tableView">
                    <thead>
                        <tr>
                          <?php 
                            foreach($thead as $hk => $th){
                                echo '<td>'.$th.'</td>';
                            }  
                          ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tbody as $key => $tb) {
                            echo $tb;
                        }
                        ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
