<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Card Requests </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Card Requests</li>
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
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <?php echo $this->session->flashdata('message');?>
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requests as $key => $request) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['name']; ?></td>
                                <td><?php echo $request['city']; ?></td>
                                <td><?php echo $request['state']; ?></td>
                                <td><img src="<?php echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td>
                                <td><?php echo $request['created_at']; ?></td>
                                <td>
                                    <?php if($request['status'] == 0):?>
                                    <a href="<?php echo base_url('Admin/Task/update_request/1/'.$request['id']);?>" class="btn btn-success">Approve</a>
                                    <a href="<?php echo base_url('Admin/Task/update_request/2/'.$request['id']);?>" class="btn btn-danger">Reject</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php
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

<?php include'footer.php' ?>