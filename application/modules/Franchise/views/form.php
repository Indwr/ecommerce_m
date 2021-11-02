<?php
include_once 'header.php';
?>
<script src="<?php echo base_url('classic/assets/plugin/'); ?>jquery.js"></script>
<script src="<?php echo base_url('classic/assets/plugin/'); ?>croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url('classic/assets/plugin/'); ?>croppie.css"/>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Password Reset</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="bg-white p-4">
                        <h2 class="text-center">
                            <?php 
                                echo validation_errors();
                                echo $this->session->flashdata('message'); 
                            ?>
                        </h2>
                        <?php echo form_open(); ?>                        
                        <?php echo $form;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
