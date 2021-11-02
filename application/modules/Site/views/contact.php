<?php include_once('header.php'); ?>
<section class="section-padding bg-dark inner-header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h1 class="mt-0 mb-3 text-white">Contact Us</h1>
<div class="breadcrumbs">
<p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-white">Contact Us</span></p>
</div>
</div>
</div>
</div>
</section>


<section class="section-padding">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4">
<h3 class="mt-1 mb-5">Get In Touch</h3>
<h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
<p>First Floor, 96, P Block, Sri Ganganagar, Rajasthan 335001</p>
<h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
<p>(+91) <?php echo $siteContent['phone'];?></p>
<h6 class="text-dark"><i class="mdi mdi-deskphone"></i> Mobile :</h6>
<p>(+91) <?php echo $siteContent['phone'];?></p>
<h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
<p><a href="#" ><?php echo $siteContent['email'];?></a></p>
<h6 class="text-dark"><i class="mdi mdi-link"></i> Website :</h6>
<p>www.mlmsoftsolutions.com</p>
<div class="footer-social"><span>Follow : </span>
<a href="#"><i class="mdi mdi-facebook"></i></a>
<a href="#"><i class="mdi mdi-twitter"></i></a>
<a href="#"><i class="mdi mdi-instagram"></i></a>
<a href="#"><i class="mdi mdi-google"></i></a>
</div>
</div>
<div class="col-lg-8 col-md-8">
<div class="card">
<div class="card-body">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3457.9349752461944!2d73.86419171548653!3d29.923774131217193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3917b5eb97a911e1%3A0xfa107adc479db227!2sDOT%20COM%20LABS%20LLP!5e0!3m2!1sen!2sin!4v1632744859968!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section-padding  bg-white">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 section-title text-left mb-4">
<h2>Contact Us</h2>
</div>
<form class="col-lg-12 col-md-12" name="sentMessage" id="contactForm" novalidate>
<div class="control-group form-group">
<div class="controls">
<label>Full Name <span class="text-danger">*</span></label>
<input type="text" placeholder="Full Name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
<p class="help-block"></p>
</div>
</div>
<div class="row">
<div class="control-group form-group col-md-6">
<label>Phone Number <span class="text-danger">*</span></label>
<div class="controls">
<input type="tel" placeholder="Phone Number" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
</div>
</div>
<div class="control-group form-group col-md-6">
<div class="controls">
<label>Email Address <span class="text-danger">*</span></label>
<input type="email" placeholder="Email Address" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
</div>
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Message <span class="text-danger">*</span></label>
<textarea rows="4" cols="100" placeholder="Message" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
</div>
</div>
<div id="success"></div>

<button type="submit" class="btn btn-success">Send Message</button>
</form>
</div>
</div>
</section>

<?php include_once('footer.php'); ?>
