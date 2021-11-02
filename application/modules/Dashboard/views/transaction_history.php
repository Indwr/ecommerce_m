<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive p-4 bg-white mb-4">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>TDS</th>
                                    <th>Admin Charges</th>
                                    <th>Fund</th>
                                    <th>Payable Amount</th>
                                    <th>Description</th>
                                    <th>Credit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    if($transaction['status'] == 0)
                                        $status = 'Pending';
                                    elseif($transaction['status'] == 1)
                                        $status = 'Approved';
                                    elseif($transaction['status'] == 2)
                                        $status = 'Rejected';
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
                                        <td><?php echo $transaction['amount']; ?></td>
                                        <td><?php echo ucwords(str_replace('_', ' ', $transaction['type'])); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $transaction['tds']; ?></td>
                                        <td><?php echo $transaction['admin_charges']; ?></td>
                                        <td><?php echo $transaction['fund_conversion']; ?></td>
                                        <td><?php echo $transaction['payable_amount']; ?></td>
                                        <td><?php echo $transaction['remark']; ?></td>
                                        <td><?php echo $transaction['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<?php include'footer.php' ?>