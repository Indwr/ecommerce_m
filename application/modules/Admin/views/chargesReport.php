<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header;?> (Rs.<?php echo round($totalWithdraw['record'],2);?>)</h1>
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
              <form method="GET" action="<?php echo base_url('Admin/Withdraw/'.$path);?>">
                <div class="row">
                  <div class="col-3">
                    <label class="form-control">Select Month</label>
                  </div>
                  <div class="col-3">
                    <select class="form-control" name="month">
                      <option value="">Select Month</option>
                      <?php for($i=1;$i<=12;$i++):?>
                      <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php endfor;?>
                    </select>
                  </div>                    
                  <div class="col-3">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form>
              <form method="GET" action="<?php echo base_url('Admin/Withdraw/'.$path);?>">
                <div class="row">
                  <div class="col-3">
                    <input type="date" name="startDate" placeholder="Enter Star Date" class="form-control">
                  </div>
                  <div class="col-3">
                    <input type="date" name="endDate" placeholder="Enter End Date" class="form-control">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>                    
                  <!-- <div class="col-3">
                    <div class="input-group-append">
                    </div>
                  </div> -->
                </div>
              </form>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <?php if($header == 'Admin Report'){
                                echo '<th>Admin</th>';
                            }else{
                                echo '<th>TDS</th>';
                                echo '<th>PAN</th>';
                            }
                            ?>
                            <th>Payable Amount</th>
                            <!-- <th>Date</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requests as $key => $request) {
    //                        pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['user']['name']; ?></td>
                                <td><?php echo $request['user']['phone']; ?></td>
                                <td><?php //echo $request['amount']; ?> <?php echo round($request['payable_amount'],2) + round($request['tds'],2) ; ?></td>
                                <?php if($header == 'Admin Report'){ ?>
                                <td><?php echo round($request['admin_charges'],2); ?></td>
                                <?php }else{ ?>
                                <td><?php echo round($request['tds'],2); ?></td>
                                <td><?php echo $request['bank']['pan']; ?></td>
                                <?php  } ?>
                                <td><?php echo round($request['payable_amount'],2); ?></td>
                                <!-- <td><?php echo $request['created_at']; ?></td> -->

                            </tr>
                            <?php
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
<?php include 'footer.php' ?>
