
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
						<div class="col-md-6">
							<img src="<?php echo base_url('uploads/logo.png');?>" style="max-width:70%;">
						</div>
						<div class="col-md-6">
							<span>
								User ID :<?php echo strtoupper($userData['user_id']);?><br>
								Moible :<?php echo strtoupper($userData['phone']);?><br>
								Address :<?php echo strtoupper($userData['address']);?><br>
								Package :<?php echo strtoupper($userData['package_amount']);?></span>
							<span>From:<?php echo title;?></span>
						</div>
					</div>
				</div>
				<div class="col-md-12 subject-heading">
					To:<?php echo strtoupper($userData['name']);?><br>
				</div>
				<div class="box-body">
					<h5>Subject:</h5>
					<span>Dear: <b><?php echo $userData['name'];?><b></span>
					<p>I ,<b><?php echo 'Admin';?></b> as the <b>CEO </b> of <b><?php echo title;?>,</b> would like to welcome you to our company and thank you for the opportunity personally.It is a tremendous honour to be able to work with an experienced company such as yours.</p>
					<p>We are aware that you are capable of quite innovative sales strategies and would like you to handle that. We would also like to remind you that the agreed upon budget still needs to be followed. Everything mentioned in the contract will be followed for the entire duration which one year. </p>
					<p>In case of queries feel free to contact us on <b><?php echo 'XXXXXXXX';?></b>. We look forward to a fruitful business partnership with you. </P>
				</div>
			<div class="letter-body-footer">
			<h6>Sincerely</h6>
			<span><b>Your Name</b></span>
			<p><b>Note:-</b> You are investing Rs. <?php echo strtoupper($userData['package_amount']);?> . These amount are non refundable and Company have provide you product.</p>
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
