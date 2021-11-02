<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Payout Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payout Report</li>
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
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <?php foreach($headerMenu as $th):?>
                              <th><?php echo strtoupper(str_replace("_"," ",$th['type']));?></th>
                              <?php endforeach;?>
                            <th>Gross Amount</th>
                            <th>TDS</th>
                            <th>Admin Charges</th>
                            <th>Charity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($records as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $record['date']; ?></td>
                                <?php foreach($headerMenu as $th):?>
                                  <td><?php echo round($record['incomes'][$th['type']],2);?></td>
                                  <?php endforeach;?>
                                  <td><?php echo round($record['payout'],2) ; ?></td>
                                <td><?php echo round(($record['payout']*0.05),2) ; ?></td>
                                <td><?php echo round(($record['payout']*0.1),2) ; ?></td>
                                <td><?php echo round(($record['payout']*0.01),2) ; ?></td>
                                 <td>
                                  <a href="<?php echo base_url('Dashboard/Task/payoutReport/'.$record['date']);?>">View</a>


                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">Showing <?php echo ($segament + 1) .' to  '.$i;?> of <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      <?php
                        echo $this->pagination->create_links();
                        ?>
                    </div>
                  </div>
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
<?php include'footer.php' ?>
