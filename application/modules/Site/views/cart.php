<?php include_once('header.php'); ?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
<div class="container">
<div class="row">
<div class="col-md-12">
<a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
</div>
</div>
</div>
</section>
<section class="cart-page section-padding">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body cart-table">
                <div class="table-responsive">
                    <?php echo form_open('Site/Main/checkout');?>
                    <table class="table cart_summary">
                        <thead>
                            <tr>
                                <th class="cart_product">Product</th>
                                <th>Description</th>
                                <th>Avail.</th>
                                <th>Unit price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th class="action"><i class="mdi mdi-delete-forever"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;
                                if(!empty($cart)):
                                foreach($cart as $key => $c):?>
                                <input type="hidden" name="id[]" value="<?php echo $c['id'];?>">
                            <tr>
                                <td class="cart_product">
                                    <img class="img-fluid" src="<?php echo base_url('uploads/'.$c['image']['image']);?>" alt="">
                                </td>
                                <td class="cart_description">
                                    <h5 class="product-name"><input type="hidden" name="title[]" value="<?php echo $c['title'];?>"><?php echo $c['title'];?></h5>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $c['type'];?></h6>
                                </td>
                                <td class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                <td class="price"><input type="hidden" name="mrp[]" value="<?php echo $c['mrp'];?>">Rs.<span id="price<?php echo $c['id'];?>"><?php echo $c['mrp'];?></span></td>
                                <td class="qty">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-theme-round btn-number" type="button" onclick="itemDec(<?php echo $c['id'];?>)">-</button>
                                        </span>
                                        <input type="number" min="1" id="qnty<?php echo $c['id'];?>" onkeyup="myFunction(<?php echo $c['id'];?>)" value="<?php echo $c['quantity'];?>" class="form-control border-form-control form-control-sm input-number" name="quantity[]">
                                        <span class="input-group-btn">
                                            <button class="btn btn-theme-round btn-number" type="button" onclick="itemInc(<?php echo $c['id'];?>)">+</button>
                                        </span>
                                    </div>
                                </td>
                                <td class="price"><input type="hidden" name="total[]" value="<?php echo $c['total'];?>"><span id="totalP<?php echo $c['id'];?>">Rs.<?php echo $c['total'];?></span></td>
                                <td class="action">
                                    <button type="button" class="btn btn-sm btn-danger" data-original-title="Remove" onclick="removeItem(<?php echo $c['id'];?>)" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></button>
                                </td>
                            </tr>
                            <?php
                                $total += $c['total'];
                                endforeach; 
                                endif;
                                $_SESSION['totalAmount'] = $total;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr style="display:none;">
                                <td colspan="1"></td>
                                <td colspan="4">
                                    
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter discount code" class="form-control border-form-control form-control-sm">
                                        </div>
                                        &nbsp;
                                        <button class="btn btn-success float-left btn-sm" type="button">Apply</button>
                                    
                                </td>
                                <td colspan="2">Discount : 0 </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-right" colspan="3">Total products (tax incl.)</td>
                                <td colspan="2">Rs.<?php echo $total;?></td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="5"><strong>Total</strong></td>
                                <td class="text-danger" colspan="2"><strong>Rs.<?php echo $total;?> </strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- <a href="<?php //echo base_url('Site/Main/checkout');?>"> -->
                    <button class="btn btn-secondary btn-lg btn-block text-left" type="submit">
                        <span class="float-left">
                            <i class="mdi mdi-cart-outline"></i> 
                            Proceed to Checkout
                        </span>
                        <span class="float-right"><strong>Rs.<?php echo $total;?></strong> 
                            <span class="mdi mdi-chevron-right"></span>
                        </span>
                    </button>
                <!-- </a> -->
                <?php echo form_close();?>
            </div>
<!-- <div class="card mt-2 d-none">
    <h5 class="card-header">My Cart (Design Two)<span class="text-secondary float-right">(5 item)</span></h5>
    <div class="card-body pt-0 pr-0 pl-0 pb-0">
    <div class="cart-list-product">
    <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
    <img class="img-fluid" src="img/item/11.jpg" alt="">
    <span class="badge badge-success">50% OFF</span>
    <h5><a href="#">Product Title Here</a></h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
    </div>
    <div class="cart-list-product">
    <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
    <img class="img-fluid" src="img/item/1.jpg" alt="">
    <span class="badge badge-success">50% OFF</span>
    <h5><a href="#">Product Title Here</a></h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
    </div>
    <div class="cart-list-product">
    <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
    <img class="img-fluid" src="img/item/2.jpg" alt="">
    <span class="badge badge-success">50% OFF</span>
    <h5><a href="#">Product Title Here</a></h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
    </div>
</div> -->
    <!-- <div class="card-footer cart-sidebar-footer">
    <div class="cart-store-details">
    <p>Sub Total <strong class="float-right">$900.69</strong></p>
    <p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p>
    <h6>Your total savings <strong class="float-right text-danger">$55 (42.31%)</strong></h6>
    </div>
    <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>$1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
    </div> -->
</div>
</div>
</div>
</div>
</section>
<section class="section-padding bg-white border-top">
<div class="container">
<div class="row">
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-truck-fast"></i>
<h6>Free & Next Day Delivery</h6>
<p>Lorem ipsum dolor sit amet, cons...</p>
</div>
</div>
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-basket"></i>
<h6>100% Satisfaction Guarantee</h6>
<p>Rorem Ipsum Dolor sit amet, cons...</p>
</div>
</div>
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-tag-heart"></i>
<h6>Great Daily Deals Discount</h6>
<p>Sorem Ipsum Dolor sit amet, Cons...</p>
</div>
</div>
</div>
</div>
</section>
<script>
    function itemDec(item){
        let quantity = document.getElementById('qnty'+item).value;
        quantity--;
        if(quantity > 0){
            document.getElementById('qnty'+item).value = quantity;
            let price = document.getElementById('price'+item).innerHTML;
            let total = price * quantity;
            let url = "<?php echo base_url('Site/Main/updateCart/?');?>";
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    if(this.responseText == 'Quantity Added'){
                        document.getElementById('totalP'+item).innerHTML = '$'+total;
                        location.reload();
                    }
                }
            };
            xhttp.open("GET",url+'item='+item+'&qnty='+quantity, true);
            xhttp.send();
        }else{
            alert('Atleast 1 quantity required');
        }
    }

    function myFunction(item){
        let quantity = document.getElementById('qnty'+item).value;
        if(quantity > 0){
            document.getElementById('qnty'+item).value = quantity;
            let price = document.getElementById('price'+item).innerHTML;
            let total = price * quantity;
            let url = "<?php echo base_url('Site/Main/updateCart/?');?>";
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    if(this.responseText == 'Quantity Added'){
                        document.getElementById('totalP'+item).innerHTML = '$'+total;
                        location.reload();
                    }
                }
            };
            xhttp.open("GET",url+'item='+item+'&qnty='+quantity, true);
            xhttp.send();
            
        }else{
            alert('Atleast 1 quantity required');
        }
        
    }

    function itemInc(item){
        let quantity = document.getElementById('qnty'+item).value;
        quantity++;
        document.getElementById('qnty'+item).value = quantity;
        var price = document.getElementById('price'+item).innerHTML;
        var total = price * quantity;
        let url = "<?php echo base_url('Site/Main/updateCart/?');?>";
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                if(this.responseText == 'Quantity Added'){
                    document.getElementById('totalP'+item).innerHTML = '$'+total;
                    location.reload();
                }
            }
        };
        xhttp.open("GET",url+'item='+item+'&qnty='+quantity, true);
        xhttp.send();
    }

    function removeItem(item){
        let url = "<?php echo base_url('Site/Main/removecart/?');?>";
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {   
                location.reload();
            }
        };
        xhttp.open("GET",url+'item='+item, true);
        xhttp.send();
    }
</script>
<?php include_once('footer.php'); ?>
