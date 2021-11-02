
<div class="color-scheme-01">
    <!DOCTYPE HTML>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="HandheldFriendly" content="true" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo title; ?></title>
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <link href="<?php echo base_url('classic/register/'); ?>css/font-awesome.min.css" rel="stylesheet">
<!--            <link href="<?php // echo base_url('classic/register/');                                     ?>css/bootstrap.min.css" rel="stylesheet" media="screen">-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url('classic/register/'); ?>css/all_Jworld.css?v=3.7" media="all">
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-1.12.1.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-migrate-1.4.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/CustomJScript.js?v=2.1"></script>

            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <style>

                 body{
                    font-family: 'Poppins', sans-serif;
                }
                .form-wrapper {
                    max-width: 520px;
                    margin: 0 auto;
                    padding: 20px 40px;
                    background: #fff;
                    box-shadow: 0px 0px 250px 0px rgba(69, 81, 100, 0.1);
                }

                .form-control {
                    padding: 12px 20px;
                    background-color: #f3f6ff;
                    border: 0;
                    text-indent: 25px;
                }
                .form-group label {
                    color: #3f4b6e;
                    font-size: 16px;
                    font-weight: 600;
                    margin-bottom: 13px;
                }
                .btn {
                    padding: 10px 15px;

                }
                .btn-gredient{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background:linear-gradient(45deg,#c194fc,#7744dc); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    border: 0;
                    color: #fff;
                    padding: 15px 15px;
                    font-size: 18px;
                    line-height: 1.5;
                    border-radius: 10px;
                }
                .btn-gredient:focus,
                .btn-gredient:active,
                .btn-gredient:hover{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background:linear-gradient(45deg,#7441db,#c89cff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    border: 0;
                }
                .forgot-password{
                    color: #575f84;
                    font-weight: 600;
                }
                .columns{
                    min-height: 100vh;display: flex;align-items: center;justify-content: center;
                }
                .page-title{
                    /*background: #00B4DB;   
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
                    background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ 
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;*/

                    color: #000 !important;
                    text-transform: uppercase;
                    font-weight: bold;
                }
                .main-gredient{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                }
                .book-content {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    justify-content: center;
                    align-items: center;
                    align-content: center;
                    display: flex;
                    background: rgba(53, 169, 157,0.2);
                }
                .book-content-inner{
                    padding: 30px;
                    background: #fff;
                    max-width: 450px;
                }

                .book-content-inner img {
                    max-width: 100%;
                    height: auto;
                }

                .clients-wrapper span{
                    display: flex;
                    align-items: center;
                    padding: 15px;
                    background-color: #fff;
                    height: 100px;
                    border-radius: 10px;
                    box-shadow: 0 0 2px rgba(0,0,0,0.14), 0 0 2px rgba(0,0,0,0.06);
                    margin-bottom: 30px;
                } 
                 div#wrapper
                  {

                    background: url(https://dealtaukri.com/uploads/forget-bg.jpg);
/*                  background-color: #0b2239;*/                    
                    background-size:cover;
                    background-position: center;
                  }
                     .feild-icon {
                        display: inline;
                        position: absolute;
                        color: #6c89c0;
                        padding:12px 18px;
                        font-size: 20px;
                    }
                  .form-group.account-change {
                        background: #ea5e20;
                        padding:9px 0;
                        font-size: 17px;
                        color: #fff;
                        border-radius: 5px;
                    }
                    .sign-in-btn{
                        color: #ffffff !important;
                        /* font-weight: 600; */
                        background: #0677bd;
                        color: #fff;
                        padding: 7px 12px;
                        font-size: 15px;
                        text-decoration: none;
                        border-radius: 2px;
                    }
            </style>
        </head>
        <body>
            <div id="wrapper" class="joffice">
                <div id="main" class="main">
                    <div class="">


                        <div class="row no-gutters">

                            <div class="col-12 col-md-12 columns">
                                <div class="form-wrapper">

                                    <div class="page-header text-center">
                                        <img src="<?php echo base_url(logo); ?>" style="max-width:260px;padding: 15px;border-radius: 10px;margin: 0;margin-bottom: 20px;">
                                        <h4 class="page-title">Forgot Password</h4>
                                        <p class="small mb-4">Please enter your UserId to Reset your password!</p>
                                    </div>
                                    <div class="panel panel-primary">



                                            <div class="panel-body">
                                                <div class="details password-form">

                                                  <?php echo form_open(base_url('Dashboard/forgot_password/')); ?>
                                                    <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
                                                  <div class="panel-body">
                                                      <div class="details password-form">
                                                          <fieldset>
                                                              <div class="form-group">
                                                                  <!-- <div class="label-area">
                                                                      <label>User ID:</label>
                                                                  </div> -->
                                                                   <div class="feild-icon">
                                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                    </div>
                                                                  <div class="row-holder">
                                                                      <input id="SiteURL" type='text' name='user_id' maxlength='50' class="form-control" placeholder="User ID Or Email"/>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group" style="text-align: right; padding-right: 18px;">
                                                                  <button id="signupBtn" type="submit" class="btn btn-gredient btn-block" name='Submit' value='Login'>Reset Account </button>
                                                              </div>

                                                          </fieldset>
                                                      </div>
                                                  </div>
                                                  <?php echo form_close(); ?>



                                                    <div class="form-group text-center">
                                                        Don't have an account? <a href="<?php echo base_url(); ?>Dashboard/User/Register" style="color: #575f84;font-weight: 600;">Click Here</a>
                                                    </div>
                                                    <div class="form-group account-change ">
                                                        <center class="text-bold"><h4>Back to <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="sign-in-btn">Login</a></h4></center>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.jqplot.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/excanvas.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/jquery.main.js"></script>
                <script type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/bootstrap.min.js"></script>
                <script language="JavaScript" type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/wz_tooltip.js"></script>
            </div>
        </body>
    </html>
</div>
