<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="<?php echo base_url('Assets/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <style>
         body{
                font-family: 'Poppins', sans-serif;
            }
        .form-wrapper {
            max-width: 620px;
            margin: 0 auto;
            padding: 20px 40px;
            background: #fff;
            box-shadow: 0px 0px 250px 0px rgba(69, 81, 100, 0.1);
            border-radius: 4px;
        }

        .form-control {
            padding: 12px 20px;
            background-color: #f3f6ff;
            border: 0;
            text-indent: 23px;
            color: #6c757d;
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
            margin-top: 20px;
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
            /*background: #00B4DB;   fallback for old browsers 
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 
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

          /*background: url(https://www.metro-check.com/wp-content/uploads/2018/01/pexels-photo-733856.jpg);*/
          background-color: #0b2239;
          background-size:cover;
        }
         .feild-icon {
            display: inline;
            position: absolute;
            color: #6c89c0;
            padding:9px 18px;
            font-size: 20px;
        }
      .form-group.text-center.account-change {
            background: #ea5e20;
            padding: 13px 0;
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

    <body>
        <div id="wrapper" class="joffice">
            <div id="main" class="main">
                <div class="">


                    <div class="row no-gutters">

                        <div class="col-12 col-md-12 columns">
                            <div class="form-wrapper">
                                <div class="page-header text-center">
                                    <img src="<?php echo base_url(logo); ?>" style="max-width: 260px;margin-bottom: 20px;padding: 15px;border-radius: 10px;margin: 0;">
                                    <h3 class="page-title">Registration Form</h3>
                                    <p class="small mb-4">You must be a Network member to be able to login!</p>
                                </div>

                                <div class="panel panel-primary">
                                    <!-- <h5><?php //echo title;   ?></h5> -->
                                    <span class="text-danger">
                                        <?php 
                                            echo $this->session->flashdata('error');
                                            $sponser_id = 'admin'; 
                                        ?>
                                    </span>
                                    <?php echo form_open('Dashboard/User/Register', array('id' => 'RegisterForm')); ?>
                                    <div class="row">
                                        <div class="col-md-6 form-group d-none">
                                            <div class="feild-icon">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                            <input type="text" class="form-control" id="sponser_id" placeholder="Enter Sponser ID" value="<?php echo $sponser_id; ?>" name="sponser_id" required readonly>
                                            <span class="text-danger"> <?php echo form_error('sponser_id'); ?></span>
                                            <span id="errorMessage" class="text-danger"> </span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <!-- <label for="pwd">Name:</label> -->
                                            <div class="feild-icon">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required>
                                            <span class="text-danger"> <?php echo form_error('name'); ?></span>
                                        </div>
                                   
                                    <div class="col-md-6 form-group d-none">
                                      <!--   <label for="pwd">Position:</label> -->
                                            <div class="feild-icon">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                        <select class="form-control" name="position" style="height:auto !important">
                                          <option value="">Select Position</option>
                                            <option value="L">LEFT</option>
                                            <option value="R">RIGHT</option>
                                        </select>
                                    </div>
                                    
                                        <div class="col-md-6 form-group">
                                           <!--  <label for="pwd">Phone:</label> -->
                                           <div class="feild-icon">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </div>
                                            <input type="phone" class="form-control" placeholder="Enter Phone" name="phone" value="<?php echo set_value('phone'); ?>" required>
                                            <span class="text-danger"> <?php echo form_error('phone'); ?></span>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <!-- <label for="pwd">Email:</label> -->
                                             <div class="feild-icon">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            </div>
                                            <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
                                            <span class="text-danger"> <?php echo form_error('email'); ?></span>
                                        </div>
                                  
                                    <div class="col-md-6 form-group">
                                        <!-- <label for="pwd">State:</label> -->
                                         <div class="feild-icon">
                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                        </div>
                                        <select class="form-control" name="state" id="state" style="height:auto !important">
                                            <?php
                                            foreach($states as $key => $state)
                                            echo'<option value="'.$state['id'].'">'.$state['name'].'</option>';
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- <label for="pwd">City:</label> -->
                                        <div class="feild-icon">
                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                        </div>
                                        <select class="form-control" name="city" id="city" style="height:auto !important">
                                            <?php
                                            foreach($cities as $key => $city)
                                            echo'<option value="'.$city['id'].'">'.$city['name'].'</option>';
                                            ?>
                                        </select>
                                    </div>
                                    

                                    <div class="col-md-12 form-group">
                                        <div class="feild-icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Your Name As Per Bank Account" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <div class="feild-icon">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                        </div>
                                        <input type="date" id="birthday"  class="form-control"  name="birthday" required>
                                    </div>

                                     <div class="col-md-6 form-group">
                                        <div class="feild-icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                       <select class="form-control" name="gender" style="height:auto !important">
                                          <option>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div> 

                                    <!-- <div class="col-md-6 form-group d-none">
                                        <div class="feild-icon">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                        <input type="text" class="form-control" name="pan" placeholder="Enter Your PAN Number" required>
                                    </div> -->

                                     <div class="col-md-12 form-group">
                                        <div class="feild-icon">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        <input type="text" class="form-control" placeholder="Enter Your Address" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <div class="feild-icon">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        <input type="text" class="form-control" placeholder="Enter Your City/Village" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="feild-icon">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Your Pincode" required>
                                    </div>

                                    </div>

                                    <div class="Accept">
                                        <span>
                                            <input id="chTerms" name="chTerms" type="checkbox" required="required">
                                        </span>&nbsp;
                                        I have read the   <a style="cursor:pointer;color:red; font-size:16px" target="_blank" href="<?php echo base_url('Site/Main/content/terms');?>" target="_blank">Terms &amp; Conditions</a>, I am well aware fully of the risks. Being in sound mind, I have decided to become a member of <?php echo title;?> Company.

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>

                                    <?php echo form_close(); ?>
                                    <p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>

                                  
                                    <div class="form-group text-center account-change ">
                                        Have Account? <a href="<?php echo base_url('Dashboard/User/login'); ?>" class="sign-in-btn">Login Now</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // $(document).on('blur', '#sponser_id', function () {
            //     check_sponser();
            // })
            // function check_sponser() {
            //     var user_id = $('#sponser_id').val();
            //     if (user_id != '') {
            //         var url = '<?php //echo base_url("Dashboard/User/get_user/") ?>' + user_id;
            //         $.get(url, function (res) {
            //             $('#errorMessage').html(res);
            //         })
            //     }
            // }
            // check_sponser();
            $(document).on('submit', '#RegisterForm', function () {
                //var pass = $('#pass').val();
                //var cpass = $('#cpass').val();
                //if(pass == cpass){
                    if (confirm('Please Check All The Fields Before Submit')) {
                        yourformelement.submit();
                    } else {
                        return false;
                    }
                // }else{
                //     alert('Password is not matched,Please check!')
                //     return false;
                // }
            })
            $(document).on('change','#state',function(){
                var state_id = $(this).val();
                var url = '<?php echo base_url("Dashboard/User/get_city/")?>'+state_id;
                $('#city').html('');
                $.get(url,function(res){
                    $.each(res,function(key,value){
                        $('#city').append('<option value="'+value.id+'">'+value.name+'</option>');
                    })
                },'json')
            })

            // $(document).on('change','#pass',function(){
            //     var pass = $('#pass').val();
            //     var strg = pass.length;
            //     if(strg < 6){
            //         alert('Minimum Password Digits are aleast Six')
            //         return false;
            //     }
            // });
        </script>
    </body>
</html>
