<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px; background:white">
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
                <table class="table table-bordered table-striped dataTable" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Sponser ID</th>
                            <th>Package Amount</th>
                            <th>Paid Status</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Joining Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name']?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['sponser_id']; ?></td>
                                <td><?php echo $user['package_amount']; ?></td>
                                <td><?php echo $user['paid_status'] == 0 ? 'Free' : 'Paid'; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['position']; ?></td>
                                <td><?php echo $user['created_at']; ?></td>
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
<?php include'footer.php' ?>
