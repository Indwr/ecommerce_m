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
              <div class="table-responsive">
                <table class="table table-bordered table-striped dataTable" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Sponser ID</th>
                            <th>Position</th>
                            <th>Joining Date</th>
                            <th>Activation Date</th>
                            <th>Level</th>
                            <th>Package</th>
                            <!-- <th>Left Paid</th>
                            <th>Right Paid</th>
                            <th>Left Unpaid</th>
                            <th>Right Unpaid</th>
                            <th>Total Team</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $user['user']['name']; ?></td>
                                <td><?php echo $user['user']['user_id']?></td>
                                <td><?php echo $user['user']['sponser_id']; ?></td>
                                <td><?php echo $user['user']['position']; ?></td>
                                <td><?php echo $user['user']['created_at']; ?></td>
                                <td><?php echo $user['user']['topup_date']; ?></td>
                                <td><?php echo $user['level']; ?></td>
                                <td><?php echo $user['user']['package_amount']; ?></td>
                                <!-- <td><?php //echo $user['paidTeamL']['team']; ?></td>
                                <td><?php //echo $user['paidTeamR']['team']; ?></td>
                                <td><?php //echo $user['unpaidTeamL']['team']; ?></td>
                                <td><?php //echo $user['unpaidTeamR']['team']; ?></td>
                                <td><?php //echo $user['paidTeam']['team']+$user['unpaidTeam']['team']; ?></td> -->
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
