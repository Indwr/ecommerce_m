<?php include'header.php' ?>
<div class="content-wrapper" style="min-height: 378px;">
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
                    <div class="table-responsive p-4 bg-white mb-4">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Pool ID</th>
                                    <?php 
                                    for($i = 1 ; $i <= 5; $i++){
                                        echo'<th>Level'.$i.'</th>';
                                        echo'<th>Level'.$i.' Income</th>';
                                    }
                                    ?>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $incomes =
                                [
                                    1 => 1,
                                    2 => 1.5,
                                    3 => 2,
                                    4 => 2.5,
                                    5 => 3
                                ];
                                foreach ($pools as $key => $pool) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $pool['user_id']; ?></td>
                                        <td><?php echo $pool['pool_id']; ?></td>
                                        <?php 
                                        for($i = 1 ; $i <= 5; $i++){
                                            echo'<td>'.$pool['level'.$i].'</td>';
                                            echo'<td>'.($pool['level'.$i] * $incomes[$i]).'</td>';
                                        }
                                        ?>
                                        <td><?php echo $pool['created_at']; ?></td>
                                        <td><a href="<?php echo base_url('Dashboard/User/Pool/'.$pool['pool_id']);?>">View</a></td>
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
