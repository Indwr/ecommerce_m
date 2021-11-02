
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <!-- Meta Tags -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="DWAY Life | We facilitate a world-class investment platform for our clients across the globe.">
        <meta name="keywords" content="DWAY Life | We facilitate a world-class investment platform for our clients across the globe.">

        <!-- Title -->
        <title><?php echo title; ?></title>
        <link href="<?php echo base_url('classic/assets/css/site.css'); ?>" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">




        <link rel="stylesheet" href="https://cdn.bimboo.com.br/layout/owlcarousel/1.3.3/owl.carousel.css">
        <script src="https://cdn.bimboo.com.br/layout/owlcarousel/1.3.3/owl.carousel.js"></script>

    </head>
    <body>
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="register-login">
                                <div class="col-md-8">
                                    <div class="msg-icon">
                                        <ul>
                                            <li><i class="far fa-envelope"></i><a href="soarwaylife@gmail.com">info@dway.com</a></li>
                                            <!--<li><i class="fas fa-map-marker-alt"></i>P. No. 98/Kh. 112, Shanti Vihar, Basni Tamboliya</li>-->
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="rgister-btn">
                                        <ul>
                                            <li><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></li>
                                            <li><a href="<?php echo base_url('Dashboard/User/login'); ?>">LOGIN</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hd-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="logo-menu">
                                    <a href="index.php"><img src="<?php echo base_url('classic/logo.png'); ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="home-menu">
                                    <ul>
                                        <li><a href="index.php">HOME</a></li>
                                        <li><a href="about.php">COMPANY</a></li>
                                        <li><a href="product.php">PRODUCTS</a></li>
                                        <li><a href="brand.php">BRANDS</a></li>
                                        <li><a href="news.php">NEWS</a></li>
                                        <li><a href="blog.php">LEGAL</a></li>
                                        <li><a href="gallery.php">GALLERY</a></li>
                                        <li><a href="sechdule.php">SCHEDULE</a></li>
                                        <li><a href="branch.php">BRANCHES</a></li>
                                        <!-- <li><a href="#">CONTACT AS</a></li> -->

                                    </ul>
                                </div>
                                <div class="dd">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="index.php">HOME</a><br>
                                            <a class="dropdown-item" href="about.php">COMPANY </a><br>
                                            <a class="dropdown-item" href="product.php">PRODUCTS</a><br>
                                            <a class="dropdown-item" href="brand.php">BRANDS</a><br>
                                            <a class="dropdown-item" href="news.php">NEWS</a><br>
                                            <a class="dropdown-item" href="gallery.php">GALLERY</a><br>
                                            <a class="dropdown-item" href="sechdule.php">SECHDULE</a><br>
                                            <a class="dropdown-item" href="branches.php">BRANCHES </a><br>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="popup">



                                <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <div class="modal-title">
                                                    <h4>Login Your Account</h4>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="popin-user">
                                                    <form>
                                                        <a href="#"><i class="fas fa-user"></i></a><input type="text" name="first name" placeholder="Enter Username">
                                                    </form>
                                                </div>
                                                <div class="popin-lock">
                                                    <form>
                                                        <a href="#"><i class="fas fa-eye"></i></a><input type="password" name="psw" placeholder="Enter Password">
                                                    </form>
                                                </div>
                                                <div class="popin-btn">
                                                    <a href="#">SUBMIT</a>
                                                </div>
                                                <div class="forget">
                                                    <div class="forget-btn">
                                                        <a href="#">Forgot Password</a>
                                                    </div>
                                                    <div class="popi">
                                                        <a href="#">Register Now</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <div class="popi-logo">
                                                    <img src="<?php echo base_url('classic/logo.png'); ?>">
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <style>
            .login-part {

                background: #fff !important;
                float:left
            }
            .rgister-part-main.box-outer
            {
                margin: 0px auto;
                max-width:600px;
            }
            .banner video
            {
                display:none;
            }
            section.contact {
                z-index: 1;
                overflow: hidden;
                position: static;
                width: 100%;
                float: left;
            }
            .log-input {
                width: 100%;
                float: left;
                padding: 5px;
                margin: 5px 0px;
            }
            .video-foreground, .banner iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: visible;
                z-index: 111;
            }
            .login-part {
                background:url(https://SolwinMarketing.com/assets/img/advantage-bg.jpg); background-size:cover;
            }
            .log-box input[type=submit] {
                border: #01941c 1px solid !important;
                background: #00bc22 !important;
                background-image: linear-gradient(to top, #00bc22 50%, transparent 50%) !important;
            }
            @media only screen and (max-width: 479px) {
                .rgister-part-main {
                    margin: 10px auto 50px auto !important;
                    width: 100% !important;
                }
                .rgister-part-main .text-box {
                    width: 100% !important;
                }
            }
            .login-part {
                padding: 20px;
            }
            .signupdiv {
                border-radius: 20px;
                text-align: center;
                display: table;
                margin: 0px auto;
                padding: 0px 20px;
                margin-bottom: 20px;
            }


            .bg-primary-dark .button-primary, .context-dark .button-primary, .footer-1 .button-primary {
                color: #ffffff;
                background-color: #ffb467;
            }

            .log-input {
                width: 100%;
                float: left;
                padding: 5px;
                margin: 5px 0px;
                /* -webkit-box-shadow: -1px 2px 41px 2px rgba(0,0,0,0.75); */
                -moz-box-shadow: -1px 2px 41px 2px rgba(0,0,0,0.75);
                /* box-shadow: -1px 2px 41px 2px rgba(0,0,0,0.75); */
                border: 1px #868282 solid;
                border-radius: 10px;
                padding: 10px;
                -webkit-box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
                box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
            }
            .login-part
            {

                -webkit-box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
                box-shadow: -1px 2px 17px -2px rgba(0,0,0,0.75);
                border-radius:20px;
            }
        </style>
        <div class="midpart p-t-b-95">
            <section class="" style="background:url(http://www.bigdataforhumans.com/media/1164/gdpr_success-1.jpeg); background-size:cover; padding:40px 0px">
                <div class="login_page">
                    <div class="container">
                        <div class="row">
                            <div class="rgister-part-main box-outer">
                                <div class="login-part main_box">
                                    <div style="" class="signupdiv"></div>
                                    <h2 style="text-align:center; margin-bottom:0px">Sign Up For
                                        <span style="color:#fe1010">New Account</span>
                                    </h2> 
                                    <p style="text-align:center; color:red; font-size:20px;" ><?php echo $message;?></p>
                                    <div id="CPH1_Up1">
                                        <div class="log-box">
                                            <?php echo form_open(base_url('Site/Main/Register'), array('id' => 'registrationForm')); ?>
                                            <div id="CPH1_vs1" class="alert alert-warning toolErrorSummary" style="display:none;"></div>
                                            <div class="text-box">
                                                <?php
                                                echo form_input(array(
                                                    'type' => 'text',
                                                    'name' => 'sponser_id',
                                                    'id' => 'sponser_id',
                                                    'onBlur' => 'check_sponser()',
                                                    'class' => 'log-input',
                                                    'placeholder' => 'Sponsor ID',
                                                    'required' => 'true',
                                                ));
                                                ?>
                                                <div id="usernamechk"></div>
                                            </div>
                                            <div class="text-box">
                                                <label>Position *:</label>
                                                <?php echo form_dropdown('position', array('L' => 'LEFT', 'R' => 'RIGHT'), '', array('id' => 'position', 'class' => 'log-input side m-b-0', 'required' => 'true',)); ?>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="text-box">
                                                        <?php
                                                        echo form_input(array(
                                                            'type' => 'text',
                                                            'name' => 'name',
                                                            'class' => 'log-input name',
                                                            'placeholder' => 'Account Name',
                                                            'required' => 'true',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="text-box clear-both">
                                                        <?php
                                                        echo form_input(array(
                                                            'type' => 'email',
                                                            'name' => 'email',
                                                            'class' => 'log-input mail',
                                                            'placeholder' => 'Email Id',
                                                            'required' => 'true',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-box">
                                                <?php
                                                echo form_input(array(
                                                    'type' => 'text',
                                                    'name' => 'phone',
                                                    'class' => 'log-input mobile',
                                                    'placeholder' => 'Mobile No.',
                                                    'pattern' => '[0-9]+',
                                                    'minlength' => '10',
                                                    'minlength' => '10',
                                                    'id' => 'mobile',
                                                    'required' => 'true',
                                                ));
                                                ?>
                                            </div>
                                            <div class="text-box ">
                                                <?php
                                                echo form_input(array(
                                                    'type' => 'password',
                                                    'name' => 'password',
                                                    'class' => 'log-input pass',
                                                    'placeholder' => 'Choose Password',
                                                    'id' => 'passc',
                                                    'required' => 'true',
                                                ));
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="Accept">
                                                <span>
                                                    <input id="chTerms" name="chTerms" type="checkbox" required="required">
                                                </span>&nbsp;
                                                <a data-toggle="modal" style="cursor:pointer;color:#900; font-size:14px" data-target="#myModal"  >Having read the WARNING, I am well aware fully of the risks. Being in sound mind, I have decided to become a member of DWAYLife.</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div style='width :50%;margin: 0 auto'>
                                                <div class="g-recaptcha" style='position:relative;z-index:111' data-callback="capcha_filled" data-expired-callback="capcha_expired" data-sitekey="6Lcj_T4UAAAAALSiwrH0wrAPNe7H6RNIJDPFgAT9"></div>
                                            </div>
                                            <input type="submit" name="register" style="background:#F00; color:#FFF; padding:20px 40px; border:none; cursor:pointer" value="Register Now" class="cursorbtn" id="btnsubmit"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fotter-heading">
                            <h2>REACH OUT</h2>
                        </div>
                        <div class="col-md-4">
                            <div class="office-work">
                                <img src="<?php echo base_url('classic/logo.png'); ?>">
                                <p>At DWAY , we have the vision to provide an environment that improves your lifestyle by providing world class Products and an amazing platform to make a difference in society be joining our emerging Marketing environment.</p>
                                <div class="only-mobail">
                                    <input type="text" placeholder="Enter Your Mobile No.">
                                    <input class="btn-news" type="Submit" value="Go">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="office-write">
                                <h3>Write to us</h3>
                                <p>Please write to us using the contact form below if you would like to know more about the opportunity, share ideas, give feedback, have complaints, or would simply like to request a catalogue</p>
                                <form method="post" action="<?php echo base_url(); ?>" id="addform">     
                                    <div class="only-text"><input type="text" name="fname" placeholder="Name"></div>
                                    <div class="only-text"><input type="tel" name="usrtel" placeholder="Mobile"></div>
                                    <div class="only-text"><input type="email" name="email" placeholder="Email"></div>
                                    <div class="only-text"><textarea name="message" placeholder="Your Message"></textarea></div>
                                    <div class="omly-text1"><button type="submit">
                                            Submit
                                        </button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="office-queries">
                                <div class="general">
                                    <h3>Contact Us</h3>
                                    <p>	Here is contact ingo</p>
                                    <h3>E Mail</h3>
                                    <p>	info@dway.com</p>
                                </div>
                                <div class="ending-icon">
                                    <h3>Social</h3>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="#"><i class="fab fa-skype"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <section class="ending">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ending-text">
                            <p><small>© 2019 DWAY Marketing Private Limited | All rights reserved <a title="mlm software in punjab, india, delhi, ludhiana, noida, binary plan, matrix plan, crowdfunding plan in india" target="_blank" href="http://gnimlm.com">.</a></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function check_sponser() {
                var sponser_id = $('#sponser_id').val();
                var url = '<?php echo base_url('Site/Main/check_sponser'); ?>';
                $.post(url, {sponser_id: sponser_id}, function (response) {
//                    alert(response.message);
                    if (response.success == 0) {
                        $('#sponser_id').val('');
                        $('#usernamechk').html('<p>Sponser id is not valid please check and try again</p>');
                    } else {
                        $('#usernamechk').html('<p>' + response.sponser.name + '</p>')
                    }
                    console.log(response)
                }, 'json')
            }
        </script>



    </body>
</html>
<!--<script type="text/javascript" src="mlm-design/assets/js/toastr.js"></script>-->
