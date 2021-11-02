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
<div class="container">
<div class="row">

<div class="col-md-6">
    <?php
    if(!empty($editFrom)):
        echo $this->session->flashdata('message');
        echo form_open('Site/Profile/editProfile'); 
        echo $editFrom;
        echo form_close();
    endif;
    ?>
</div>

<div class="col-md-6">
    <?php 
        if(!empty($passwordFrom)):
            echo $this->session->flashdata('message1');
            echo form_open('Site/Profile/changePassword'); 
            echo $passwordFrom;
            echo form_close();
        endif;
    ?>
</div>
</div>
</div>
</section>







<?php include_once('footer.php'); ?>
