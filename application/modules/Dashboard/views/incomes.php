<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?> (<?php echo round($total_income['total_income'],2);?> Rs)</h1>
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
                                    <th>Description</th>
                                    <th>Credit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($user_incomes as $key => $income) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $income['user_id']; ?></td>
                                        <td><?php echo $income['amount'] > 0 ? '<span class="text-success">' . round($income['amount'],2) . '</span>' : '<span class="text-danger">' . round($income['amount'],2) . '</span>'; ?></td>
                                        <td><?php echo  get_income_name($income['type']); ?></td>
                                        <td><?php echo $income['description']; ?></td>
                                        <td><?php echo $income['created_at']; ?></td>
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
