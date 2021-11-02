<?php $this->load->view('header'); 
$userinfo = userinfo();
?>
<div class="content-wrapper" style="min-height: 378px;">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0 text-dark"></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active"><?php //echo $header; ?></li>
                  </ol>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <div class="content">
    <div class="container-fluid">
    <div class="row">
          <div class="col-12">
            <div class="callout callout-info" style="display:none;">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12 text-center">
                  <img src="<?php echo base_url(logo);?>" style="width:250px;"> <?php //echo title;?>
                  <h3 class="">
                    INVOICE
                  </h3>

                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Company details
                  <address>
                    <strong>Justin Life</strong><br>
                    GSTIN No. 03AAQFJ4459A1ZI
                    <br>
                    Regd. Address:Near ATAM VALLABH JAIN SCHOOL <br>
                    Bathinda Road Sunam Sangrur PB (148028)<br>
                    Contact No: +91- 1676-500216<br>
                    Email: justinlife2021@gmail.com<br>
                    Website: <?php echo base_url();?><br>

                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <!-- Franchise Details
                  <address>
                    <strong><?php //echo $franchise['user_id'];?></strong><br>
                    <?php //echo $franchise['address'];?><br>
                    Phone: <?php //echo $franchise['phone'];?><br>
                    Email: <?php //echo $franchise['email'];?><br>
                   
                  </address> -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice No. #<?php //echo $order['order_id']?></b><br>
                  <b>Invoice Date. <?php echo date('d-M-Y', strtotime($user['created_at']))?></b><br>
                  <b>User ID:</b> <?php echo $userinfo->user_id;?><br>
                  <b>User Name:</b> <?php echo $userinfo->name;?><br>
                  <b>Pan:</b> <?php //echo $bank['pan'];?><br>
                  <b>Address:</b> <?php echo $userinfo->address;?><br>
                  <b>Mobile:</b> <?php echo $userinfo->phone;?><br>
                  State: <?php echo $state['name'];?> - <?php echo $state['gstcode'];?><br>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SL. No.</th>
                      <th>Product Name</th>
                      <th>HSN Code</th>
                      <th>MRP</th>
                      <th>GST</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $total_price = 0;
                    $total_bv = 0;
                    $gst = 0;
                    foreach($products as $key => $ord){
                        // pr($order);
                      echo'<tr>';
                      echo'<td>'.($key + 1).'</td>';
                      echo'<td>'.($ord['title']).'</td>';
                      echo'<td>'.($ord['hsn']).'</td>';
                      echo'<td>'.($ord['mrp']).'</td>';
                      echo'<td>'.($ord['sgst']).'%</td>';
                      echo'<td>1</td>';
                      echo'<td>'.($ord['mrp']).'</td>';
                      echo'</tr>';
                      $total_price = $total_price + ($ord['mrp']);
                    //   $total_bv = $total_bv + ($ord['bv'] * $ord['quantity']);
                      $igst = $ord['igst'];
                      $sgst = $ord['sgst'];
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <!-- <p class="lead">Payment Methods:</p> -->

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <!-- <b>Tax summary</b> <br>

                    CGST Detail : 00.00 @0.00% |<br>

                    SGST Detail : 00.00 @0.00% |<br> -->
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                      <?php
                    //   pr($order);
                      ?>
                    <table class="table">
                      <tbody>
                          
                      <tr>
                        <th>Total Price</th>
                        <td>Rs.<?php echo $total_price;?></td>
                      </tr>
                      <tr>
                        <th>Discount</th>
                        <td>Rs.0</td>
                      </tr>
                      <tr>
                        <th>Coupan Discount</th>
                        <td>Rs.0</td>
                      </tr>
                      
                      <?php
                        $order_amount = $total_price;
                        $tax =  $order_amount - ($order_amount / (100 + $sgst) * 100);
// echo 'this is main order amount' .$order_amount . ' - ('.$order_amount.' / '.(100 + $sgst).' * 100) and tax is ' . $tax;
                    //   $gt = ($order_amount / (100 + $sgst +$sgst )* 100);
                    //   $tax = $order['amount'] - $gt;
                    // //   $tax = $order_amount - ($order_amount / (100 + $sgst )* 100);
                        if($userinfo->state == 32){
                            echo' <tr>
                                <th>SGST</th>
                                <td>Rs.'.number_format(($tax / 2),2).'</td>
                            </tr>';
                        }
                        ?>
                    <tr>
                      <tr>
                        <th>CGST</th>
                        <td>Rs.<?php echo number_format($tax / 2,2);?></td>
                      </tr>
                      <tr>
                        <th>Grand Total</th>
                        <td>Rs.<?php echo  number_format($order_amount - $tax,2) ;?></td>
                      </tr>
                      <tr style="background:#f9f9f9">
                        <th>Payable Total</th>
                        <td>Rs.<?php echo $order_amount ;?></td>
                      </tr>
                      <tr>
                        <th colspan="2">(inclusive all taxes)</th>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="col-md-12">
              <h3>Company Bank Details</h3>
                  <h3 style="font-size:18px">JUST IN LIFE<br>
A/C 30690210001080<br>
IFSC CODE UCBA0003069<br>
UCO BANK, SUNAM (SANGRUR)</h3>

              </div>
              <div class="row no-print">
                  
                <p class="text-danger">
                Note: if someone's product turn out to be defective, They can replace the product within 45 days to company and get a new product.But product
                must not be opened.
                </p>
                <div class="col-12" style="">
                  <button href="invoice-print.html" target="_blank" class="btn btn-default" onclick="pageprint()"><i class="fas fa-print"></i> Print</button>
                  <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> -->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>
    </div>
  </div>
</div>
<?php $this->load->view('footer'); ?>
<script>
function pageprint(){
  window.print() ;
}
</script>
