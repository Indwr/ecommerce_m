<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reset Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reset Password</li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="cpassword" class="form-control"  placeholder="Current Password"/>
                        <label class="text-danger"><?php echo form_error('cpassword');?></label>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="npassword" class="form-control"  placeholder="New Password"/>
                        <label class="text-danger"><?php echo form_error('npassword');?></label>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="cnpassword" class="form-control"  placeholder="Confirm New Password"/>
                        <label class="text-danger"><?php echo form_error('cnpassword');?></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>