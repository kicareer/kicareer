<?php
ini_set('display_errors','Off'); ini_set('error_reporting', E_ALL ); define('WP_DEBUG', false); define('WP_DEBUG_DISPLAY', false);

include 'dashboard/shadow.php';
include('config.php');
$postid = $_GET['postid'];
$jobtitle = $_GET['jobtitle'];
$rolecategory = $_GET['rolecategory'];
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
    <title>Job Application</title>
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
                    .btn-css{
                        background:#2b88c4 !important;border: none !important;border-radius: 1px !important;
                    }
                    .wizard[data-style="1"] > .steps ul li > a {
    text-align: center;
     width: auto !important; 
    height: auto !important;
     border-radius: 2px; 
     /*margin-top: 30px*/
    padding: 5px 10px;
     /*background:#2b88c4 !important;border: none !important;border-radius: 1px !important;*/
}
.wizard[data-style="1"] > .steps ul li > a:hover{
 background: #2b88c4 !important;
}
.wizard > .steps ul li.current a, .wizard > .steps ul li.current a:hover, .wizard > .steps ul li.current a:active {
    background: #2b88c4;
    color: #ffffff;
}

.wizard[data-style="1"] > .steps ul {
    margin: 0px !important;
}
.number{
    display: none !important;
}
.wizard[data-style="1"] > .steps ul li::after {
    top: 1.1rem !important;
    border: 1px dashed #f2f2f2 !important;
    
}
button.btn, .btn:not(.close):not(.mfp-close), a.btn:not([href]):not([tabindex]) {
    background: #2b88c4;
    border: none !important;
}
button.btn, .btn:not(.close):not(.mfp-close), a.btn:not([href]):not([tabindex]):hover {
    background: #2b88c4 !important;
    border: none !important;
}
                </style>
            </div>
        </section>

        <div  class="container-fluid" style="margin-top:-150px">
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
                    <div class=" content col-md-9">
                      <div class="card">
                            <div class="card-body">
                                <form action="" method="POST"  enctype="multipart/form-data" id="application_from">
                                    <div>
                                        <input type="hidden" value="<?php echo $postid; ?>" name="jobid" />
                                        <input type="hidden" value="<?=$id?>" name="applied_id" />
                                        <input type="hidden" value="<?php echo $rolecategory; ?>" name="rolecategory" />

                                        <h1>Job Application</h1>
                                         <h4 class="text-muted mb-4"><small>Applying for - </small><span class="fw-bolder"><?php echo $jobtitle; ?></span></h4>
                                    </div>
                                </form>
                                <!--Wizard 7-->
                                <form id="wizard7" class="wizard needs-validation" data-style="1" novalidate  >
                                    <!--Step 1-->
                                    <h3>General Details</h3>
                                    <div class="wizard-content">
                                        <div class="form-group">
                                            <label> Email Id <span>*</span></label>
                                            <input type="" value="<?=$userRow['email']?>" <?=($logged_in==1)?'readonly=""':''?> class="form-control" name="email" placeholder="Tell us your Email ID">
                                            <span style="font-size: 12px">We'll never share your email with anyone else.</span>
                                        </div>
                                        <div class="form-group">
                                            <p class=""><i class="fas fa-chevron-right"></i> Personal Details</p>
                                            <label> Applicant Name  <span>*</span></label>
                                            <input type="" value="<?=$userRow['name']?>" <?=($logged_in==1)?'readonly=""':''?> class="form-control" name="Applicant"  placeholder="Tell us your Name">
                                        </div>
                                        <div class="form-group">
                                            <label> Mobile Number  <span>*</span></label>
                                            <input type="" placeholder="Enter your mobile number" value="<?=$userRow['contact_number']?>"  <?=($logged_in==1)?'readonly=""':''?>  class="form-control" style="width: 80%;float: right;" name="phone" required>
                                            <select name="countryCode" class="form-control" style="width:19% !important;" >
                                             
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
                                            <div class="form-text"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Current City </label>
                                                <select class="form-control" id="residence" name="residence">
                                                <option>--SELECT--</option>
                                                  
                                                </select>
                                            <div class="form-text"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="dob" name="dob" required>
                                            <div class="form-text"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <label><input type="radio" name="exp"> Fresher</label>
                                            <label><input type="radio" name="exp"> Experienced</label>
                                        </div>

                                        <p class="m-t-20"><i class="fas fa-chevron-right"></i> Preferences</p>
        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <input type="hidden" class="form-control" id="apply_position" name="apply_position" value="<?php echo $jobtitle; ?>" required>
                                                    <!-- <div class="form-text"></div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Perferred Job City <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="job_city" id="job_city">
                                                      <option value="">--SELECT--</option>
                                                        
                                                    </select>
                                                    <div class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Notice Period <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="notice_period" name="notice_period" required>
                                                      <option value="">--SELECT--</option>
                                                      <option value="One Week">One Week</option>
                                                      <option value="Two Week">Two Weeks</option>
                                                      <option value="One Month">One Month</option>
                                                      <option value="Two Months">Two Months</option>
                                                      <option value="More">More</option>
                                                    </select>
                                                    <div class="form-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Step 1-->
                                    <!--Step 2-->
                                    <h3>Competences & Education</h3>
                                    <div class="wizard-content">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                How do describe your professional experience.
                                                <textarea class="form-control"></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                What skill do you have?
                                                <textarea class="form-control"></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                Describe your education
                                                <textarea class="form-control"></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Step 2-->
                                    <!--Step 3-->
                                    <h3>Professional Expertise</h3>
                                    <div class="wizard-content">
                                        <div class="h5 mb-4">Mailing Address</div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Previous Experience
                                                <textarea class="form-control" required=""></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                Describe your roles and responsibilities
                                                <textarea class="form-control"></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                Which Projects have you done in past?
                                                <textarea class="form-control"></textarea> <button class="btn btn-sm m-t-10">Add</button>
                                                <br>
                                                <small><i class="fas fa-plus"></i> Add More</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Step 3-->
                                    <!--Step 4-->
                                    <h3>Upload Resume</h3>
                                    <div class="wizard-content">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Upload your resume
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Step 4-->
                                </form>
                                <!--end: Wizard 7-->
                            </div>
                        </div>
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
<link href="plugins/dropzone/dropzone.css" rel="stylesheet">
    <script src="plugins/dropzone/dropzone.js"></script>
      <script src="js/jquery-steps/validate.min.js"></script>
      <link href="js/jquery-steps/jquery.steps.css" rel="stylesheet">
    <script src="js/jquery-steps/jquery.steps.min.js"></script>

    <script type="text/javascript">
             //Advanced - with validation
        var wizard7 = $('#wizard7');
        wizard7.steps({
            headerTag: "h3",
            bodyTag: '.wizard-content',
            autoFocus: true,
            enableAllSteps: true,
            // titleTemplate: '<span class="number">#index#</span><span class="title">#title#</span>',
            onStepChanging: function (event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                return wizard7.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {},
            onFinishing: function (event, currentIndex) {
                return wizard7.valid();
            },
            onFinished: function (event, currentIndex) {
                INSPIRO.elements.notification("Submited",
                    "Thank you, your account has been registed successfully", "success");
            }
        });
        //Validation
        wizard7.validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            errorElement: "div",
            rules: {
                // Step 1 - Account information
                email: {
                    required: true
                },
                Applicant: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 12
                },
                password2: {
                    required: true,
                    minlength: 5,
                    maxlength: 12
                },
            
                reminders: {
                    required: true
                },
                terms_conditions: {
                    required: true
                },
            },
            errorPlacement: function (error, element) {
                $(element).parents(".form-group").append(error);
            }
        });
        $('.wizard').find(".actions ul > li > a").addClass("btn");
    </script>
<?php


  if(isset($_POST['submit'])) {
      
      $jobid = $_POST['jobid'];
      $applied_id = $_POST['applied_id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $countryCode = $_POST['countryCode'];
      $phone=$countryCode.$phone;
      $residence = $_POST['residence'];
      $dob = $_POST['dob'];
      $profile_image = $_POST['profile_image'];
      $resume = $_POST['resume'];
      $current_emp = $_POST['current_emp'];
      $current_sal = $_POST['current_sal'];
      $experience = $_POST['experience'];
      $apply_position = $_POST['apply_position'];
      $job_city = $_POST['job_city'];
      $notice_period = $_POST['notice_period'];
      $role_category = $_POST['rolecategory'];

      // FILE UPLOAD 
      
        if ($_FILES["profile_image"]["size"] < 1000000 || $_FILES["profile_image"]["size"] < 1000000) { 
        // Profile Picture
         $file_name = $_FILES['profile_image']['name'];
         $allowed_types = array('jpg', 'png');
         $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
          
          if(in_array(strtolower($file_ext), $allowed_types)) {
              
          $temp = explode(".", $file_name);
          $time = round(microtime(true)) ;
          $profile_image = $time . '.' . end($temp);
          move_uploaded_file($_FILES['profile_image']['tmp_name'], 'uploads/profile/' . $profile_image);

        }
      
        
        // resume
         
         $file_names = $_FILES['resume']['name'];
         $allowed_types = array('pdf', 'doc', 'docx');
         $file_exts = pathinfo($file_names, PATHINFO_EXTENSION);
          
          if(in_array(strtolower($file_exts), $allowed_types)) {
              
          $temps = explode(".", $file_names);
          $times = round(microtime(true)) ;
          $resume = $times . '.' . end($temps);
          move_uploaded_file($_FILES['resume']['tmp_name'], 'uploads/' . $resume);

        }  
      
      
         $addpost = new posts($conn);
         $add_post = $addpost->application_insert($jobid, $applied_id, $name, $email, $phone, $residence, $dob, $profile_image, $current_emp, $current_sal, $experience, $apply_position, $job_city, $notice_period, $resume, $role_category);
         
          $notice_message = "<div class='alert alert-success px-4 py-3'><p><i class='fas fa-check-circle'></i> Your application has been successfully submitted. Thank You.</p>";
          
            

          $send_email_to=$email;
          $login='info@kenz-innovations.com';
          // SEND EMAIL
        
        $from = 'From: customer.care@changan.com.pk'; 
        $to = $email; 
        $subject = 'Application Status  - Date'.date('d/m/Y');
        $body = '
        <html>
            <body>
            <div style="background-color: #F0F0F0 ;padding:20px; border-radius:4px">
            <div style="background-color: #fff; border-radius: 10px; padding:20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                <div style="color:black; ">
                    <div><p>Dear '.$name.'</p></div>
                    <p>We&#39;ve received your application, and are excited that you are interested to join Us!</p>
                    <p>What happens next? We&#39;ll review your application and see if you&#39;re a good fit for the position. If you do, you&#39;ll hear back from us during the next 10 days. Otherwise, your details will be held within our database for consideration for vacancies in the future.</p>
            <p>Since our recruitment needs are constantly evolving due to a progressive business trajectory, we encourage you to keep exploring fresh job opportunities by visiting our <a href="\'https://kenz-innovations.com/career\'"> <span>Kenz Innovation</span> Website</a>.</p>
            <p>Thanks again for your interest to be a part of Kenz family. We wish you all the best in your career!</p>
            <p>Best Regards,<br>Human Resources.</p>
                </div>
            </div>
        </div>

            </body>
        </html>';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html\r\n";
        $headers .= 'From: info@kenz-innovations.com' . "\r\n" .
        'Reply-To: info@kenz-innovations.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if(mail($to, $subject, $body, $headers)){
            $notice_message;
        }else{
            $notice_message;
        }
        // SEND EMAIL
        
         
        } else {
            
            $notice_message = "Upload Profile and Resume file size should be less than 1MB";
        }
         
?>
          
<script>
  
   $(document).ready(function(){
    //$('#application_from').fadeOut();
    //$('#application_from').delay(3000).fadeIn();
    //$('.response').fadeIn();
    //$('.response').html("<div class='alert alert-success px-4 py-3'><?php echo $notice_message; ?></div>");
    //$('.response').delay(3000).fadeOut();
    window.location.href="index.php?success&login&id=<?=$id?>";
   
  });

</script>

<?php } ?>

  

    <script type="text/javascript" src="js/bootstrap.js "></script>
</body>
    
</html>