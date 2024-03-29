<?php 
    include_once('header.php');
    $_SESSION['token'] = md5(uniqid(rand()));
?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Checkout</a>
            </div>
        </div>
    </div>
</section>
<section class="checkout-page section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout-step">
                    <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-one">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="number">1</span> Payment
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>We need your phone number so that we can update you about your order.</p>
                                    <form method="get" action="<?php echo base_url('Site/Main/userLogin');?>" id="form">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only">User ID</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="mdi mdi-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="user" placeholder="Enter User ID">
                                                    <input type="hidden" name='token' value="<?php echo $_SESSION['token'];?>">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <label class="sr-only">Password</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="mdi mdi-lock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-secondary mb-2 btn-lg" onclick="loadDoc()">Submit</button>
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <p id="demo"></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<div class="card checkout-step-two d-none">
<div class="card-header" id="headingTwo">
<h5 class="mb-0">
<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
<span class="number">2</span> Delivery Address
</button>
</h5>
</div>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
<div class="card-body">
<form>
<div class="row d-none">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">First Name <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="Gurdeep" type="text">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Last Name <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="Osahan" type="text">
</div>
</div>
</div>
<div class="row d-none">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Phone <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="123 456 7890" type="number">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Email Address <span class="required">*</span></label>
 <input class="form-control border-form-control " value="" placeholder="iamosahan@gmail.com" disabled="" type="email">
</div>
</div>
</div>
<div class="row d-none">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Country <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select Country</option>
<option value="AF">Afghanistan</option>
<option value="AX">Åland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia, Plurinational State of</option>
<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, the Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Côte d'Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CW">Curaçao</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
 <option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and McDonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
 <option value="MK">Macedonia, the former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
 <option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Réunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="BL">Saint Barthélemy</option>
<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="MF">Saint Martin (French part)</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SX">Sint Maarten (Dutch part)</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="SS">South Sudan</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
 <option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela, Bolivarian Republic of</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">City <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select City</option>
<option value="AF">Alaska</option>
<option value="AX">New Hampshire</option>
<option value="AL">Oregon</option>
<option value="DZ">Toronto</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Zip Code <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="123456" type="number">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">State <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select State</option>
<option value="AF">California</option>
<option value="AX">Florida</option>
<option value="AL">Georgia</option>
<option value="DZ">Idaho</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label class="control-label">Shipping Address <span class="required">*</span></label>
<textarea class="form-control border-form-control"></textarea>
<small class="text-danger">Please provide the number and street.</small>
</div>
</div>
</div>
<div class="heading-part">
<h3 class="sub-heading">Billing Address</h3>
</div>
<hr>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">First Name <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="Gurdeep" type="text">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Last Name <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="Osahan" type="text">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Phone <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="123 456 7890" type="number">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Email Address <span class="required">*</span></label>
<input class="form-control border-form-control " value="" placeholder="iamosahan@gmail.com" disabled="" type="email">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Country <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select Country</option>
<option value="AF">Afghanistan</option>
<option value="AX">Åland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia, Plurinational State of</option>
<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, the Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Côte d'Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CW">Curaçao</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and McDonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
<option value="MK">Macedonia, the former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
 <option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Réunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
 <option value="RW">Rwanda</option>
<option value="BL">Saint Barthélemy</option>
<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="MF">Saint Martin (French part)</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SX">Sint Maarten (Dutch part)</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="SS">South Sudan</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
 <option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela, Bolivarian Republic of</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">City <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select City</option>
<option value="AF">Alaska</option>
<option value="AX">New Hampshire</option>
<option value="AL">Oregon</option>
<option value="DZ">Toronto</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Zip Code <span class="required">*</span></label>
<input class="form-control border-form-control" value="" placeholder="123456" type="number">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label class="control-label">State <span class="required">*</span></label>
<select class="select2 form-control border-form-control">
<option value="">Select State</option>
<option value="AF">California</option>
 <option value="AX">Florida</option>
<option value="AL">Georgia</option>
<option value="DZ">Idaho</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label class="control-label">Billing Landmark <span class="required">*</span></label>
<textarea class="form-control border-form-control"></textarea>
<small class="text-danger">
Please include landmark (e.g : Opposite Bank) as the carrier service may find it easier to locate your address.
</small>
</div>
</div>
</div>
<div class="custom-control custom-checkbox mb-3">
<input type="checkbox" class="custom-control-input" id="customCheckbill">
<label class="custom-control-label" for="customCheckbill">Use my delivery address as my billing address</label>
</div>
<button type="button" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-secondary mb-2 btn-lg">NEXT</button>
</form>
</div>
</div>
</div>
<div class="card d-none">
<div class="card-header" id="headingThree">
<h5 class="mb-0">
<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
<span class="number">3</span> Payment
</button>
</h5>
</div>
<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
<div class="card-body">
<form class="col-lg-8 col-md-8 mx-auto">
<div class="form-group">
<label class="control-label">Card Number</label>
<input class="form-control border-form-control" value="" placeholder="0000 0000 0000 0000" type="text">
</div>
<div class="row">
<div class="col-sm-3">
<div class="form-group">
<label class="control-label">Month</label>
<input class="form-control border-form-control" value="" placeholder="01" type="text">
</div>
</div>
<div class="col-sm-3">
<div class="form-group">
<label class="control-label">Year</label>
<input class="form-control border-form-control" value="" placeholder="15" type="text">
</div>
</div>
 <div class="col-sm-3">
</div>
<div class="col-sm-3">
<div class="form-group">
<label class="control-label">CVV</label>
<input class="form-control border-form-control" value="" placeholder="135" type="text">
</div>
</div>
</div>
<hr>
<div class="custom-control custom-radio">
<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
<label class="custom-control-label" for="customRadio1">Would you like to pay by Cash on Delivery?</label>
</div>
<p>Vestibulum semper accumsan nisi, at blandit tortor maxi'mus in phasellus malesuada sodales odio, at dapibus libero malesuada quis.</p>
<button type="button" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour" class="btn btn-secondary mb-2 btn-lg">NEXT</button>
</form>
</div>
</div>
</div>
<div class="card d-none">
<div class="card-header" id="headingThree">
<h5 class="mb-0">
<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
<span class="number">4</span> Order Complete
</button>
</h5>
</div>
<div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
<div class="card-body">
<div class="text-center">
<div class="col-lg-10 col-md-10 mx-auto order-done">
<i class="mdi mdi-check-circle-outline text-secondary"></i>
<h4 class="text-success">Congrats! Your Order has been Accepted..</h4>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, Sed ex est, consectetur eget consectetur, Lorem ipsum dolor sit amet...
</p>
</div>
<div class="text-center">
<a href="shop.html"><button type="submit" class="btn btn-secondary mb-2 btn-lg">Return to store</button></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card">
        <h5 class="card-header">My Cart <span class="text-secondary float-right">(<?php if(!empty($_SESSION['cart'])){ echo count($_SESSION['cart']);}?> item)</span></h5>
        <div class="card-body pt-0 pr-0 pl-0 pb-0">
            <?php
                if(!empty($_SESSION['cart'])): 
                foreach($_SESSION['cart'] as $key => $ct):
            ?>
            <div class="cart-list-product">
                <img class="img-fluid" src="<?php echo base_url('uploads/'.$ct['image']);?>" alt="">
                <span class="badge badge-success">50% OFF</span>
                <h5><a href="#"><?php echo $ct['title'];?></a></h5>
                <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> <?php echo $ct['type'];?></h6>
                <p class="offer-price mb-0">$<?php echo $ct['mrp'];?> <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$<?php echo $ct['mrp'];?></span></p>
            </div>
            <?php
                endforeach;
                endif;
            ?>
        </div>
    </div>
</div>
</div>
</div>
</section>
<section class="section-padding bg-white border-top">
<div class="container">
<div class="row">
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-truck-fast"></i>
<h6>Free & Next Day Delivery</h6>
<p>Lorem ipsum dolor sit amet, cons...</p>
</div>
</div>
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-basket"></i>
<h6>100% Satisfaction Guarantee</h6>
<p>Rorem Ipsum Dolor sit amet, cons...</p>
</div>
</div>
<div class="col-lg-4 col-sm-6">
<div class="feature-box">
<i class="mdi mdi-tag-heart"></i>
<h6>Great Daily Deals Discount</h6>
<p>Sorem Ipsum Dolor sit amet, Cons...</p>
</div>
</div>
</div>
</div>
</section>
<?php include_once('footer.php'); ?>
<script>
    function loadDoc() { 
        var url = document.getElementById("form").action;
        var type = document.getElementById("form").method;
        var form = $('form').serialize();
        var xhttp = new XMLHttpRequest();
        const FD = form;
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }
        };
        xhttp.open(type,url+'/?'+FD, true);
        xhttp.send();
    }

    function paymentProcess(){
        let url = "<?php echo base_url('Site/Main/payment');?>";
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                window.location.href = "<?php echo base_url();?>";
            }
        };
        xhttp.open("GET",url, true);
        xhttp.send(); 
    }
</script>
