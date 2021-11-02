<?php 
	require_once 'header.php'
;?>

<div class="product-detail-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 product-heading text-center">
				<h3>Product detail</h3>
				<ul>
					<li>
						<a href="">Home / </a>

					</li>
					<li class="active"> Product detail</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container pd-60">
	<div class="row">
		<div class="col-md-5 product-detail-img">
			<img src="<?php echo base_url('uploads/'.$image['image']);?>">
		</div>
		<div class="col-md-7 product-detail-text">
			<h3><?php echo $product['title'];?></h3>
			<div class="product-ranking">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</div>
			<h4>Rs.<?php echo $product['mrp'];?></h4>
			<div class="product-price">
				<span><strong>BV: </strong><?php echo $product['bv'];?></span>
				<span><strong>SKU Code:</strong>XXXXXX</span>
				<span><strong>Availability: <?php echo $product['type'];?></strong>In Stock</span>
			</div>
			<div class="product-description">
				<h4>Product Description</h4>
				<p><?php echo $product['description'];?></p>
			</div>
			<div class="product-footer">
				<a href="<?php echo base_url('Site/Main/Addcart/'.$product['id']);?>">
					<?php if($product['quantity'] > 0){ ?>
					<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
					<?php }else{ echo '<span class="badge badge-danger">Stock not availabe</span>';} ?>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- <div class="container">
<div class="row">
<div class="description-text">

    <div class="container">

     
      <ul class="nav nav-tabs">
        <li class="active"><a href="#Home" data-toggle="tab">Description</a></li>
        <li><a href="#Product" data-toggle="tab">Product Handling</a></li>
       
      </ul>
      
      
      <div class="tab-content">
        <div id="Home" class="tab-pane fade in active show">
          	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>
        <div id="Product" class="tab-pane fade">
         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>
        
      </div>
    
   </div>
    
</div>
</div>
</div> -->
<!-- Tabs content -->





<?php 
	require_once 'footer.php'
;?>