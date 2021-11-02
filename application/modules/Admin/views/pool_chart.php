<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pool Chart</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pool Chart</li>
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
                <h3 class="card-title">Pool Chart</h3>

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
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Pool ID</th>
                            <?php 
                            for($i =1 ; $i<= 5 ; $i++){
                                echo'<th>level '.$i.'</th>';
                                echo'<th>level '.$i.' income</th>';
                            }
                            ?>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['user']['name'] ; ?></td>
                                <td><?php echo $user['pool_id']; ?></td>
                                <?php
                                for($i = 1 ; $i <= 5 ; $i++){
                                    echo'<td>'.$user['level'.$i].'</td>';
                                    echo'<td>'.($user['level'.$i.'income'] == 1 ? 'Credited' : '--').'</td>';
                                }
                                ?>
                                <td><?php echo $user['created_at']; ?></td>
                                </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>