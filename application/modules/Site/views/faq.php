<?php include_once('header.php'); ?>

<style>

.faq-section {
    background: #fdfdfd;
    min-height: 100vh;
    padding: 10vh 0 0;
}
.faq-title h2 {
  position: relative;
  margin-bottom: 45px;
  display: inline-block;
  font-weight: 600;
  line-height: 1;
}
.faq-title h2::before {
    content: "";
    position: absolute;
    left: 50%;
    width: 60px;
    height: 2px;
    background: #E91E63;
    bottom: -25px;
    margin-left: -30px;
}
.faq-title p {
  padding: 0 190px;
  margin-bottom: 10px;
}

.faq {
  background: #FFFFFF;
  box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
  border-radius: 4px;
}

.faq .card {
  border: none;
  background: none;
  border-bottom: 1px dashed #CEE1F8;
}

.faq .card .card-header {
  padding: 0px;
  border: none;
  background: none;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}

.faq .card .card-header:hover {
    background: rgba(233, 30, 99, 0.1);
    padding-left: 10px;
}
.faq .card .card-header .faq-title {
  width: 100%;
  text-align: left;
  padding: 0px;
  padding-left: 30px;
  padding-right: 30px;
  font-weight: 400;
  font-size: 15px;
  letter-spacing: 1px;
  color: #3B566E;
  text-decoration: none !important;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  cursor: pointer;
  padding-top: 20px;
  padding-bottom: 20px;
}

.faq .card .card-header .faq-title .badge {
  display: inline-block;
  width: 20px;
  height: 20px;
  line-height: 14px;
  float: left;
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
  text-align: center;
  background:#25d49a;
  color: #fff;
  font-size: 12px;
  margin-right: 20px;
}

.faq .card .card-body {
  padding: 30px;
  padding-left: 35px;
  padding-bottom: 16px;
  font-weight: 400;
  font-size: 16px;
  color: #6F8BA4;
  line-height: 28px;
  letter-spacing: 1px;
  border-top: 1px solid #F3F8FF;
}

.faq .card .card-body p {
  margin-bottom: 14px;
}

@media (max-width: 991px) {
  .faq {
    margin-bottom: 30px;
  }
  .faq .card .card-header .faq-title {
    line-height: 26px;
    margin-top: 10px;
  }
}
</style>

<section class="section-padding bg-dark inner-header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h1 class="mt-0 mb-3 text-white">FAQ</h1>
<div class="breadcrumbs">
<p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-white">FAQ</span></p>
</div>
</div>
</div>
</div>
</section>


<section class="section-padding bg-white">
<div class="container">
    <div class="row">
        <div class="col-md-12 pl-5 pr-5">
            <section class="faq-section">
                    <!-- ***** FAQ Start ***** -->
                   
                    <div class="col-md-12">
                        <div class="faq" id="accordion">
                            <div class="card">
                                <div class="card-header" id="faqHeading-1">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-1" data-aria-expanded="true" data-aria-controls="faqCollapse-1">
                                            <span class="badge">1</span>What is Try and Buy Service?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-1" class="collapse" aria-labelledby="faqHeading-1" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>This service entitles you to try out your purchases at the time of delivery, pay only for what you like and return the rest on-the-spot. Try and Buy is a paid service, available on most of the products and in 31 Cities, you can enter pin code on product page to check service availability. Try and Buy is only available on orders containing &lt;=5 items in cart. To avail this service min. order value should be Rs.1199 and above. To avail the service, please ensure that you tick the 'Try and Buy' box on check-out page and choose delivery address where you are comfortable trying product. Terms of service may differ for our new customers.</p>
                                        <p>Try and Buy will not be available during big sale days; We will re-offer the service, post such events.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-2">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-2" data-aria-expanded="false" data-aria-controls="faqCollapse-2">
                                            <span class="badge">2</span>Why are there different prices for the same product? Is it legal?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-2" class="collapse" aria-labelledby="faqHeading-2" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Arisestarworld is an online marketplace platform that enables independent sellers to sell their products to buyers. The prices are solely decided by the sellers, and Arisestarworld does not interfere in the same. There could be a possibility that the same product is sold by different sellers at different prices. Arisestarworld rightfully fulfils all legal compliances of onboarding multiple sellers on its forum as it is a marketplace platform.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-3">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-3" data-aria-expanded="false" data-aria-controls="faqCollapse-3">
                                            <span class="badge">3</span>I saw the product at Rs. 1000 but post clicking on the product, there are multiple prices and the size which I want is being sold for Rs. 1600. Why is there a change in price in the product description page?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-3" class="collapse" aria-labelledby="faqHeading-3" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Arisestarworld is an online marketplace, and multiple sellers could be selling a particular style at different prices as may be set by each such seller respectively. The product price on the listing page of the platform, may not always reflect the lowest price for that particular style. This is because the seller whose price is displayed on the list page is selected based on the application of a number of parameters and price is only one such parameter. However, once you land on the product display page on the platform for a specific style, you will have access to the price offered by all sellers on the platform for the relevant style.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-4">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-4" data-aria-expanded="false" data-aria-controls="faqCollapse-4">
                                            <span class="badge">4</span> How will I detect fraudulent emails/calls seeking sensitive personal and confidential information?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-4" class="collapse" aria-labelledby="faqHeading-4" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>If you receive an e-mail, a call from a person/association claiming to be from Arisestarworld seeking sensitive confidential information like debit/credit card PIN, net-banking or mobile banking password, we request you to never provide such confidential and personal data. We at Arisestarworld or our affiliate logistics partner never ask for such confidential and personal data. If you have already revealed such information, report it immediately to an appropriate law enforcement agency.</p>
                                        <p>Here are a couple of baits fraudsters often use to cheat consumers:</p>
                                        <p>Congratulations! You have been nominated as a ‘Top Arisestarworld customer’ and are now eligible for a luxury gift item. Please share your proof of address and your debit/credit card details to avail this great offer.</p>
                                        <p>Hi, I’m calling from Arisestarworld. We are happy to let you know that you have won an exclusive lucky draw coupon of Rs. 5000 on your latest purchase. Please share your credit/debit card number so we can credit the money directly into your bank account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-5">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-5" data-aria-expanded="false" data-aria-controls="faqCollapse-5">
                                            <span class="badge">5</span> How will I identify a genuine appointment letter?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-5" class="collapse" aria-labelledby="faqHeading-5" data-parent="#accordion">
                                    <div class="card-body">
                                        <p> Please beware of the fraudulent individuals/agencies that are enticing job seekers by promising them career opportunities at Arisestarworld in lieu of 1.) recruitment fee 2.) processing fee 3.) security deposit 4.) software or equipment charges 5.) on-boarding charges etc. Please be cautious that, Arisestarworld and its recruitment partners never ask for any fee in exchange for an offer letter or interview calls. All offer related communications are sent from an official Arisestarworld email id only.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-6">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-6" data-aria-expanded="false" data-aria-controls="faqCollapse-6">
                                            <span class="badge">6</span> Why will 'My Cashback' not be available on Arisestarworld?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-6" class="collapse" aria-labelledby="faqHeading-6" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>To make your shopping experience easier and simpler, 'My Cashback' will be replaced by PhonePe. PhonePe wallet can be used on Arisestarworld and other PhonePe partners. To use your PhonePe balance, you will have to activate/verify your PhonePe account</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeading-7">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-7" data-aria-expanded="false" data-aria-controls="faqCollapse-7">
                                            <span class="badge">7</span> How do I cancel the order, I have placed?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-7" class="collapse" aria-labelledby="faqHeading-7" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Order can be canceled till the same is out for delivery. Note: This may not be applicable for certain logistics partner. You would see an option to cancel within 'My Orders' section under the main menu of your App/Website/M-site then select the item or order you want to cancel. In case you are unable to cancel the order from'My Orders' section, you can refuse it at the time of delivery and refund will be processed into the source account, if order amount was paid online.</p>
                                    </div>
                                </div>
                            </div>

                             <div class="card">
                                <div class="card-header" id="faqHeading-8">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-8" data-aria-expanded="false" data-aria-controls="faqCollapse-8">
                                            <span class="badge">8</span> How do I create a Return Request?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-8" class="collapse" aria-labelledby="faqHeading-8" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>You can create a Return in three simple steps</p>
                                        <ul style="list-style:decimal;">
                                        	<li>Tap on MyOrders</li>
                                        	<li>Choose the item to be Returned</li>
                                        	<li>Enter details requested and create a return request</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                             <div class="card">
                                <div class="card-header" id="faqHeading-9">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-9" data-aria-expanded="false" data-aria-controls="faqCollapse-9">
                                            <span class="badge">9</span> I have created a Return request. When will the product be picked up?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-9" class="collapse" aria-labelledby="faqHeading-9" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Number of days to pickup a product may vary as per the Logistics team that will be assigned to pickup your product. The product will be picked anywhere between 4 – 7 days.</p>
                                    </div>
                                </div>
                            </div>

                             <div class="card">
                                <div class="card-header" id="faqHeading-10">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-10" data-aria-expanded="false" data-aria-controls="faqCollapse-10">
                                            <span class="badge">10</span>I have created a Return request. When will I get the refund?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-10" class="collapse" aria-labelledby="faqHeading-10" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Refund will be initiated upon successful pickup as per the Returns Policy. The refund amount is expected to reflect in the customer account within the following timelines:</p>
                                        <ul style="list-style:decimal;">
                                        	<li>NEFT - 1 to 3 business days post refund initiation</li>
                                        	<li>Arisestarworld Credit - Instant</li>
                                        	<li>Online Refund – 7 to 10 days post refund initiation, depending on your bank partner</li>
                                        	<li>“PhonePe wallet” – Instant</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

        </div>
    </div>
</div>
</section>


<?php include_once('footer.php'); ?>
