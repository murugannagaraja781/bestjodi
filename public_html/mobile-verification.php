<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

/*-- index form data --*/
if (isset($_POST['chk_terms'])) {

    $_SESSION['reg_caste'] = $_POST['caste'];
    $_SESSION['reg_email'] = $_POST['email'];
    $_SESSION['reg_country'] = $_POST['country'];
    $_SESSION['reg_bday'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $_SESSION['reg_fnmae'] = htmlspecialchars($_POST['nickname'], ENT_QUOTES);
    $_SESSION['reg_lnmae'] = htmlspecialchars($_POST['lastname'], ENT_QUOTES);
    $_SESSION['reg_gender'] = $_POST['gender'];
    $_SESSION['reg_m_tongue'] = $_POST['m_tongue'];
    $_SESSION['reg_code'] = $_POST['code'];
    $_SESSION['reg_mobile'] = $_POST['mobile'];
    $_SESSION['reg_profile_by'] = $_POST['profile_by'];
    $_SESSION['reg_religion'] = $_POST['religion'];
	
	$SQL_STATEMENT = $DatabaseCo->dbLink->query("insert into first_form(id,gender,first_name,last_name,dob,mobile_no,email_id)values ('','".$_SESSION['reg_gender']."','".$_SESSION['reg_fnmae']."','".$_SESSION['reg_lnmae']."','".$_SESSION['reg_bday']."','".$_SESSION['reg_mobile']."','".$_SESSION['reg_email']."')");
	
    $_SESSION['fb_id'] = isset($_POST['fb_id']) ? $_POST['fb_id'] : '';
    $s = "select matri_id from register where email='" . $_SESSION['reg_email'] . "'";
    $rr = $DatabaseCo->dbLink->query($s);

    if (mysqli_num_rows($rr) > 0) {
        echo "<script>alert('Email id is already Exist.');window.location='login.php'</script>";
    }
	
	
	$user = ucfirst($_POST['nickname']);
    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
	
    $text = "Hello $user, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno = $_POST['mobile'];
	$code = $_POST['code'];
    //$mobile=substr($row1['code'],0,3);
   //$mno=substr($row1['mobile'],3,15);
	include 'mobile-apis.php';
	//$url;
	//$url="https://control.msg91.com/api/sendhttp.php?authkey=176253A9UrfOSn1RT59c79510&mobiles=$code$mno&message=$message&sender=SHMATE&route=4&country=0";
    $ret = file($url);	
}
/*-- index form data End--*/
/*-- verify OTP --*/
if (isset($_POST['verify_submit'])) {
    if ($_POST['varify_code'] == $_SESSION['order_id']) {
        ?>
        <?php
        print "<script>";
        print "self.location='register'";
        print "</script>";
    }else{
		$msg="<b style='color:red'>Please Enter Valid OTP</b>";
	}
}
/*-- verify OTP End--*/
/*-- Send OTP Again --*/
if (isset($_POST['sms'])) {
    $order_id = uniqid(rand(10, 1000), false);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
    //	$fet=mysqli_fetch_array($DatabaseCo->dbLink->query("select email_26,sms from  subscribe_email where email='".$row1['email']."'"));
   /* if (isset($_SESSION['reg_mobile'])) {
        $text = "Dear User, your Verification Code is $order_id";
        $message = str_replace(" ", "%20", $text);
        $mno = $_SESSION['reg_mobile'];
        //$mobile=substr($row1['mobile'],0,3);
        //	$mno=substr($row1['mobile'],3,15);
        //$url="http://www.smsc11.com/corp/corporate/sendsms.jsp?uname=kkalyanam&pass=kkalyanam@123&mobile=$mno&msg=$message&sender=KKLYNM";
        //$ret = file($url);
    }*/
}
/*-- Send OTP Again End--*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <meta name="theme-color" content="#549a11">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#549a11">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        <!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <!-- WEB SITE TITLE DESCRIPTION END--> 

        <!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

        <!--CHOOSEN CSS-->
        <link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!--CHOOSEN CSS END-->

        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- FONT AWESOME END-->
        
		<!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
        
        <!-- VALIDATE CSS -->
        <link rel="stylesheet" href="css/validate.css">
        <!-- VALIDATE CSS END-->
        
        <link href="css/bootstrap-pincode-input.css" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <!--- JQUERY --->
        <script src="js/jquery.min.js"></script>
        <!--- JQUERY END--->


    </head>
    <body>
        <div id="wrap">
            <div id="main">
                <?php include "parts/header.php"; ?>
                <?php include "parts/menu-aft-login.php"; ?>
                <div class="container">
                    <div class="gtRegister gtMobileVerification col-xxl-10 col-xxl-offset-3 col-xs-16 col-xs-offset-0  gtBgLgtGrey">
                        <h5 class="text-center gt-border-bottom-smoke-white gt-padding-bottom-15">
                            <i class="fa fa-envelope gt-margin-right-10"></i>Tell us which kind of life partner you want to marry and we will find for you.Just fill below details and step closer to your life partner. 
                        </h5>
                        <div class="text-center gt-text-orange">
                            <i class="fa fa-mobile" style="font-size:78px;"></i>
                        </div>
                        <h3 class="text-center gt-text-orange">
                            Verify your mobile number now to activate your profile.
                        </h3>
                        <article class="text-center">
                            It is mandatory that you verify your mobile number else your profile will not be displayed to other members.
                        </article>
                        <div class="gtSMSVerification col-xxl-10 col-xxl-offset-3">
                            <h4>
                                Verify mobile number through SMS
                            </h4>
                            <p class="font-12">An SMS with verification PIN has been sent to </p>
                            <h5 class="gtMobileNo">
                                <?php echo $_SESSION['reg_code']; ?>-<?php echo $_SESSION['reg_mobile']; ?>
                            </h5>
                            <div class="form-group gt-margin-top-20">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-16 col-xs-16 gt-margin-bottom-20">
                                           	<input type="text" id="pincode-input1" class="gt-form-control otp-enter" name="varify_code" >
                                           <!-- <input type="text"  placeholder="Enter Your OTP code here">-->
                                        </div>
                                        <div class="col-md-16 col-xs-16 text-center ">
                                            <input type="submit" name="verify_submit" class="btn gt-btn-green btn-lg gt-margin-top-5 " value="Verify">
                                        </div>
                                        <div class="col-xs-16 gt-margin-top-10">
											<?php if (isset($_POST['verify_submit'])) {
												echo $msg; 
}											?>
										</div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-16"> 
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-xs-16 font-12">
                                            Not received verification code yet? 
                                        </div>
                                        <div class="col-xs-16">
                                            <input type="submit" name="sms" class="btn gt-btn-orange gt-margin-top-5" value="Send OTP Again">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                	<div class="col-xs-16 gt-margin-top-15">
                                		<a href="register" >Skip mobile verification <i class="fa fa-caret-right"></i></a>
									</div>
                                </form>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>  
        <?php include "parts/footer-before-login.php"; ?>
        <!-- bootstrap and green js -->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/green.js"></script>
        <!-- bootstrap and green js End -->
        <script type="text/javascript" src="js/bootstrap-pincode-input.js"></script>
        <script>
        $(document).ready(function() {
            $('#pincode-input1').pincodeInput({hidedigits:false,complete:function(value, e, errorElement){
            	$("#pincode-callback").html("This is the 'complete' callback firing. Current value: " + value);
            }});  
        });
			window.onload = function() {
  				$('#pincode-input1').pincodeInput().data('plugin_pincodeInput').focus();
			};
       </script>
    </body>
</html>



