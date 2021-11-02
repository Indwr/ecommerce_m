<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reward Table</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reward Table</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php
        $reward = [
            '1' => ['rank' => 'Star','pair' => '20','trophy' => ''],
            '2' => ['rank' => 'Super Star','pair' => '50','trophy' => 'Laptop Bag'],
            '3' => ['rank' => 'Champion','pair' => '150','trophy' => 'Juicer'],
            '4' => ['rank' => 'Sapphire','pair' => '400','trophy' => 'Andriod Mobile'],
            '5' => ['rank' => 'Emrald','pair' => '1000','trophy' => '15000'],
            '6' => ['rank' => 'Diamond','pair' => '2000','trophy' => '35000'],
            '7' => ['rank' => 'White Diamond','pair' => '5000','trophy' => '80000'],
            '8' => ['rank' => 'Black Diamond','pair' => '10000','trophy' => '150000'],
            '9' => ['rank' => 'Blue Diamond','pair' => '25000','trophy' => '400000'],
            '10' => ['rank' => 'Ambassador','pair' => '60000','trophy' => '1000000'],
            '11' => ['rank' => 'Gold Ambassador','pair' => '120000','trophy' => '2000000'],
            '12' => ['rank' => 'Diamond Ambassador','pair' => '300000','trophy' => '5000000'],
            '13' => ['rank' => 'Royaliy','pair' => '1000000','trophy' => '20000000'],
        ];  
    ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th><th>Rank</th><th>Left PV</th><th>Left Achieved</th><th>Right PV</th><th>Right Achieved</th><th>Trophy</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reward as $key => $r):?>
                                <tr>
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $r['rank'];?></td>
                                    <td><?php echo $r['pair'];?></td>
                                    <td><?php echo ($user['leftPower'] < $r['pair']) ? $user['leftPower'] : $r['pair'];?></td>
                                    <td><?php echo $r['pair'];?></td>
                                    <td><?php echo ($user['rightPower'] < $r['pair']) ? $user['rightPower'] : $r['pair'];?></td>
                                    <td><?php echo $r['trophy'];?></td>
                                    <td><?php echo ($user['leftPower'] >= $r['pair'] && $user['rightPower'] >= $r['pair']) ? '<span class="badge badge-success">Achieved</span>' : '<span class="badge badge-primary">Pending</span>';?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
