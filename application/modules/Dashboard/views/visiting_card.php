
<?php include_once 'header.php'; ?>

<style>
.main-body{
	text-align: center;
	border: 2px #000 solid;
	padding: 40px 0;
    margin: 20px;
}
.main-body h2{
	border-bottom: 2px #000 solid;
	display: inline;
	font-weight: bold;

}
.header-heading {
    padding: 0 50px;
}
.subject-heading {
    text-align: center;
    margin: 15px 0px;
    border-top: 2px #000 solid;
    border-bottom: 2px #000 solid;
    padding: 8px 0;
    font-size: 20px;
}
.box-body {
    padding: 0px 50px;
}
.letter-body-footer {
    padding: 0px 50px;
}
.letter-body {
    width:100%;
    text-align:left;
    margin: 0px auto;
    margin-top: 30px;
}
.letter-body span {
    display: block;
    margin-top: 20px;
    font-size: 18px;
}
.letter-body h5{
	font-size: 20px;
	font-weight: 600;
	margin-top: 50px;
}
.letter-body p{
	font-size: 16px;
	line-height: 35px;
	font-weight: normal;
	margin-top: 40px;
}
.letter-body-footer h6{
	font-weight: normal;
	font-size: 20px;
}
img.welcome-logo {
    margin-right: 40px;
    max-width: 150px;
}
@media screen and (max-width:767px){
	.letter-body {
    width:95%;
}
}

</style>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
			<!-- <h2>Business Welcome Letter</h2> -->
			<div class="letter-body">
				<div class="header-heading">
					<div class="row">
						<table style="border:#CCCCCC 1px solid; background:url(https://dealtaukri.com/uploads/id-card.png) no-repeat center top;height:314px;width:501px;" width="501" height="314" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody><tr>
      <td style="padding-left:10px;padding-top:10px;" width="501" valign="top" height="314" align="left">
				<div style="margin: 10px;
    margin-top: 51px;
    float: right;
    margin-right: -22px;">
          <strong style="    color: #fff;
    font-size: 20px; margin: 10px 32px 0px 46px;"><?php echo $data['name']?></strong><br>


          <span style="font-size: 18px;
    font-weight: bold;
    margin: 39px 71px 0px 19px !important;
    text-align: right;">+91 <?php echo $data['cell_phone']?></span>
					<span style="font-size: 18px;
    margin: 28px 73px 0px -1px;"><?php echo $data['email']?></span>
    <span style="font-size: 18px;
    margin: 28px 73px 0px -1px;"><?php echo $data['address']?></span>
      <span style="font-size: 18px;
    margin: 28px 73px 0px -1px;"><?php echo $city['name'].','.$state['name'].'('.$country['name'].')'; ?></span>
				</div>
            <br></td></tr>
  </tbody></table>

					</div>
				</div>



	</div>
	<button target="_blank" id="btnp" class="btn btn-default" onclick="pageprint()"><i class="fas fa-print"></i> Print</button>
	 <img src="<?php echo base_url(logo);?>" class="welcome-logo" style="max-width:150px;float:right;">



</div>







<?php include_once 'footer.php'; ?>

<script>
function pageprint(){
	var divToPrint=document.getElementById('printarea');
  	var newWin=window.open('','Print-Window');
  	newWin.document.open();
  	newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  	newWin.document.close();
  	setTimeout(function(){newWin.close();},10);

	//$("#printarea").print();
  	//window.print() ;
}
</script>
