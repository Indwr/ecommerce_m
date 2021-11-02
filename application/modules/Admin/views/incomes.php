<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header; ?> (<?php echo round($total_income,2);?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All users</li>
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
              <form method="GET" action="<?php echo base_url($url.'/'.$type);?>">
                <div class="row">
                    <div class="col-3">
                      <input type="date" name="startDate" class="form-control float-right" value="<?php echo $startDate;?>" placeholder="Enter Start Date">
                    </div>
                    <div class="col-3">
                      <input type="date" name="endDate" class="form-control float-right" value="<?php echo $endDate;?>" placeholder="Enter End Date">
                    </div>
                    <!-- <div class="col-3">
                      <select class="form-control" name="type">
                        <option value="user_id" <?php //echo $type == 'user_id' ? 'selected' : '';?>>User ID</option>
                        <option value="phone" <?php //echo $type == 'phone' ? 'selected' : '';?>>Phone</option>
                        <option value="name" <?php //echo $type == 'name' ? 'selected' : '';?>>Name</option>
                        <option value="sponser_id" <?php //echo $type == 'sponser_id' ? 'selected' : '';?>>Sponser ID</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <input type="text" name="value" class="form-control float-right" value="<?php echo $value;?>" placeholder="Search">
                    </div> -->
                    
                    <div class="col-3">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Credit Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $segament + 1;
                        foreach ($user_incomes as $key => $income) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $income['user_id']; ?></td>
                                <td><?php echo $income['user']['name']; ?></td>
                                <td><?php echo round($income['amount'],2); ?></td>
                                <td><?php echo ucwords(str_replace('_', ' ', $income['type'])); ?></td>
                                <td><?php echo $income['description']; ?></td>
                                <td><?php echo $income['created_at']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                echo $this->pagination->create_links();
                ?>
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
