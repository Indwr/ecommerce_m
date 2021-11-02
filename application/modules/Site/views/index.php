<?php include_once('header.php'); ?>
<section class="osahan-carousel-two  border-top py-4">
<div class="container">
<div class="row">
<div class="col-lg-3">
<div class="category-list-sidebar">
<div class="category-list-sidebar-header">
<button class="btn btn-link badge-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
Product By Categories <i class="mdi mdi-menu" aria-hidden="true"></i>
</button>
</div>
<div class="collapse hide" id="collapseExample">
    <div class="category-list-sidebar-body">
        <?php foreach($category as $key => $c):?>
        <div class="item">
            <div class="sidebar-category-item">
                <a href="<?php echo base_url('Site/Main/shop/?value='.$c['id']);?>">
                    <img class="img-fluid" src="<?php echo base_url("uploads/".$c['image']); ?>" alt="">
                    <h6><?php echo $c['category_name'];?></h6>
                    <p><?php echo $c['product']['record'];?></p>
                </a>
            </div>
        </div>
        <?php endforeach;?>
        <!-- <div class="item">
            <div class="sidebar-category-item">
                <a href="shop.html">
                <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/2.jpg" alt="">
                <h6>Grocery & Staples</h6>
                <p>95</p>
                </a>
            </div>
        </div> -->
    <!-- <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/3.jpg" alt="">
    <h6>Beverages</h6>
    <p>65</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/4.jpg" alt="">
    <h6>Home & Kitchen</h6>
    <p>965</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/5.jpg" alt="">
    <h6>Furnishing & Home Needs</h6>
    <p>125</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/6.jpg" alt="">
    <h6>Household Needs</h6>
    <p>325</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/7.jpg" alt="">
    <h6>Personal Care</h6>
    <p>156</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/8.jpg" alt="">
    <h6>Breakfast & Dairy</h6>
    <p>857</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/9.jpg" alt="">
    <h6>Biscuits, Snacks & Chocolates</h6>
    <p>48</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/10.jpg" alt="">
    <h6>Noodles, Sauces & Instant Food</h6>
    <p>156</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/11.jpg" alt="">
    <h6>Pet Care</h6>
    <p>568</p>
    </a>
    </div>
    </div>
    <div class="item">
    <div class="sidebar-category-item">
    <a href="shop.html">
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/small/12.jpg" alt="">
    <h6>Meats, Frozen & Seafood</h6>
    <p>156</p>
    </a>
    </div>
    </div> -->
</div>
</div>
</div>
</div>
</div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="carousel-slider-main text-center">
            <div class="owl-carousel owl-carousel-slider rounded overflow-hidden shadow-sm">
                <?php foreach($sliderFirst as $first => $sf):?>
                    <div class="item">
                        <a href="shop.html"><img class="img-fluid w-100" src="<?php echo base_url("uploads/".$sf['image']); ?>" alt="First slide"></a>
                    </div>
                <?php endforeach;?>
            <!-- <div class="item">
            <a href="shop.html"><img class="img-fluid w-100" src="<?php //echo base_url("uploads/"); ?>slider-img2.jpg" alt="First slide"></a>
            </div> -->
          <!--   <div class="item">
            <a href="shop.html"><img class="img-fluid w-100" src="<?php //echo base_url("SiteAssets/"); ?>img/slider/slider1.jpg" alt="First slide"></a>
            </div>
            <div class="item">
            <a href="shop.html"><img class="img-fluid w-100" src="<?php //echo base_url("SiteAssets/"); ?>img/slider/slider2.jpg" alt="First slide"></a>
            </div> -->
            </div>
            </div>
        </div>
         </div>
     </div>

</section>

<!-- owl slider section Start -->
    <div class="container">
        <div class="row">
    <div class="col-lg-12">
            <div class="carousel-slider-main text-center mt-5 mb-5">
            <div class="owl-carousel owl-carousel-slider rounded overflow-hidden shadow-sm">
            <?php foreach($sliderSecond as $second => $ss):?>
            <div class="col-md-12 item">
                <div class="row">
                    <div class="col-md-6 item zoom-img">
                        <a href="#"><img class="img-fluid w-100" src="<?php echo base_url("uploads/".$ss['image']); ?>" alt="First slide"></a>
                    </div>
                    <div class="col-md-6 item zoom-img">
                        <a href="#"><img class="img-fluid w-100" src="<?php echo base_url("uploads/".$ss['image']); ?>" alt="First slide"></a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <!-- <div class="item">
                <div class="row">
                        <div class="col-md-6 item zoom-img">
                            <a href="#"><img class="img-fluid w-100" src="<?php //echo base_url("uploads/"); ?>sub-bnr3.jpg" alt="First slide"></a>
                        </div>
                        <div class="col-md-6 item zoom-img">
                            <a href="#"><img class="img-fluid w-100" src="<?php //echo base_url("uploads/"); ?>sub-bnr4.jpg" alt="First slide"></a>
                        </div>
                    </div>
            </div> -->

            </div>
            </div>
        </div>        </div>
    </div>
<!-- owl slider section Ends -->

<!-- Sub banner Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="banner-img mt-4 mb-4">
                <img src="<?php echo base_url('uploads/slider-img1.jpg');?>" class="img-fluid">

            </div>



        </div>
    </div>

<!-- Sub banner ends -->




<section class="product-items-slider section-padding">
<div class="container">
<div class="section-header">
<h5 class="heading-design-h5">Top Savers Today
<a class="float-right text-secondary" href="shop.html">View All</a>
</h5>
</div>
<div class="row">
    <?php foreach($product as $pk => $p):?>
    <div class="col-md-3 col-xs-12 mb-4">
        <div class="product">
            <a href="<?php echo base_url('Site/Main/product_detail/'.$p['id']);?>">
                <div class="product-header">
                    <!-- <span class="badge badge-success">50% OFF</span> -->
                    <img class="img-fluid" src="<?php echo base_url("uploads/".$p['image']['image']); ?>" alt="">
                    <span class="veg text-success mdi mdi-circle"></span>
                </div>
                <div class="product-body">
                    <h5><?php echo $p['title'];?></h5>
                        <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $p['type'];?></h6>
                        <span>MRP : <?php echo $p['mrp'];?></span>
                        <!-- <span>DP :<?php echo $p['dp'];?></span>
                        <span>BV : <?php echo $p['bv'];?></span> -->
                </div>
                <!-- <div class="product-footer">
                    <p class="offer-price mb-0">$<?php //echo $p['sprice'];?> <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$<?php // echo $p['mrp'];?></span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div> -->
            </a>
        </div>
    </div>
    <?php endforeach;?>
    <!-- <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/2.jpg" alt="">
    <span class="non-veg text-danger mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/3.jpg" alt="">
    <span class="non-veg text-danger mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/4.jpg" alt="">
    <span class="veg text-success mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/5.jpg" alt="">
    <span class="veg text-success mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/6.jpg" alt="">
    <span class="veg text-success mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/7.jpg" alt="">
    <span class="veg text-success mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div>
    <div class="col-md-3 col-xs-12 mb-4">
    <div class="product">
    <a href="single.html">
    <div class="product-header">
    <span class="badge badge-success">50% OFF</span>
    <img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/8.jpg" alt="">
    <span class="veg text-success mdi mdi-circle"></span>
    </div>
    <div class="product-body">
    <h5>Product Title Here</h5>
    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
    </div>
    <div class="product-footer">
    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
    </div>
    </a>
    </div>
    </div> -->
</div>
</div>
</section>
<section class="offer-product">
<div class="container">
<div class="row no-gutters">
<div class="col-md-6">
<a href="#"><img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/ad/1.jpg" alt=""></a>
</div>
<div class="col-md-6">
<a href="#"><img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/ad/2.jpg" alt=""></a>
</div>
</div>
</div>
</section>
<section class="product-items-slider section-padding">
<div class="container">
    <div class="section-header">
        <h5 class="heading-design-h5">Best Offers View <!-- <span class="badge badge-info">20% OFF</span> -->
            <a class="float-right text-secondary" href="shop.html">View All</a>
        </h5>
</div>
<div class="owl-carousel owl-carousel-featured">
    <?php foreach($product2 as $pk2 => $p2):?>
    <div class="item">
        <div class="product">
            <a href="<?php echo base_url('Site/Main/product_detail/'.$p2['id']);?>">
                <div class="product-header">
                    <!-- <span class="badge badge-success">50% OFF</span> -->
                    <img class="img-fluid" src="<?php echo base_url("uploads/".$p2['image']['image']); ?>" alt="">
                    <span class="veg text-success mdi mdi-circle"></span>
                </div>
                <div class="product-body">
                    <h5><?php echo $p2['title'];?></h5>
                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $p2['type'];?></h6>
                    <span>MRP : <?php echo $p2['mrp'];?></span>
                    <span>DP :<?php echo $p2['dp'];?></span>
                    <span>BV : <?php echo $p2['bv'];?></span>
                </div>
                <!-- <div class="product-footer">
                    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div> -->
            </a>
        </div>
    </div>
    <?php endforeach;?>
<!-- <div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/8.jpg" alt="">
<span class="non-veg text-danger mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/9.jpg" alt="">
<span class="non-veg text-danger mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/10.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
 </div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/11.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/12.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div> -->
</div>
</div>
</section>

<section class="product-items-slider section-padding">
<div class="container">
    <div class="section-header">
        <h5 class="heading-design-h5">New Arrivals<!-- <span class="badge badge-info ml-4">20% OFF</span> -->
            <a class="float-right text-secondary" href="shop.html">View All</a>
        </h5>
    </div>
<div class="owl-carousel owl-carousel-featured">
    <?php foreach($product3 as $pk3 => $p3):?>
    <div class="item">
        <div class="product">
            <a href="<?php echo base_url('Site/Main/product_detail/'.$p3['id']);?>">
                <div class="product-header">
                    <!-- <span class="badge badge-success">50% OFF</span> -->
                    <img class="img-fluid" src="<?php echo base_url("uploads/".$p3['image']['image']); ?>" alt="">
                    <span class="veg text-success mdi mdi-circle"></span>
                </div>
                <div class="product-body">
                    <h5><?php echo $p3['title'];?></h5>
                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $p3['type'];?></h6>
                    <span>MRP : <?php echo $p3['mrp'];?></span>
                    <span>DP :<?php echo $p3['dp'];?></span>
                    <span>BV : <?php echo $p3['bv'];?></span>
                </div>
                <!-- <div class="product-footer">
                    <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div> -->
            </a>
        </div>
    </div>
    <?php endforeach;?>
<!-- <div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/8.jpg" alt="">
<span class="non-veg text-danger mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/9.jpg" alt="">
<span class="non-veg text-danger mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/10.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
 </div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/11.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="single.html">
<div class="product-header">
<span class="badge badge-success">50% OFF</span>
<img class="img-fluid" src="<?php echo base_url("SiteAssets/"); ?>img/item/12.jpg" alt="">
<span class="veg text-success mdi mdi-circle"></span>
</div>
<div class="product-body">
<h5>Product Title Here</h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
</div>
<div class="product-footer">
<p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p><button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
</div>
</a>
</div>
</div> -->
</div>
</div>
</section>
<?php if($popup['status'] == 0):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $popup['caption'];?></h4>
            </div>
            <div class="modal-body">

                <?php
                if($popup['type'] == 'video')
                    echo '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'.$popup['media'].'"></iframe>';
              else
                  echo '<img src="'.base_url('uploads/'.$popup['media']).'">';
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>



<section class="product-items-slider section-padding">
<div class="container">
<div class="section-header">
<h2 class="text-center mb-2">Papular Brand</h2>
</h5>
</div>
<div class="owl-carousel owl-carousel-featured">
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img1.png"); ?>" alt="">
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img2.png"); ?>" alt="">
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img3.png"); ?>" alt="">
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img4.png"); ?>" alt="">
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img5.png"); ?>" alt="">
</div>
</a>
</div>
</div>
<div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img6.png"); ?>" alt="">
</div>
</a>
</div>
</div>
    <div class="item">
<div class="product">
<a href="#">
<div class="product-header">
<img class="img-fluid" src="<?php echo base_url("uploads/brand-img7.png"); ?>" alt="">
</div>
</a>
</div>
</div>
</div>
</div>
</section>



<?php include_once('footer.php'); ?>
