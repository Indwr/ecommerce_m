<?php include_once'header.php';
$userinfo = userinfo();
?>
<style>
.user-profile-detail span {
    padding: 13px 0;
    display: block;
    text-align: center;
    border-top: 1px solid rgba(0, 0, 0, 0.10);
}
.user-profile-detail {
    background: #fff;
    box-shadow: 0 2px 6px 0 rgba(218, 218, 253, 0.65), 0 2px 6px 0 rgba(206, 206, 238, 0.54);
    padding: 27px 29px;
    border-radius: 10px;
}
.widget .widget-title, .widget .widget-title a {
    font-size: 18px !important;

}
.widget-inline-list {

    font-size: 15px !important;

}
.content-wrapper .small-box h3 {
    font-size: 20px;
    color: #fff;
}
.content-wrapper .small-box {
    border-radius: 0px 40px;
    min-height: 110px !important;
}
.modal-body img {
    max-width: 100%;
}
marquee {
    background: #ec682e;
    margin: 0px 20px;
    padding: 6px 0;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    border-radius: 4px;
    margin-bottom: 20px;
}
.bg-img{
    background-image:url('https://dealtaukri.com/uploads/line.svg');
}
.inverse-mode .widget.widget-card, .widget.widget-card.inverse-mode {
    color: #fff;
    border-radius: 0px 40px;
}
.widget.widget-card.with-min-height {
    min-height: 120px;
}
.small-box>.inner {
    padding: 17px 0;
    text-align: center;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark" style="font-weight:bold">Welcome <?php echo $userinfo->name;?>, (<?php echo $userinfo->user_id;?>)</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- <marquee><?php echo $news['news'];?></marquee> -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode pd-top" style="background:linear-gradient(45deg,#226cc5,#6cd975);border-radius:10px;">
                        <div class="widget-card-cover">
                            <div class="cover-bg"></div>
                            <img src="http://45.56.84.216/~amazingd/Assets/dist/img/bg-7.jpg" alt="">
                        </div>
                        <div class="widget-card-content bottom p-b-5">
                        <div class="row">
                            <div class="col-12 col-md-4">
                            <div style="background:white;padding:5px; text-align:center">
                            <img style="max-height:100px" src="<?php echo $userinfo->image != '' ? base_url('uploads/'.$userinfo->image) : 'http://icons.iconarchive.com/icons/visualpharm/must-have/256/User-icon.png';?>">
                            </div></div>
                            <div class="col-12 col-md-7">
                            <div class="text-right">

                                <span id="date-time">Joining Date:  <?php
                                echo $userinfo->created_at;?></span>
                                <h3 class="m-b-2">Welcome back,
                                    <span id="Mem_Name1"><?php
                                    echo $userinfo->name;?></span> !
                                </h3>
                                <p class="opacity-7" id="RefLink102">
                                    <a style="background:red; padding: 5px; color:white;display: inline-block;" href="<?php echo base_url('/Dashboard/User/Register/?sponser_id='.$userinfo->user_id)?>" target="_blank">Share Link: <?php echo ($userinfo->user_id)?></a>
                                </p>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode pd-top" style="background:linear-gradient(45deg,#226cc5,#6cd975);border-radius:10px;">
                        <div class="widget-card-content bottom p-b-5">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <div class="text-right">

                                        <h3>Total Stock</h3>
                                        <p>
                                        <?php echo $totalStock['totalStock'];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode pd-top" style="background:linear-gradient(45deg,#226cc5,#6cd975);border-radius:10px;">
                        <div class="widget-card-content bottom p-b-5">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <div class="text-right">

                                        <h3>Total Sale</h3>
                                        <p>
                                        <?php echo $totalSale['totalSale'];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode pd-top" style="background:linear-gradient(45deg,#226cc5,#6cd975);border-radius:10px;">
                        <div class="widget-card-content bottom p-b-5">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <div class="text-right">

                                        <h3>Total E-Wallet</h3>
                                        <p>
                                        <?php echo $ewallet['ewallet'];?>
                                        </p>
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
        </div>
    </div>
</div>
<?php //include_once'footer.php'; ?>
<?php if($popup['status'] == 0):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title"><?php// echo $popup['caption'];?></h4> -->
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
