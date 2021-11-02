<?php include 'header.php' ?>

<style>
.box-mainbody {
    border-style: double;
}
.box-head {
    padding: 51px 20px;
}
img.logo.img-fluid {
    max-width: 300px;
}
.company-detail span {
    display: block;
    padding: 6px 0px;
}
h3.payout-head {
    text-align: center;
    border-top-style: double;
    border-bottom-style: double;
    padding: 5px 0px;
    margin: 0px;
    font-size: 23px;
}
.box-body {
    border-bottom: 1px #212529 solid;
}
.br-right {
    border-right: 1px #000 solid;
    padding-right: 0px;
}
h4.detail {
    border-bottom: 1px #000 solid;
    text-align: center;
    font-size: 17px;
    text-transform: uppercase;
    margin: 0px;
    padding: 6px 0;
}
table {
    width: 100%;
    font-size: 15px;    
}
table tr, td {
    padding: 5px 11px;
}
table th {
    border-bottom: 1px #000 solid;
    padding: 4px 16px;
    font-size: 16px;
}
h4.payout-detail {
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    margin: 0px;
    padding: 7px 0;
}
.br-top{
  border-top: 1px #000 solid;
}
.total-amount {
    border-top-style: double;
}
@media screen and (min-width:768px ) and (max-width: 991px){
  img.logo.img-fluid {
    max-width: 200px;
}
}
</style>


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
          <div class="col-md-10 m-auto">
            <div class="box-mainbody">
            <div class="box-head">
              <div class="row">
              <div class="col-md-4 text-center mt-auto mb-auto">
              <img src="<?php echo base_url('uploads/logo.png');?>" class="logo img-fluid" >
              </div>
              <div class="col-md-7 offset-md-1">
                <div class="company-detail">
                  <h2>DealTaukri PVT.LTD</h2>
                  <span>Address : GT Road,Near Tinkoni,Bathinda(punjab)</span>
                  <span>Contact No : XXXXXXXXXX</span>
                  <span>Email ID : dealtaukri@gmail.com</span>
                  <span>URL : https://dealtaukri.com</span>
                </div>
              </div>
              </div>
            </div>
            <h3 class="payout-head">Payout Statement</h3>

            <div class="box-body">
              <div class="row">
                <div class="col-md-6 br-right ">
                    <h4 class="detail">details</h4>
                    <table>
                      <tr>
                        <td>Name</td>
                        <td>: <?php echo $userinfo['name'];?></td>
                      </tr>
                       <tr>
                        <td>ID</td>
                        <td>: <?php echo $userinfo['user_id'];?></td>
                      </tr>
                       <tr>
                        <td>Address</td>
                        <td>: <?php echo $userinfo['address'];?></td>
                      </tr>
                       <tr>
                        <td>Mobile NO.</td>
                        <td>: <?php echo $userinfo['phone'];?></td>
                      </tr>
                       <tr>
                        <td>City</td>
                        <td>: <?php echo $city['name'];?></td>
                      </tr>
                       <tr>
                        <td>State/Province</td>
                        <td>: <?php echo $state['name'];?></td>
                      </tr>
                       <tr>
                        <td>Pincode/Zipcode</td>
                        <td>: <?php echo $userinfo['postal_code'];?></td>
                      </tr>
                    </table>
                </div>
                 <div class="col-md-6 pl-0">
                    <h4 class="detail">Payout details</h4>
                    <table>
                      <tr>
                        <td>Company Payout No.</td>
                        <td>: XXXXXXXXX</td>
                      </tr>
                       <tr>
                        <td>My payout No.</td>
                        <td>: XXXXXXXXX</td>
                      </tr>
                       <tr>
                        <td>Period</td>
                        <td>: <?php echo $date;?></td>
                      </tr>
                    </table>

                </div>

              </div>
            </div>
             <h4 class="payout-detail">Payout detail</h4>
              <div class="box-body br-top">
                <div class="row">
                  <div class="col-md-6 br-right ">
                    <h4 class="detail">Amount</h4>
                    <table>
                    <?php 
                      if(!empty($user_incomes)){
                        foreach($user_incomes as $key => $ui):
                    ?>
                      <tr>
                        <td><?php echo ucwords(str_replace('_',' ',$ui['type']));?></td>
                        <td>: <?php echo round($ui['total'],2);?></td>
                      </tr>
                    <?php 
                        endforeach;
                      }else{
                        echo '<tr>
                                <td>No record Found</td>
                              </tr>';
                      }
                    ?>
                    </table>
                    <h4 class="detail br-top">Downline detail</h4>
                    <table>
                      <tr>
                        <td></td>
                        <td>Left</td>
                         <td>Right</td>
                        <td>Total</td>
                      </tr>
                       <tr>
                        <td>B.V</td>
                        <td> <?php echo $bv['left_bv'];?></td>
                        <td> <?php echo $bv['right_bv'];?></td>
                        <td> <?php echo ($bv['left_bv'] + $bv['right_bv']);?></td>
                      </tr>
                    </table>
                </div>
                 <div class="col-md-6 pl-0">
                    <table>
                      <tr>
                        <th>Deduction</th>
                        <th>Amount</th>
                      </tr>
                      <tr>
                        <td>TDS</td>
                        <td>: <?php echo round(($total_income['total_income']*5/100),2);?></td>
                      </tr>
                       <tr>
                        <td>Admin charges</td>
                        <td>: <?php echo round(($total_income['total_income']*10/100),2);?></td>
                      </tr>
                       <tr>
                        <td>Total</td>
                        <td>: <?php echo round(($total_income['total_income']*15/100),2);?></td>
                      </tr>
                    </table>

                    <div class="total-amount">
                      <table>
                      <tr>
                        <td>Total Amount</td>
                        <td> <?php echo round($total_income['total_income'],2);?></td>
                      </tr>
                       <tr>
                        <td>Charges</td>
                        <td> <?php echo round(($total_income['total_income']*15/100),2);?></td>
                      </tr>
                       <tr>
                        <td>Total Amount Payable</td>
                        <td> <?php echo round(($total_income['total_income']*85/100),2);?></td>
                      </tr>
                    </table>

                    </div>
                </div>

              </div>

                </div>
              </div>



            </div>
          </div>



          
        </div>
        <button onclick="window.print()">Print this page</button>

      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
