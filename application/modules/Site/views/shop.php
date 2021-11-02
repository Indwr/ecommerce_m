<?php include_once('header.php'); ?>
<style>
.pagination {
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: .25rem;
}
</style>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
<div class="container">
<div class="row">
<div class="col-md-12">
<a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Shop</a>
</div>
</div>
</div>
</section>
<section class="shop-list section-padding">
<div class="container">
<div class="row">
<div class="col-md-3">
<div class="shop-filters">
<div id="accordion">
<div class="card">
<div class="card-header" id="headingOne">
<h5 class="mb-0">
<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
Category <span class="mdi mdi-chevron-down float-right"></span>
</button>
</h5>
</div>
<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
<div class="card-body card-shop-filters">
<!-- <form class="form-inline mb-3">
<div class="form-group">
<input type="text" class="form-control" placeholder="Search By Category">
<button type="submit" class="pl-2 pr-2 btn btn-secondary btn-lg"><i class="mdi mdi-file-find"></i></button>
</div>
</form> -->
<?php foreach($allCategory as $ack => $ac):?>
<div class="custom-control custom-checkbox" onclick="loadDoc(<?php echo $ac['id'];?>)">
    <input type="checkbox" class="custom-control-input">
    <label class="custom-control-label" for="cb1"><?php echo $ac['category_name'];?></label>
</div>
<?php endforeach;?>
<!-- <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="cb8">
    <label class="custom-control-label" for="cb8">Fresh & Herbs <span class="badge badge-primary">5% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb2">
<label class="custom-control-label" for="cb2">Seasonal Fruits <span class="badge badge-secondary">NEW</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb3">
<label class="custom-control-label" for="cb3">Imported Fruits <span class="badge badge-danger">10% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb4">
<label class="custom-control-label" for="cb4">Citrus <span class="badge badge-info">50% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb5">
<label class="custom-control-label" for="cb5">Cut Fresh & Herbs</label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb6">
<label class="custom-control-label" for="cb6">Seasonal Fruits <span class="badge badge-success">25% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb7">
<label class="custom-control-label" for="cb7">Fresh & Herbs <span class="badge badge-primary">5% OFF</span></label>
</div> -->
</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingTwo">
    <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Price
            <span class="mdi mdi-chevron-down float-right"></span>
        </button>
    </h5>
</div>
<?php
if(!empty($id)){
    $v3 = $id;
}else{
    $v3 = 0;
}

?>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
    <div class="card-body card-shop-filters">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="1" onclick="loadDoc1(0,50,<?php echo $v3;?>)">
            <label class="custom-control-label" for="1">0 to 50</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="2" onclick="loadDoc1(50,500,<?php echo $v3;?>)">
            <label class="custom-control-label" for="2">50 to 500</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="3" onclick="loadDoc1(500,1000,<?php echo $v3;?>)">
            <label class="custom-control-label" for="3">500 to 1000</label>
        </div>
        <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="4" onclick="loadDoc1(1000,10000,<?php echo $v3;?>)">
                <label class="custom-control-label" for="4">1000 to 10000</label>
        </div>
    </div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingThree">
<h5 class="mb-0">
<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Brand <span class="mdi mdi-chevron-down float-right"></span>
</button>
</h5>
</div>
<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
<div class="card-body card-shop-filters">
<form class="form-inline mb-3">
<div class="form-group">
<input type="text" class="form-control" placeholder="Search By Brand">
</div>
<button type="submit" class="btn btn-secondary ml-2">GO</button>
</form>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="b1">
<label class="custom-control-label" for="b1">Imported Fruits <span class="badge badge-warning">50% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="b2">
<label class="custom-control-label" for="b2">Seasonal Fruits <span class="badge badge-secondary">NEW</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="b3">
<label class="custom-control-label" for="b3">Imported Fruits <span class="badge badge-danger">10% OFF</span></label>
</div>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="b4">
<label class="custom-control-label" for="b4">Citrus</label>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-header" id="headingThree">
<h5 class="mb-0">
<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
Imported Fruits <span class="mdi mdi-chevron-down float-right"></span>
</button>
</h5>
</div>
<div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
<div class="card-body">
<div class="list-group">
<a href="#" class="list-group-item list-group-item-action">All Fruits</a>
<a href="#" class="list-group-item list-group-item-action">Imported Fruits</a>
<a href="#" class="list-group-item list-group-item-action">Seasonal Fruits</a>
<a href="#" class="list-group-item list-group-item-action">Citrus</a>
<a href="#" class="list-group-item list-group-item-action disabled">Cut Fresh & Herbs</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="left-ad mt-4">
<img class="img-fluid" src="http://via.placeholder.com/254x557" alt="">
</div>
</div>
<div class="col-md-9">
<a href="#"><img class="img-fluid mb-3" src="img/shop.jpg" alt=""></a>
<div class="shop-head">
<a href="#"><span class="mdi mdi-home"></span> Home</a> <span class="mdi mdi-chevron-right"></span> <a href="#"><?php if(!empty($category['category_name'])) { echo $category['category_name'];}?></a> <span class="mdi mdi-chevron-right"></span> <a href="#"></a>
<div class="btn-group float-right mt-2">
<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Relevance</a>
<a class="dropdown-item" href="#">Price (Low to High)</a>
<a class="dropdown-item" href="#">Price (High to Low)</a>
<a class="dropdown-item" href="#">Discount (High to Low)</a>
<a class="dropdown-item" href="#">Name (A to Z)</a>
</div>
</div>
<h5 class="mb-3"><?php if(!empty($category['category_name'])) { echo $category['category_name'];}?></h5>
</div>
<div class="row">
    <?php foreach($product as $key => $p):?>
    <div class="col-md-4 pmb-3">
        <div class="product">
            <a href="<?php echo base_url('Site/Main/Addcart2/'.$p['id']);?>">
                <div class="product-header">
                    <!-- <span class="badge badge-success">50% OFF</span> -->
                    <img class="img-fluid" src="<?php echo base_url('uploads/'.$p['image']['image']);?>" alt="">
                    <?php if($p['status'] == 1){
                        echo '<span class="veg text-success mdi mdi-circle"></span>';
                    }else{
                        echo '<span class="veg text-danger mdi mdi-circle"></span>';
                    }
                    ?>

                </div>
                <div class="product-body">
                    <h5><?php echo $p['title'];?></h5>
                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $p['type'];?></h6>
                    <span>MRP : <?php echo $p['mrp'];?></span>
                    <span>DP :<?php echo $p['dp'];?></span>
                    <span>BV : <?php echo $p['bv'];?></span>
                </div>
                <div class="product-footer">
                    <?php if($p['quantity'] > 0){ ?>
                    <button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                    <?php } else {
                        echo '<span class="badge badge-danger">Stock not available</span>';
                    }
                    ?>
                </div>
            </a>
        </div>
    </div>
    <?php endforeach;?>
    <div class="col-md-12">
        <p>
            <?php echo $this->pagination->create_links();?>
        </p>
    </div>
<!-- <div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/2.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/3.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div> -->
</div>
<!-- <div class="row">
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/4.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/5.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/6.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
</div> -->
<!-- <div class="row">
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/7.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/8.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="col-md-4 pmb-3">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="img/item/9.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
<button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
</div> -->
<!-- <nav>
<ul class="pagination justify-content-center">
<li class="page-item disabled">
<span class="page-link">Previous</span>
</li>
<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item active">
<span class="page-link">
2
<span class="sr-only">(current)</span>
</span>
</li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#">Next</a>
</li>
</ul>
</nav> -->
</div>
</div>
</div>
</section>

<?php include_once('footer.php'); ?>
<script>
function loadDoc(val){
    window.location.href = "<?php echo base_url('Site/Main/Shop/?value=');?>" + val;
}

function loadDoc1(v1,v2,v3){
    if(v3 > 0){
        window.location.href = "<?php echo base_url('Site/Main/Shop/?value=');?>" + v3 +'&start='+ v1+ '&end='+v2;
    }else{
        window.location.href = "<?php echo base_url('Site/Main/Shop/?value=&start=');?>" + v1+ '&end='+v2;
    }
}
</script>
