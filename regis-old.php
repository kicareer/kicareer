<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />  
      <meta name="author" content="INSPIRO" />    
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="images/favicon.png">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Registration</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
</head>
<style type="text/css">
            .kenz-btn{
                border: 1px solid #ececec !important;
                border-radius: 5px;
                background-color: #ffffff !important;
                margin:10px;
                color: black !important;
                box-shadow: 0 0 5px 0 rgba(154, 161, 191, 0.45);
            }
            .cardstyle{
                padding: 10px !important;
                color: black !important;
            }
            .innercard{
                color: black !important;
                border-left: 1px !important;
                margin-right: 5px !important;
                
            }
               .accordion .ac-item .ac-title:before{display: none}
            .ac-title i{
               margin-right: -20px !important;
               font-size: 22px;
               margin-top:2px;
            }

            .card-article{
                padding: 30px 30px !important;
            }

        </style>

<body>
   
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
       <?php
       include'header.php';
       ?>
        <!-- end: Header -->
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 200px">
            <div class="container-fluid">
                <style type="text/css">
                    .breadcrumb .active a{
                        color:#1778bc !important;
                        font-weight: 600 !important;
                    }
                    @media only screen and (min-width:1px) and (max-width:520px){
                      .card-left-img{
                        display: none;
                      }
                    }
                </style>
            </div>
        </section>
        <div class="container-fluid" style="margin-top:-150px">
            <div class="col-md-12" >
                <div class="row">
                    <div class="col-md-3">
                         <div class="card card-left-img" style="position: fixed;top:35%;left:25px;width:310px">
                            <center><img src="image/green-boy.c8b59289.svg" width="120px" style="margin-top:-40px"></center>
                             <div class=" p-20" >
                                  <center><h4> On registering, you can </h4></center>
                                  <ul style="list-style: none;text-align: center;">
                                      <li> <img src="image/accept.png" width="15px"> Build your profile and let recruiters find you</li>

                                      <li> <img src="image/accept.png" width="15px"> Get job postings delivered right to your email</li>

                                      <li><img src="image/accept.png" width="15px">
                                        Find a job and grow your career  
                                      </li>
                                  </ul>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-9">
                        <form method="POST" enctype="multipart/form-data">
                            <article style="background:  !important">
                                <div class="card card-article" style="cursor: pointer;">
                                    <h1>Find a job & grow your career</h1>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Full Name *</label>
                                                <input type="text" required="" class="form-control" name="name" placeholder="What is your name">
                                            </div>
                                            <div class="form-group">
                                                <label> Email Id *</label>
                                                <input type="email" required="" class="form-control" name="email" placeholder="Tell us your Email ID">
                                            </div>
                                            <div class="form-group">
                                                <label> Password *</label>
                                                <input type="password" id="pass" class="form-control" name="password" placeholder="*******">
                                                <span style="font-size: 12px">Minimum 6 Characters required</span>
                                            </div>
                                            <div class="form-group">
                                                <label> Confirm Password *</label>
                                                <input type="password" id="c_pass" class="form-control" name="" placeholder="*******">
                                                 <div id="pass_err"></div>
                                            </div>
                                            <div class="form-group">
                                                <label> Mobile Number *</label>
                                                <input type="" placeholder="Enter your mobile number"   class="form-control" style="width: 80%;float: right;background: none !important" name="contact_number" required>
                                                <select name="country_code" class="form-control" style="width:19%;" id="" required="">        
                                                    <optgroup label="Other countries">
                                                                <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                                                <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                                                <option data-countryCode="AO" value="244">Angola (+244)</option>
                                                                <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                                                <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                                                <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                                                <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                                                <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                                                <option data-countryCode="AU" value="61">Australia (+61)</option>
                                                                <option data-countryCode="AT" value="43">Austria (+43)</option>
                                                                <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                                                <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                                                <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                                                <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                                                <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                                                <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                                                <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                                                <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                                                <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                                                <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                                                <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                                                <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                                                <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                                                <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                                                <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                                                <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                                                <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                                                <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                                                <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                                                <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                                                <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                                                <option data-countryCode="CA" value="1">Canada (+1)</option>
                                                                <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                                                <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                                                <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                                                <option data-countryCode="CL" value="56">Chile (+56)</option>
                                                                <option data-countryCode="CN" value="86">China (+86)</option>
                                                                <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                                                <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                                                <option data-countryCode="CG" value="242">Congo (+242)</option>
                                                                <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                                                <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                                                <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                                                <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                                                <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                                                <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                                                <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                                                <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                                                <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                                                <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                                                <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                                                <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                                                <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                                                <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                                                <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                                                <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                                                <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                                                <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                                                <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                                                <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                                                <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                                                <option data-countryCode="FI" value="358">Finland (+358)</option>
                                                                <option data-countryCode="FR" value="33">France (+33)</option>
                                                                <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                                                <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                                                <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                                                <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                                                <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                                                <option data-countryCode="DE" value="49">Germany (+49)</option>
                                                                <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                                                <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                                                <option data-countryCode="GR" value="30">Greece (+30)</option>
                                                                <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                                                <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                                                <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                                                <option data-countryCode="GU" value="671">Guam (+671)</option>
                                                                <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                                                <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                                                <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                                                <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                                                <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                                                <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                                                <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                                                <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                                                <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                                                <option data-countryCode="IN" value="91">India (+91)</option>
                                                                <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                                                <option data-countryCode="IR" value="98">Iran (+98)</option>
                                                                <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                                                <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                                                <option data-countryCode="IL" value="972">Israel (+972)</option>
                                                                <option data-countryCode="IT" value="39">Italy (+39)</option>
                                                                <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                                                <option data-countryCode="JP" value="81">Japan (+81)</option>
                                                                <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                                                <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                                                <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                                                <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                                                <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                                                <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                                                <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                                                <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                                                <option data-countryCode="LA" value="856">Laos (+856)</option>
                                                                <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                                                <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                                                <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                                                <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                                                <option data-countryCode="LY" value="218">Libya (+218)</option>
                                                                <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                                                <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                                                <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                                                <option data-countryCode="MO" value="853">Macao (+853)</option>
                                                                <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                                                <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                                                <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                                                <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                                                <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                                                <option data-countryCode="ML" value="223">Mali (+223)</option>
                                                                <option data-countryCode="MT" value="356">Malta (+356)</option>
                                                                <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                                                <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                                                <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                                                <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                                                <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                                                <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                                                <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                                                <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                                                <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                                                <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                                                <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                                                <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                                                <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                                                <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                                                <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                                                <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                                                <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                                                <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                                                <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                                                <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                                                <option data-countryCode="NE" value="227">Niger (+227)</option>
                                                                <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                                                <option data-countryCode="NU" value="683">Niue (+683)</option>
                                                                <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                                                <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                                                <option data-countryCode="NO" value="47">Norway (+47)</option>
                                                                <option data-countryCode="OM" value="968">Oman (+968)</option>
                                                                <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                                                                <option data-countryCode="PW" value="680">Palau (+680)</option>
                                                                <option data-countryCode="PA" value="507">Panama (+507)</option>
                                                                <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                                                <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                                                <option data-countryCode="PE" value="51">Peru (+51)</option>
                                                                <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                                                <option data-countryCode="PL" value="48">Poland (+48)</option>
                                                                <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                                                <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                                                <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                                                <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                                                <option data-countryCode="RO" value="40">Romania (+40)</option>
                                                                <option data-countryCode="RU" value="7">Russia (+7)</option>
                                                                <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                                                <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                                                <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                                                <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                                                <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                                                <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                                                <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                                                <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                                                <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                                                <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                                                <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                                                <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                                                <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                                                <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                                                <option data-countryCode="ES" value="34">Spain (+34)</option>
                                                                <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                                                <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                                                <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                                                <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                                                <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                                                <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                                                <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                                                <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                                                <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                                                <option data-countryCode="SI" value="963">Syria (+963)</option>
                                                                <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                                                <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                                                <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                                                <option data-countryCode="TG" value="228">Togo (+228)</option>
                                                                <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                                                <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                                                <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                                                <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                                                <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                                                <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                                                <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                                                <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                                                <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                                                <option data-countryCode="GB" value="44">UK (+44)</option>
                                                                <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                                                <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                                                <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                                                <option data-countryCode="US" value="1">USA (+1)</option>
                                                                <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                                                <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                                                <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                                                <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                                                <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                                                <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                                                <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                                                <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                                                <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                                                <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                                                <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                                                <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        <style type="text/css">
                                            .select-css{ 
                                                width: 300px !important;
                                                float: left !important;
                                                margin: 5px;
                                                border: 1px solid #f2f2f2;
                                                padding:10px;
                                                border-radius: 0px 30px 0px 30px;
                                            }
                                            .select-css img{
                                                margin-top: 5% !important;
                                            }
                                            @media only screen and (min-width:1px) and (max-width:520px){
                                                 .select-css{
                                                
                                                width:100% !important;}
                                            }
                                        </style>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Work Status</label>
                                                <div  onclick="activeAc('dep_id')">
                                                    <div class="select-css" id="dep_id"> 
                                                        <center>
                                                          <img src="image/briefcase.png" width="25px">
                                                           <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                                                           <input type="radio" name="work_status" value="experienced">
                                                          <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm Experienced</h5>
                                                          <h6 class="m-0" style="line-height: 1.5">I have work experience (excluding internships)</h6>
                                                        </center>
                                                    </div>
                                                </div>
                                                <div  onclick="activeAc('fresher')">
                                                    <div class="select-css" id="fresher">
                                                        <center>
                                                          <img src="image/school-bag.png" width="25px"> 
                                                          <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                                                          <input type="radio" name="work_status" value="fresher">
                                                          <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm a Fresher</h5>
                                                          <h6 class="m-0" style="line-height: 1.5">I am a student/ Haven't worked after graduation</h6>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <!-- <div class="col-md-12 m-t-10">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="telephone">Upload Files</label>
                                                    <div class="form-group" style="margin-top:-15px">
                                                        <a class="dropzone-attach-files btn btn-sm mb-0 m-t-0" style="background:#457eff;border-color:#457eff;float: left !important">
                                                          Upload Resume </a>
                                                          <p style=";margin-top:20px;"> &nbsp;<span style="font-size:11.8px"> DOC, DOCx, PDF, RTF | Max: 2 MB</span></p>
                                                    </div>
                                                    <div  class="d-none " id="fileUpload3" action="/file-upload" class="dropzone">
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple />
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" id="formFiles3"></div>
                                                    <div class="d-none" id="formTemplate3">
                                                        <div class="card mb-3">
                                                            <div class="p-2">
                                                                <div class="row align-items-start">
                                                                    <div class="col-auto">
                                                                        <img data-dz-thumbnail src="#" class="avatar border rounded">
                                                                    </div>
                                                                    <div class="col pl-0">
                                                                        <a href="#" class="text-muted font-weight-bold" data-dz-name></a>
                                                                        <p class="mb-0"><small data-dz-size></small> <small class="d-block text-danger" data-dz-errormessage></small></p>
                                                                    </div>
                                                                    <div class="col-auto pt-2">
                                                                        <a class="btn-lg text-danger" href="#" data-dz-remove><i class="icon-trash-2"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="float: left;margin-top:-5px">
                                                        <small id="dropzoneHelp" class="form-text text-muted">Max file size is 2MB and max number of files is 5.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                        <div class="row"  >
                                        <div class="col-md-12">    
                                            <div class="form-group">
                                            <label> Describe Your Experience</label>
                                            <textarea type="text" class="form-control" name="experience" placeholder="Describe Your Professional Experience" ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Experience Certificate</label>
                                            <input type="file" class="form-control" name="certificate" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Previous Projects</label>
                                            <input type="text" class="form-control" name="project" placeholder="Describe About Previous Project" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Describe You</label>
                                                <textarea type="text" class="form-control" name="describe_you" placeholder="Describe You" ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" class="form-control" value="1" name="work_pressure">Works Under Pressure <br>
                                                <input type="checkbox" class="form-control" value="1" name="creative" style="margin-left: -26px">Creative <br>
                                                <input type="checkbox" class="form-control" value="1" name="multi_tasker">Multi Tasker<br>
                                                <input type="checkbox" class="form-control" value="1" name="team_player" style="margin-left: -26px">Team Player <br>
                                                <input type="checkbox" class="form-control" value="1" name="fast_learner">Fast Learner <br>
                                                <input type="checkbox" class="form-control" value="1" name="communication" style="margin-left: -26px">Good Communication Skills <br>
                                                <input type="checkbox" class="form-control" value="1" name="punctual">Punctual <br>
                                                <input type="checkbox" class="form-control" value="1" name="logical" style="margin-left: -26px">Logical Analyzer <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-t-10">
                                        <label>
                                            <input type="checkbox" class="form-control" name="whatsapp" placeholder="">Send me important updates on <img src="image/whatsappicon.0011d8c1.png" width="20px"> WhatsApp
                                        </label>
                                    </div>
                                    <span style="font-size: 13px;color: #3d9aff">By clicking Register, you agree to the Terms and Conditions & Privacy Policy of Kenz-innovations</span>
                                    <div class="row m-t-10 float-right">
                                        <button class="btn" type="submit" name="submit" style="background:#457eff;border-color:#457eff;border-radius: 20px;float: right !important"> Register Now</button>
                                    </div>
                                </div>  
                            </article>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!--Tdep_idlate functions-->
    <script src="js/functions.js"></script>
    <script type="text/javascript">
        $("#c_pass").on("keyup keydown paste change",function(){
          var pass=$("#pass").val();
          var c_pass=$("#c_pass").val();
          if (pass==c_pass) {
            $("#pass_err").html('');
            $("#submit").show();
          }else{
            $("#pass_err").html('<small style="color:red"><i class="fas fa-info-circle"></i> Passwords dont match</small>');
            $("#submit").hide();
          }
        });
    </script>
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
    <script src="plugins/dropzone/dropzone.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        //Form 1
        var form2 = $('#fileUpload1');
        form2.dropzone({
            url: "http://polo/files/post",
            addRemoveLinks: true,
            maxFiles: 1,
            maxFilesize: 10,
            acceptedFiles: "image/*",
        });
        //Form 2
        var form2 = $('#fileUpload2');
        form2.dropzone({
            url: "http://polo/files/post",
            maxFilesize: 5,
            acceptedFiles: "image/*",
            previewsContainer: "#formFiles2",
            previewTemplate: $("#formTemplate2").html(),
        });
        //Form 3
        var form3 = $('#fileUpload3');
        form3.dropzone({
            url: "http://polo/files/post",
            maxFilesize: 5,
            acceptedFiles: "image/*",
            previewsContainer: "#formFiles3",
            previewTemplate: $("#formTemplate3").html(),
            clickable: ".dropzone-attach-files"
        });
    </script>



    <script type="text/javascript">
        function activeAc(dep_id){
            var elements = document.getElementsByClassName("select-css");
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].id !== dep_id) {
                    elements[i].style.color = "#303030";
                    elements[i].style.border = "1px solid #f2f2f2";
                    elements[i].querySelector("#showActive").style.display = "none";
                }
            }

            var selectedOption = document.getElementById(dep_id);
            if (selectedOption.style.color === "black") {
                selectedOption.style.border="1px solid #f2f2f2";
                selectedOption.style.color = "#303030";
                selectedOption.querySelector("#showActive").style.display = "none";
                $("#show_experience").hide();
            } else{
                selectedOption.style.color = "black";
                selectedOption.style.border = "2px solid #457eff";
                selectedOption.querySelector("#showActive").style.display = "block";
                $("#show_experience").show();
            }
        } 
    </script>
</body>
    
</html>
<?php
    if (isset($_POST['submit'])) {         
        $name=htmlspecialchars(trim($_POST['name']));
        $email=htmlspecialchars(trim($_POST['email']));
        $password_encrypt=htmlspecialchars(trim($_POST['password']));
        $password=hash("sha256",$password_encrypt);
        $contact_number=htmlspecialchars(trim($_POST['contact_number']));
        $country_code=htmlspecialchars(trim($_POST['country_code']));
        $work_status=htmlspecialchars(trim($_POST['work_status']));
        $experience=htmlspecialchars(trim($_POST['experience']));
        $describe_you=htmlspecialchars(trim($_POST['describe_you']));
        $work_pressure=htmlspecialchars(trim($_POST['work_pressure']));
        $creative=htmlspecialchars(trim($_POST['creative']));
        $multi_tasker=htmlspecialchars(trim($_POST['multi_tasker']));
        $team_player=htmlspecialchars(trim($_POST['team_player']));
        $fast_learner=htmlspecialchars(trim($_POST['fast_learner']));
        $communication=htmlspecialchars(trim($_POST['communication']));
        $punctual=htmlspecialchars(trim($_POST['punctual']));
        $logical=htmlspecialchars(trim($_POST['logical']));

        $temp1 = explode(".", $_FILES["certificate"]["name"]);
        $text = pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION);
        $now=time();
        $custom_name = $name.'-1'.$now.'.'.end($temp1);
        $newfilename = $custom_name;
        $file="uploads/".$newfilename;
        move_uploaded_file($_FILES["certificate"]["tmp_name"],"uploads/" .$newfilename);

        $project=htmlspecialchars(trim($_POST['project']));
        $whatsapp=htmlspecialchars(trim($_POST['whatsapp']));
        $check=$conn->prepare("SELECT email FROM emp_tbl WHERE email=:email");
        $check->bindparam(':email',$email);
        $check->execute();
        if($check->rowCount()>0){
           echo'<script>window.location.href="?email_exists"</script>';
        }else{
        $insert=$conn->prepare("INSERT INTO `emp_tbl`(
                  name,
                  email,
                  password,
                  contact_number,
                  country_code,
                  work_status,
                  whatsapp,
                  experience,
                  certificate,
                  project,
                  describe_you,
                  work_pressure,
                  creative,
                  multi_tasker,
                  team_player,
                  fast_learner,
                  communication,
                  punctual,
                  logical
                  )VALUES(
                  :name,
                  :email,
                  :password,
                  :contact_number,
                  :country_code,
                  :work_status,
                  :whatsapp,
                  :experience,
                  :certificate,
                  :project,
                  :describe_you,
                  :work_pressure,
                  :creative,
                  :multi_tasker,
                  :team_player,
                  :fast_learner,
                  :communication,
                  :punctual,
                  :logical
                )");
        $insert->bindparam(':name',$name);
        $insert->bindparam(':email',$email);
        $insert->bindparam(':password',$password);
        $insert->bindparam(':contact_number',$contact_number);
        $insert->bindparam(':country_code',$country_code);
        $insert->bindparam(':work_status',$work_status);
        $insert->bindparam(':whatsapp',$whatsapp);
        $insert->bindparam(':experience',$experience);
        $insert->bindparam(':certificate',$file);
        $insert->bindparam(':project',$project);
        $insert->bindparam(':describe_you',$describe_you);
        $insert->bindparam(':work_pressure',$work_pressure);
        $insert->bindparam(':creative',$creative);
        $insert->bindparam(':multi_tasker',$multi_tasker);
        $insert->bindparam(':team_player',$team_player);
        $insert->bindparam(':fast_learner',$fast_learner);
        $insert->bindparam(':communication',$communication);
        $insert->bindparam(':punctual',$punctual);
        $insert->bindparam(':logical',$logical);
        $insert->execute();
            if ($insert) {
                $from = 'info@kenzinnovations.com';
                $to=$email;
                // $to = 'mohdshamshaiz123@gmail.com';
                $subject = 'Welcome to Kenz Career Portal';
                $body = '
                        <html>
                          <body>
                          <div style="background-color: #F0F0F0 ;padding:20px; border-radius:4px">
                              <div style="background-color: #fff; border-radius: 10px; padding:20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                  

                                  <div style="color:black; ">
                                    <span> Hi '.$name.',<br> welcome to Kenz Career Portal, you are now successfully registered as a employee.<br><br>
                                    

                                  </div>
                              </div><br>
                          </div>
                          </body>
                        </html>
                      ';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html\r\n";
                $headers .= 'From: info@kenzinnovations.com' . "\r\n" .
                'Reply-To: info@kenzinnovations.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                    if(mail($to, $subject, $body, $headers)){
                        echo '<script>window.location.href="?success"</script>';
                    }else{
                        echo '<script>window.location.href="?mailfailed"</script>';
                    }
            }else{
              echo '<script>window.location.href="?failed"</script>';
            }
        }
    }
?>