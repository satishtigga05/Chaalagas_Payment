<?php

$MERCHANT_KEY = env('PAYU_MERCHANT_KEY');
$SALT = env('PAYU_SALT_KEY');
// Merchant Key and Salt as provided by Payu.

//$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

<!DOCTYPE html>
<html lang="zxx">
   
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">


  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="abstract" content="Chaala Gas Private Limited">

<meta name="copyright" content="Chaala Gas Private Limited"><meta name="description" content="CGPL is a customer centric company. CGPL’s goals transcend that of getting  cng and oil out of the ground. CGPL put accentuation on landowner cognations, environmentally safe operations, and minimizing operational footprints. CGPL withal endeavors to utilize reclaimed/recycled dihydrogen monoxide for drilling and hydraulic fracturing operations when available to minimize the utilization of fresh dihydrogen monoxide from waste products. With an experienced staff and contractors, CGPL transcends that of its competitors to ascertain that landowners and well operations can tranquilly co-subsist.">
<meta name="keywords" content="Chaala Gas,Chaala Gas Private Limited, Chaala Gas Limited, CGPL,   CGL,  oil, industry, petrol,  smart, card, lubricant, 200 Gas Outlet,   Lubes, CGlubes, retail outlets">
  
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Chaala Gas | A step towards the eco friendly</title>
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style1.css" rel="stylesheet">
      <link rel="stylesheet" href="css/animate.min.css">
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">  
      <link href="css/responsive_bootstrap_carousel.css" rel="stylesheet" media="all">


      
      <script>
        var hash = '{{$hash}}';

        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>
   <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
   </head>

   
   <body onload="submitPayuForm()">

   
  <!--=========header start============-->
      <header class="header2 header5" style="background-color: darkblue ">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                     <ul class="header-info">
                        <li class="user"><i class="fa fa-user" style="size:41px;color:white;"></i> <a href="customerlogin" style="color:white;">Customer Login</a> </li>
                        <li class="phnd"><i class="fa fa-calendar" style="size:41px;color:white;"></i> <a href="print" style="color:white;">Events</a></li>
                        <li class="phnd"><i class="fa fa-bell" style="size:41px;color:white;"></i> <a href="print" style="color:white;">Notifications</a></li>
                        <li class="phnd"> <a href="mailto:info@chaalagas.com"><i class="fa fa-envelope" style="size:41px;color:white;"></i></a></li>
                        <li class="phnd"> <a href="tel:+919406021320"><i class="fa fa-phone" style="size:41px;color:white;"></i></a></li>
                     </ul>
                  </div>
               
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="display:inline;" >
                  
                     <div class="header-socials footer-socials"> 
                     
                        <a href="https://www.facebook.com/profile.php?id=100071620723767"><i class="fa fa-facebook" style="color:white;" aria-hidden="true"></i></a> 
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true" style="color:white;"></i></a> 
                        <a href="https://www.instagram.com/chaalagas_official/"><i class="fa fa-instagram" aria-hidden="true" style="color:white;"></i></a> 
                        <a href="#"><i class="fa fa-linkedin" style="color:white;" aria-hidden="true"></i></a> 
                     </div>
                  </div>
               </div>
            </div>
         </div> 
      </header>
      <header class="header2 header5" style="background-color: green ">
         <div class="container" style="background-color: green"> 
            <div class="row" style="background-color:green;">
            
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " >
                  <a href="/" class="logo"><img src="images/banner/33333.png" class="img-responsive" alt="logo"></a>
               </div>
               
            </div>
         </div>
         <nav id="main-navigation-wrapper" class="navbar navbar-default navbar2-wrap " style="background-color: darkblue">
            <div class="container" style="color: darkblue">
               <div class="navbar-header">
                  
                  <button type="button" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false" class="navbar-toggle collapsed" style="color:black"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
               </div>
               <div id="main-navigation" class="collapse navbar-collapse " style="color:darkblue" >
                  <ul class="nav navbar-nav" >
                     <li class="dropdown ">
                        <a href="/" class="active" style="color:white;">Home</a><i class="fa fa-chevron-down"></i>
                     </li>
                     <li class="dropdown">
                        <a href="#" style="color:white;">About Us</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="thecompany" >The Company</a></li>
                           <li><a href="boardofdirectors" >Board of Directors</a></li>
                           <li><a href="organizationstructure" >Organization Structure</a></li>
                           <li><a href="ourpresence" >Our Presence</a></li>
                           <li><a href="newsandupdates" >News and Updates</a></li>
                           <li><a href="ourethics" >Our Ethics</a></li>
                           <li><a href="csr" >CSR</a></li>
                           
                        </ul>
                     </li>
                     <li class="dropdown">
                        <a href="#" style="color:white;">Our Business</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="cng" >CNG</a></li>
                           <li><a href="evcharging" >EV Charging</a></li>
                           <li><a href="autolpg" >AUTO LPG</a></li>
                           <li><a href="lpgdomestic" >LPG Domestic</a></li>
                           <li><a href="lpgindustrial" >LPG Industrial</a></li>
                           <li><a href="lpgcommericial" >LPG Commericial</a></li>
                           
                        </ul>
                     </li>
                     <!--
                     <li class="dropdown">
                        <a href="#" style="color:white;">Investors</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="investorsinformation" >Investors Information</a></li>
                           <li><a href="newspapernotices" >Newspaper Notices</a></li>
                           <li><a href="investorsnotices" >Investors Notices</a></li>
                        </ul>
                     </li> -->
                     <li class="dropdown">
                        <a href="#" style="color:white;">Careers</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="workculture">Work Culture</a></li>
                           <li><a href="currentopenings">Current Openings</a></li>
                           <li><a href="candidateapply">Apply Online</a></li>
                        </ul>
                     </li>
                     <li class="dropdown">
                        <a href="#" style="color:white;">Tenders</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="currenttenders">Current Tenders</a></li>
                           <li><a href="tenderprocedures">Tender Procedures</a></li>
                           <li><a href="tenderapply">Apply Online</a></li>
                        </ul>
                     </li>
                     <li class="dropdown">
                        <a href="#" style="color:white;">Useful Links</a><i class="fa fa-chevron-down"></i>
                        <ul class="dropdown-submenu">
                           <li><a href="knowledgecenter">Knowledge Center</a></li>
                           <li><a href="downloads">Downloads</a></li>
                           <li><a href="newconnection">Get a New Connection</a></li>
                           <li><a href="billpayments">Bill Payments</a></li>
                           <li><a href="checkgasprice">Check Gas Price</a></li>
                           <li><a href="submitreadings">Submit Meter Readings</a></li>
                           <li><a href="nearestgasstation">Nearest Gas Stations</a></li>
                        </ul>
                     </li>
                     
                     <li><a href="notifications" style="color:white;">Notifications</a></li>
                     
                     <li><a href="contact" style="color:white;">contact us</a></li>
                  </ul>
                  
                                    <a class="header-requestbtn header2-requestbtn hvr-bounce-to-right" href="candidateapply">Apply Now</a> 

                  
               </div>
            </div>
         </nav>
      </header>
      <!--=========header end============-->
            <!--=========Banner Start============-->
      <div class="inner-pages-bnr">
         <img src="images/shop-banner.jpg" class="img-responsive" alt="">
         <div class="banner-caption">
            <h1>Candidate Apply</h1>
            <ul class="breadcumb">
               <li><a href="/">Home</a> - </li>
               <li>Career - </li>
               <li>Candidate Apply</li>
            </ul>
         </div>
      </div>
      <!--=========Banner end============-->

       <!--=========Form Start============-->

       <section class="pad95-100-top-bottom">
         <div class="container">
         <h3 style="text-align:center;">Security Guard Application Form</h3>

         @if($formError)

<span style="color:red">Please fill all mandatory fields.</span>
<br/>
<br/>
@endif
            <!--=========Cart Table start============-->
            <div class="cart-table">
               <ul class="cart-table-top">
                  <li >
                     <p style="text-align:center;display:block;" id="step1detail">Step 1: Basic Details</p>
                  </li>

                  <li >
                     <p style="text-align:center;display:none;" id="step2detail">Step 2: Communication Address Details</p>
                  </li>

                  <li >
                     <p style="text-align:center;display:none;" id="step3detail">Step 3: Education Qualifications Details</p>
                  </li>

                  <li >
                     <p style="text-align:center;display:none;" id="step4detail">Step 4: Job Location Selection</p>
                  </li>
                  
               </ul>
              
               <ul class="cart-table-top cart-table-mid">
               <li>
               <form name="payuForm"  id="securityapplication" action="{{$action}}" method="POST">
               @csrf
  <div class="row" id="step1form" style="display:block;">
  <!--================ candidate Details start =====================---->

  <input type="hidden" name="key" value="{{$MERCHANT_KEY}}"/>
            <input type="hidden" name="hash" value="{{$hash}}"/>
            <input type="hidden" name="txnid" value="{{$txnid}}"/>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">First Name*</label>
      <input type="text" class="form-control" placeholder="First Name" name="firstname" id="name"  value="{{!empty($posted['firstname']) ? $posted['firstname'] : ''}}" required>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Middle Name</label>
      <input type="text" class="form-control" placeholder="Middle Name" id="middlename" name="middlename">
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Last Name*</label>
      <input type="text" class="form-control" placeholder="Last Name"  id="lastname" name="lastname" required>
      <br>
    </div>

    <!--================ candidate Details start =====================---->
  

    <!--================ candidate Mother's Details start =====================---->
  
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Mother's  Name*</label>
      <input type="text" class="form-control" placeholder="Mother's Name"  name="mothername" id="mothername" required>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Father's Name*</label>
      <input type="text" class="form-control" placeholder="Father's Name" id="fathername"  name="fathername" required>
    </div>

    

    <!--================ candidate Mother's Details start =====================---->

    


    <!--================ candidate Contact's Details start =====================---->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Email*</label>
      <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{!empty($posted['email']) ? $posted['email'] : ''}}" required>
      <br>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Mobile No*</label>
      <input type="text" class="form-control" placeholder="Mobile No" name="phone" id="mobile" value="{{!empty($posted['phone']) ? $posted['phone'] : ''}}" required>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">D.O.B*</label>
      <input type="date" class="form-control" placeholder="DD/MM/YYYY" name="dob" id="dob" required>
      <br>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="inputcaste">Caste*</label>
    <select class="form-control"  name="caste" id="caste" required>
        <option value="" selected>-- Select Caste -- </option>
        <option value="ST">ST</option>
        <option value="SC">SC</option>
        <option value="OBC">OBC</option>
        <option value="EWS">EWS</option>
        <option value="General">General</option>
    </select>
    <br>
    </div>

    <div class="col-12" style="display:none;">
                        <div class="form-group mb-3 position-relative">
                            <input class="input-box form-control w-100" placeholder="Amount *" type="text" name="amount" id="amount"
                                   value="{{!empty($posted['amount']) ? $posted['amount'] : ''}}">
                            <div class="icon-group-append">
                                <i class="fas fa-tag"></i>
                            </div>
                        </div>
                    </div>


                    <div class="col-12" style="display:none;">
                        <div class="form-group mb-3 position-relative">
                            <textarea class="input-box form-control w-100" placeholder="Note *" name="productinfo" value="Security Guard Application Form Fees">{{!empty($posted['productinfo']) ? $posted['productinfo'] : ''}}</textarea>
                            <div class="icon-group-append">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="aadharnumber">Aadhar  Number*</label>
    <input type="textarea" class="form-control" placeholder="Aadhar Number"  name="aadharnumber" id="aadharnumber" required>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="inputmaritalstatus">Marital Status*</label>
    <select class="form-control"  name="maritalstatus" id="maritalstatus" required>
        <option value="">-- Select Status -- </option>
        <option value="Married">Married</option>
        <option value="Unmarried">Unmarried</option>
        <option value="Widow">Widow</option>
    </select>
    <br>
    </div>

   
    <!--================ candidate Contact's Details ends =====================---->
    </div>
     
     
    
    <div class="row" id="step2form" style="display:none;">

      <!--================ candidate Communication's Details Starts =====================---->
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
     <label for="inputState">State*</label>
      <select id="inputState" class="form-control" name="state" required>
      <option value="SelectState">Select State</option>
                        <option value="Andra Pradesh">Andra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madya Pradesh">Madya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Orissa">Orissa</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttaranchal">Uttaranchal</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="West Bengal">West Bengal</option>
                        <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadeep">Lakshadeep</option>
                        <option value="Pondicherry">Pondicherry</option>
                      </select>
      </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="inputDistrict">District*</label>
    <select class="form-control" id="inputDistrict" name="district" required>
        <option value="">-- Select District -- </option>
    </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Thesil*</label>
      <input type="textarea" class="form-control" name="thesil" id="thesil" placeholder="Thesil" required>
      <br>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Pincode*</label>
      <input type="textarea" class="form-control" name="pincode" id="pincode" placeholder="Pincode" required>
    </div>


    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Permanent Address*</label>
      <input type="textarea" class="form-control" placeholder="Permanent address" name="permanentaddress" id="permanentaddress" required>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupExampleInput">Current Address*</label>
      <input type="textarea" class="form-control" placeholder="Current address" name="currentaddress" id="currentaddress">
      <br>
    </div>

    
    
      <!--================ communication Details Address's Details ends =====================---->

    </div>
    


      <!--================ Education Details starts =====================---->
      <div class="row" id="step3form" style="display:none;">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
         <label for="education">Education*</label>
    <select class="form-control" id="education" name="education" required>
        <option value="">-- Select Qualification -- </option>
        <option value="8th_Pass">8th Pass</option>
        <option value="10th_Pass">10th Pass</option>
    </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <label for="formGroupPercentage">Percentage*</label>
      <input type="textarea" class="form-control" placeholder="Percentage" name="percentage" id="percentage">
      
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
         <label for="inputexperience">Experience*</label>
    <select class="form-control" id="experience" name="experience" required>
        <option value="">-- Select Experience -- </option>
        <option value="0_Year">0 Year</option>
        <option value="1_Year">1 Year</option>
        <option value="2_Year">2 Year</option>
        <option value="3_Year">3 Year</option>
        <option value="3Plus_Year">3 Year Plus</option>
    </select>
    </div>

    
      </div>

      <!--================ Education Details ends =====================---->


       <!--================ Post Selection Starts =====================---->
      <div class="row" id="step4form" style="display:none;">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
         <label for="inputdivision">Division*</label>

         <select name="jobdivision" id="jobdivision">
    <option value="" selected="selected">-- Select Division -- </option>
  </select>

  <!--
    <select class="form-control" id="jobdivision" name="jobdivision" required>
        <option value="">-- Select Division -- </option>
        <option value="Raipur">Raipur</option>
        <option value="Durg">Durg</option>
        <option value="Bilaspur">Bilaspur</option>
        <option value="Bastar">Bastar</option>
        <option value="Sarguja">Sarguja</option>
    </select>

    -->
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  style="display:block;">
         <label for="inputdivision">District*</label>

         <select name="jobdistrict" id="jobdistrict">
    <option value="" selected="selected">-- Select District -- </option>
  </select>

  <!--
    <select class="form-control" id="jobdistrictraipur" name="jobdistrict" required>
        <option value="">-- Select District -- </option>
        <option value="Dhamtari">Dhamtari</option>
        <option value="Durg">Durg</option>
        <option value="Gariyaband">Gariyaband</option>
        <option value="Raipur">Raipur</option>
        <option value="Baloda_Bazaar">Baloda Bazaar</option>
    </select>

    -->
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="raipurdivision1" style="display:none;">
         <label for="inputdivision">District*</label>

         <select name="jobdistrict1" id="jobdistrict1">
    <option value="" selected="selected">-- Select District -- </option>
  </select>
  </div>
<!--
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="bilaspurdivision" style="display:none;">
         <label for="inputdivision">District*</label>
    <select class="form-control" id="jobdistrictbilaspur" name="jobdistrict" required>
        <option value="">-- Select District -- </option>
        <option value="Bilaspur">Bilaspur</option>
        <option value="Mungeli">Mungeli</option>
        <option value="Korba">Korba</option>
        <option value="Janjgir_Chappa">Janjgir Chappa</option>
        <option value="Raigarh">Raigarh</option>
        <option value="Gurela_Pendra">Gurela Pendra</option>
    </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="sargujadivision" style="display:none;">
         <label for="inputdivision">District*</label>
    <select class="form-control" id="jobdistrictsarguja" name="jobdistrict" required>
        <option value="">-- Select District -- </option>
        <option value="Jashpur">Jashpur</option>
        <option value="Korea">Korea</option>
        <option value="Surajpur">Surajpur</option>
        <option value="Balrampur">Balrampur</option>
        <option value="Ambikapur">Ambikapur</option>
        
    </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="durgdivision" style="display:none;">
         <label for="inputdivision">District*</label>
    <select class="form-control" id="jobdistrictdurg" name="jobdistrict" required>
        <option value="">-- Select District -- </option>
        <option value="Kawardha">kawardha</option>
        <option value="Rajnandgaon">Rajnandgaon</option>
        <option value="Balod">Balod</option>
        <option value="Durg">Durg</option>
        <option value="Bemetara">Bemetara</option>
        
    </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="bastardivision" style="display:none;">
         <label for="inputdivision">District*</label>
    <select class="form-control" id="jobdistrictbastar" name="jobdistrict" required>
        <option value="">-- Select District -- </option>
        <option value="Bijapur">Bijapur</option>
        <option value="Sukma">Sukma</option>
        <option value="Dantewada">Dantewada</option>
        <option value="Jagdalpur">Jagdalpur</option>
        <option value="Kondagaon">Kondagaon</option>
        <option value="Narayanpur">Narayanpur</option>
        <option value="Kanker">Kanker</option>
        
    </select>
    </div>

    -->
      </div>
   

       <!--================ Post Selection Ends =====================---->


       <input name="surl" value="https://chaalagas.com/" hidden/>
            <input name="furl" value="https://chaalagas.com/cng" hidden/>
            <input type="hidden" name="service_provider" value="payu_paisa"/>
    
    
    
    
    

  

  
  
      
  
  
 </li>
               </ul>
               <ul class="cart-table-top cart-table-btm">
               
                  
                  
                  <li class="continue-shop" name="step1btn" id="step1btn" style="display:block;"><a class="continue-shop update-shoppingbtn" onclick="step1check()">Next</a></li>
                  <li class="continue-shop" name="step2btn" id="step2btn" style="display:none;"><a class="continue-shop update-shoppingbtn" onclick="step2check()">Next</a></li>
                  <li class="continue-shop" name="step3btn" id="step3btn" style="display:none;"><a class="continue-shop update-shoppingbtn" onclick="step3check()">Next</a></li>
                  @if(!$hash)
                  <li class="continue-shop" name="step4btn" id="step4btn" style="display:none;"><button type="submit" class="btn btn-primary">
                                 Make Payment
                            </button>  </li>
                            @endif

               </ul>
            </div>
            <!--=========Cart Table end============-->
            </form>  
   
         </div>
      </section>

       <!--=========Form End============-->

      
      <!--=========Footer Start============-->
      <footer>
         <div class="yellow-background solution-available text-center" style="background-color:limegreen;">
            <div class="container">
               <marquee><h5>“Dear Customer, Chaala Gas never ask for your confidential details like net banking or UPI ID, card PIN, CVV, OTP. Therefore any one pretending to be asking you for information may be fraudulent entities.” </h5></marquee>
               
            </div>
         </div>
         <div class="ftr-section">
            <div class="container">
               
               <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-12  ftr-about-text">
                     <h6>About Us</h6>
                     <p class="marbtm20 line-height26">Chaala Gas may be a clean fuel energy company with its vision to re-define the producing & distribution of alternate future energy sector. the corporate owns a passion to drive & pioneer the longer term energy revolution. the concept behind it's to own a inexperienced planet & energy independence likewise as contribute in making business opportunities for the millennial’s, entrepreneurs, and so on</p>
                     <a class="ftr-read-more" href="about">About Us</a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12 ftr-sol-column">
                     <h6>Our Solutions</h6>
                     <ul class="footer-link">
                        <li><a href="cng">- CNG</a></li>
                        <li><a href="evcharging">- EV Charging</a></li>
                        <li><a href="lpgdomestic">- LPG Domestic</a></li>
                        <li><a href="lpgindustrial">- LPG Industrial</a></li>
                        <li><a href="lpgcommercial">- LPG Commercial</a></li>
                     </ul>
                  </div>
                  <div class="col-md-2 col-sm-6 col-xs-12 ftr-link-column">
                     <h6>Quick Links</h6>
                     <ul class="footer-link">
                        <li><a href="currentopenings">- Current Openings</a></li>
                        <li><a href="currenttenders">- Current Tenders</a></li>
                        <li><a href="newconnection">- Get an New Connection</a></li>
                        <li><a href="billpayments">- Bill Payment</a></li>
                        <li><a href="checkgasprice">- Gas Price Check</a></li>
                     </ul>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12 ftr-follow-column pull-right">
                     <h6>Follow Us</h6>
                     <div class="header-socials footer-socials"> 
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> 
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
                     </div>
                     <span class="ftr-logo img"><img src="images/cglff.png" class="img-responsive" alt="logo-image"></span>
                  </div>
               </div>
               <div class="footer-btm">
                  <div class="col-md-6 col-sm-6 col-xs-12 pad-left_zero pad-right_zero">
                     <p>Copyright © 2021 Chaala Gas. All Rights Reserved.</p>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12 pad-left_zero pad-right_zero pull-right">
                     <a href="privacy">Privacy Policy</a> &nbsp;
                     <a href="disclaimer">Disclaimer</a> &nbsp;
                     <a href="sitemap">Sitemap</a> &nbsp;
                  </div>
               </div>
            </div>
         </div>
      </footer>
     
      <!--=========Footer end============-->

   <script>
      function step2form(){
         
         var x = document.getElementById('step1form');
         var y = document.getElementById('step1detail');
         var z = document.getElementById('step1btn');

         var a = document.getElementById('step2form');
         var b = document.getElementById('step2detail');
         var c = document.getElementById('step2btn');

         var checkcaste = document.getElementById('caste').value;

         if(checkcaste == "ST" ||checkcaste == "ST" ){
            document.getElementById("amount").value = "10";
         }
         else {
            document.getElementById("amount").value = "15";
         }
         
         
         
            if (a.style.display === 'none') {
            x.style.display = 'none';
            y.style.display = 'none';
            z.style.display = 'none';

            a.style.display = 'block';
            b.style.display = 'block';
            c.style.display = 'block';


          } else {
            x.style.display = 'block';
            y.style.display = 'block';
            z.style.display = 'block';

            a.style.display = 'none';
            b.style.display = 'none';
            c.style.display = 'none';
         }
      }


      function step3form(){
         var x1 = document.getElementById('step2form');
         var y1 = document.getElementById('step2detail');
         var z1 = document.getElementById('step2btn');

         var a1 = document.getElementById('step3form');
         var b1 = document.getElementById('step3detail');
         var c1 = document.getElementById('step3btn');
         
        
         
            if (a1.style.display === 'none') {
            x1.style.display = 'none';
            y1.style.display = 'none';
            z1.style.display = 'none';

            a1.style.display = 'block';
            b1.style.display = 'block';
            c1.style.display = 'block';


          } else {
            x1.style.display = 'block';
            y1.style.display = 'block';
            z1.style.display = 'block';

            a1.style.display = 'none';
            b1.style.display = 'none';
            c1.style.display = 'none';
         }
      }

      function step4form(){
         var x2 = document.getElementById('step3form');
         var y2 = document.getElementById('step3detail');
         var z2 = document.getElementById('step3btn');

         var a2 = document.getElementById('step4form');
         var b2 = document.getElementById('step4detail');
         var c2 = document.getElementById('step4btn');
         
        
         
            if (a2.style.display === 'none') {
            x2.style.display = 'none';
            y2.style.display = 'none';
            z2.style.display = 'none';

            a2.style.display = 'block';
            b2.style.display = 'block';
            c2.style.display = 'block';


          } else {
            x2.style.display = 'block';
            y2.style.display = 'block';
            z2.style.display = 'block';

            a2.style.display = 'none';
            b2.style.display = 'none';
            c2.style.display = 'none';
         }
      }

   var DivisionObject = {
  "RAIPUR": {
    "DHAMTARI":["SS"],
     "GARIYABAND":["SS"],
      "RAIPUR":["SS"],
   "BALODA BAZAR":["SS"],
   "MAHASAMUND":["SS"]
  },
  "BILASPUR": {
   "BILASPUR":["SS"],
"MUNGELI":["SS"],
"KORBA":["SS"],
"JANJGIR-CHANPA":["SS"],
"RAIGARH":["SS"],
"GAURELA PENDRA":["SS"] 

  },
  "SARGUJA ": {
   "JASHPUR":["SS"],
"KOREA":["SS"],
"SURAJPUR":["SS"],
"BALRAMPUR":["SS"],
"AMBIKAPUR":["SS"]

},
  "DURG" : {
   "KAWARDHA":["SS"],
"RAJNANDGAON":["SS"],
"BALOD":["SS"],
"DURG":["SS"],
"BEMETARA":["SS"]

  },
  "BASTAR" : {
   "BIJAPUR":["SS"],
"SUKMA":["SS"],
"DANTEWADA":["SS"],
"JAGDALPUR":["SS"],
"KONDAGAON":["SS"],
"NARAYANPUR":["SS"],
"KANKER":["SS"]

  }

}


window.onload = function() {
  var division = document.getElementById("jobdivision");
  var district = document.getElementById("jobdistrict");
  var district1 = document.getElementById("jobdistrict1");
  for (var x in DivisionObject) {
    division.options[division.options.length] = new Option(x, x);
  }
  division.onchange = function() {
 //empty Chapters- and Topics- dropdowns
 district.length = 1;
district1.length = 1;
 
    //display correct values
    for (var y in DivisionObject[this.value]) {
      district.options[district.options.length] = new Option(y, y);
    }
   }

   district.onchange = function() {
 //empty Chapters dropdown
district1.length = 1;
    //display correct values
    var z = DivisionObject[division.value][this.value];
    for (var i = 0; i < z.length; i++) {
      district1.options[district1.options.length] = new Option(z[i], z[i]);
    }
  }
  }

  function step1check(){
   var firstname = document.forms["securityapplication"]["firstname"].value;
  if (firstname == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }
  var lastname = document.forms["securityapplication"]["lastname"].value;
  if (lastname == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var mothernamename = document.forms["securityapplication"]["mothername"].value;
  if (mothername == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var fathername = document.forms["securityapplication"]["fathername"].value;
  if (fathername == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var email = document.forms["securityapplication"]["email"].value;
  if (email == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var mobile = document.forms["securityapplication"]["mobile"].value;
  if (mobile == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var dob = document.forms["securityapplication"]["dob"].value;
  if (dob == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var caste = document.forms["securityapplication"]["caste"].value;
  if (caste == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var aadharnumber = document.forms["securityapplication"]["aadharnumber"].value;
  if (aadharnumber == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var maritalstatus = document.forms["securityapplication"]["maritalstatus"].value;
  if (maritalstatus == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }
 
  step2form();
  }
  function step2check(){
   var state = document.forms["securityapplication"]["state"].value;
  if (state == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }


  var district = document.forms["securityapplication"]["district"].value;
  if (district == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var thesil = document.forms["securityapplication"]["thesil"].value;
  if (thesil == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var pincode = document.forms["securityapplication"]["pincode"].value;
  if (pincode == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var permanentaddress = document.forms["securityapplication"]["permanentaddress"].value;
  if (permanentaddress == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var currentaddress = document.forms["securityapplication"]["currentaddress"].value;
  if (currentaddress == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var currentaddress = document.forms["securityapplication"]["currentaddress"].value;
  if (currentaddress == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }
  step3form();
  
  
   }
   function step3check(){


      var education = document.forms["securityapplication"]["education"].value;
  if (education == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var percentage = document.forms["securityapplication"]["percentage"].value;
  if (percentage == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var experience = document.forms["securityapplication"]["experience"].value;
  if (experience == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  step4form();
     
   }
   function step4check(){
      var jobdivision = document.forms["securityapplication"]["jobdivision"].value;
  if (jobdivision == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  var jobdistrict = document.forms["securityapplication"]["jobdistrict"].value;
  if (jobdistrict == "") {
    alert("Please fill the marked details");
    location.reload();
    return false;
  }

  payment();
   }
  function payment(){
   var casteq = document.getElementById('caste').selectedIndex;
   var we = document.getElementsByTagName("option")[casteq].value
   
  if (we == "SC" || we == "ST" ) {
   
   st();
   
  }else {
   
   gen();
  }
  
  }

  function gen(){
   document.getElementById("securityapplication").submit();
   location.href = 'https://imjo.in/txyQuZ';
   alert("Dear Candidate We will notify you the application detail via email,");
  }

  function st(){
   document.getElementById("securityapplication").submit();
   location.href = 'https://imjo.in/VuNbSu';
   alert("Dear Candidate We will notify you the application detail via email,");
  }
      
   </script>
   <script src="js/jquery.min.js"></script> 
   <script src="js/bootstrap.min.js"></script> 
   <script src="js/jquery.touchSwipe.min.js"></script> 
   <script src="js/responsive_bootstrap_carousel.js"></script> 
   <script src="js/custom.js"></script>
   <script src="js/slick.js"></script>
   <script src="js/state.js"></script>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   </body>

</html>