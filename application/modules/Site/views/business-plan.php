<?php include_once('header.php'); ?>
<style>
    .page-title {
        background: #00B4DB;
        background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
        background: linear-gradient(to right, #0083B0, #00B4DB);
        border: 0;
        color: #fff;
        text-align: center;
        padding: 100px 0;
        margin-bottom: 100px;
    }
     .page-title h2{

        color: #fff;
    }
    .price{
        margin-bottom: 50px;
    }
</style>
<div class="page-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <h2>Business Plan</h2>
                <p>Enjoy real benefits and rewards on your accrue investing.</p>
            </div>
        </div>
    </div>
</div>
<div class="price">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6">
                <div class="section-title text-center">
                    <h2>Grab our mega package</h2>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div class="card-body">
                    <a type="button" class="btn btn-dark" href="<?php echo base_url('uploads/'.$pdf_file['pdf']);?>" download=""> Download</a>
                    <div class="<?php echo base_url('uploads/plannew.pdf');?>">
                        <?php if(!empty($pdf_file['pdf'])){?>
                        <iframe src="<?php echo base_url('uploads/'.$pdf_file['pdf']);?>" style="width:100%;height:1000px;">
                        <?php }else{
                            echo 'No Business Plan is available';
                        }
                        ?>
                        </iframe>
                    </div>
                </div>

                <hr>


            </div>

        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>
