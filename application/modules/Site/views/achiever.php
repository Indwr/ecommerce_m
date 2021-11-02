<?php include_once('header.php'); ?>
<section class="section-padding bg-dark inner-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-0 mb-3 text-white"><?php echo $header;?></h1>
                <div class="breadcrumbs">
                    <p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-white"><?php echo $header;?></span></p>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="section-padding bg-white">
    <div class="section-title text-center mb-5">
        <h2><?php echo $header2;?></h2>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach($tr as $key => $d):?>
                <?php echo $d;?>
            <?php endforeach;?>
        </div>
    </div>
</section>

<?php include_once('footer.php'); ?>
