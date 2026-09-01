<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
if(!isset($_SESSION['user_id'])){
setcookie("planid", $_POST['planid'], time() + (60 * 1), "/");
echo "<script>window.location='login.php';</script>";
} else {
$mid=$_SESSION['user_id'];
}
if(isset($_GET['pid'])){
$planid=$_GET['pid'];	
} elseif(isset($_COOKIE['planid'])) {
$planid=$_COOKIE['planid'];
}
$planname =  $DatabaseCo->dbLink->query("SELECT pmatri_id,p_plan FROM payments WHERE pmatri_id='$mid'");
while($DatabaseCo->dbRow = mysqli_fetch_object($planname)){
if($DatabaseCo->dbRow->p_plan =='free'){
?>
<script>alert('Welcome plan already used please select another membership plan.');
</script>
<script>window.location='membershipplans'</script>
<?php
}
}
$plantype =  $DatabaseCo->dbLink->query("SELECT plan_type FROM membership_plan WHERE plan_id='$planid'");
while($DatabaseCo->dbRow = mysqli_fetch_object($plantype)){
if($DatabaseCo->dbRow->plan_type =='FREE'){
?>
<script>window.location='contact-to-admin'</script>
<?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
    <!-- WEB SITE TITLE DESCRIPTION-->
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    <!-- WEB SITE TITLE DESCRIPTION END--> 
    <!-- WEB SITE FAVICON--> 
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
    <!-- WEB SITE FAVICON END-->
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!--GOOGLE FONTS END-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
  </head>
  <body>
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="loader">
      </div>
      <h5>Loading...
      </h5>
    </div>
    <!-- ICON LOADER END-->
    <div id="body" style="display:none">
      <div id="wrap">
        <div id="main">
          <!-- HEADER -->
          <?php include "parts/header.php"; ?>
          <?php include "parts/menu-aft-login.php"; ?>
          <!-- HEADER END-->
          <div class="container">
            <h2 class="gt-text-orange text-center gt-margin-top-20">Payment Options
            </h2>
            <p class="text-center">
              Pay fast and securly with our multiple payment option.
            </p>
            <h4 class="gt-border-bottom-smoke-white gt-padding-bottom-15">Select your payment options to pay
            </h4>
			 <!-- Paypal Payment Gateway -->
            <?php
			  	$paypal_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='1'"));
			  	if($paypal_data->status=='APPROVED'){
			 ?>
            <label for="gt-plan-1" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
              <div class="col-xxl-1 col-xl-1 col-lg-2 col-sm-2 col-xs-16 gt-margin-top-25">
                <center>
                  <!--<input type="radio" class="" name="payment-1" id="gt-plan-1">-->
                </center>
              </div>
              <?php
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$planid."'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
              <div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
                <h4>Pay using Paypal
                </h4>
                <p>
                  Plan: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_name;?>
                  </span> , Amount: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount; ?>
                  </span>
                </p>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-16 col-sm-16 col-xs-16 gt-margin-top-15 text-center">
                <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post" name="frmPayPal1">
                  <?php $sel=$DatabaseCo->dbLink->query("select * from payment_method where pay_id='1'");
$fet=mysqli_fetch_array($sel);
?>
                  <input type="hidden" name="business" value="<?php echo $fet['pay_email'];?>">
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="item_name" value="Membership Plan <?php echo $DatabaseCo->dbRow->plan_name;?> Purchase">
                  <input type="hidden" name="item_number" value="1">
                  <input type="hidden" name="credits" value="510">
                  <input type="hidden" name="userid" value="1">
                  <input type="hidden" name="amount" value="<?php if($DatabaseCo->dbRow->plan_amount_type=='$')
                                                            { 
                                                            echo $DatabaseCo->dbRow->plan_amount;
                                                            }
                                                            else
                                                            {
                                                            echo ($DatabaseCo->dbRow->plan_amount/60);
                                                            }?>">
                  <input type="hidden" name="no_shipping" value="1">
                  <input type="hidden" name="currency_code" value="<?php echo $DatabaseCo->dbRow->plan_amount_type;?>">
                  <input type="hidden" name="handling" value="0">
                  <input type="hidden" name="cancel_return" class="cancel_URL" value="<?php echo $configObj->getConfigname();?>/paymentOptions.php" />
                  <input type="hidden" name="return" class="success_URL" value="<?php echo $configObj->getConfigname();?>/paymentConfirmation.php?id=<?php echo $mid;?>&plan=<?php echo $DatabaseCo->dbRow->plan_id;?>" />
                  <input type="image" src="img/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
               
              </div>
              <?php 
}?>
				  
            </label>
            <?php }?>
			  <!-- Instamojo Payment Integration -->
			  <?php
			  	$paypal_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='6'"));
			  	if($paypal_data->status=='APPROVED'){
			 ?>
            <label for="gt-plan-9" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
              <div class="col-xxl-1 col-xl-1 col-lg-2 col-sm-2 col-xs-16 gt-margin-top-25">
                
              </div>
              <?php
				$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$planid."'");
				while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
				?>
              <div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
                <h4>Pay using Instamojo</h4>
                <p>
                  Plan: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_name;?>
                  </span> , Amount: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount; ?>
                  </span>
                </p>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-16 col-sm-16 col-xs-16 gt-margin-top-15 text-center">
                <?php
					$sql=$DatabaseCo->dbLink->query("select * from register where matri_id='".$_SESSION['user_id']."'");
	   				$res=mysqli_fetch_object($sql);
					
				  ?>
                  <form method="POST" name="customerData" action="pay" enctype="multipart/form-data">
					  	<input type="hidden" name="plan_name" value="<?php echo $DatabaseCo->dbRow->plan_name; ?>">
					    <input type="hidden" name="plan_amount" value="<?php echo $DatabaseCo->dbRow->plan_amount; ?>"/>
					  	<input type="hidden" name="email" value="<?php echo $res->email; ?>">
					    <input type="hidden" name="mobile" value="<?php echo $res->mobile; ?>"/>
					    <input type="hidden" name="name" value="<?php  echo $res->username; ?>"/>
						<input type="submit" class="btn gt-btn-orange flat  gt-btn-xxl" value="CheckOut" >
                  </form> 
				
               </div>
              <?php } ?>
				  
            </label>
            <?php }?>
				
			<!-- CCavenu Payment Gateway -->
            <?php
				$cc_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='2'"));
				if($cc_data->status=='APPROVED'){
			?>
            <label for="gt-plan-2" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
              <?php
				$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$planid."'");
				while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
					$get_mem_data=mysqli_fetch_object($DatabaseCo->dbLink->query("select * from register where matri_id='".$mid."'"));
			 ?>
             <div class="col-xxl-1 col-xl-1 col-lg-2 col-sm-2 col-xs-16 gt-margin-top-25">
                
              </div>
              <div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
                <h4>Pay using CCAvenue</h4>
                <p>
                  Plan: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_name;?>
                  </span> , Amount: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount; ?>
                  </span>
                </p>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-16 col-sm-16 col-xs-16 gt-margin-top-15 text-center">
                <?php 
					
       				$getccdetails=mysqli_fetch_object($DatabaseCo->dbLink->query("select `pay_name`,`ccavenue_id`,`status`,`pay_email`,`merchant_key`,merchant_id,merchant_key from payment_method where pay_id='2'"));
					
	  				$sql=$DatabaseCo->dbLink->query("select * from register where matri_id='".$_SESSION['user_id']."'");
	   				$res=mysqli_fetch_array($sql);
					
					$_SESSION['mid']=$mat=$res['matri_id'];
					$_SESSION['plan']=$plan=$_GET['pid'];
				    $result123 = $DatabaseCo->dbLink->query("SELECT * from membership_plan where plan_id = '$plan' ");
				    $resp=mysqli_fetch_array($result123);
	   				$_SESSION['amt']=$amt=$resp['plan_amount'];
					$_SESSION['plan_duration']=$plan_duration=$resp['plan_duration'];
					$_SESSION['MEMBERSHIP_PLAN']=$resp['plan_name'];
					$_SESSION['MEMBERSHIP_PLAN_ID']=$resp['plan_id'];
	   				function createRandomPassword() {
						$chars = "abcdefghijkmnopqrstuvwxyz023456789";
						srand((double)microtime()*1000000);
						$i = 0;
						$pass = '' ;
						while ($i <= 7) {
							$num = rand() % 33;
							$tmp = substr($chars, $num, 1);
							$pass = $pass . $tmp;
							$i++;
						}
						return $pass;
					}
					//$stremail = $_GET['emid'];
					$_SESSION['cc_orderid']=$password = createRandomPassword();
					 $Merchant_Id = $getccdetails->merchant_id  ; //This id(also User Id) available at "Generate Working Key" of "Settings & Options" 
					$Amount = $resp['plan_amount']; //your script should substitute the amount in the quotes provided here 
					$Order_Id = $password; //your script should substitute the order description in the quotes provided here 
					$Redirect_Url = "http://communitymarriages.in/ccavResponseHandler" ;//your redirect URL where your customer will be redirected after authorisation from CCAvenue   
					$WorkingKey = $getccdetails->merchant_key ;//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 

					$billing_cust_name=$res['username'];
					$billing_cust_address=''; 
					$billing_cust_state=''; 
					$billing_cust_country='';
					$billing_cust_tel=$res['mobile'];
					$billing_cust_email=$res['email']; 
					$delivery_cust_name=$res['username']; 
					$delivery_cust_address=''; 
					$delivery_cust_state = ''; 
					$delivery_cust_country = ''; 
					$delivery_cust_tel=''; 
					$delivery_cust_notes='';  
					$billing_city = ''; 
					$billing_zip = ''; 
					$delivery_city = ''; 
					$delivery_zip = '';
				  ?> 
				  <?php
					$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$_GET['pid']."'");
                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
				  ?>
                  <form method="POST" name="customerData" action="ccavRequestHandler" enctype="multipart/form-data">
						<input type="hidden" name="merchant_id" value="<?php echo $Merchant_Id;?>"/>
                        <input type="hidden" name="order_id" value="<?php echo $Order_Id;?>"/>
                        <input type="hidden" name="amount" value="<?php echo $Amount;?>"/>
                        <input type="hidden" name="currency" value="INR"/>
                        <input type="hidden" name="redirect_url" value="<?php echo $Redirect_Url ;?>"/>
                        <input type="hidden" name="cancel_url" value="membershipplans"/>
                        <input type="hidden" name="language" value="EN"/>
                        <input type="hidden" name="billing_name" value="<?php echo $res['username'];?>"/>
                        <input type="hidden" name="billing_address" value="<?php echo '' ;?>"/>
                        <input type="hidden" name="billing_state" value="<?php echo '';?>"/>
                        <input type="hidden" name="billing_zip" value="<?php echo '';?>"/>
                        <input type="hidden" name="billing_country" value="<?php echo '';?>"/>
                        <input type="hidden" name="billing_tel" value="<?php echo $res['mobile'];?>"/>
                        <input type="hidden" name="billing_email" value="<?php echo $res['email'];?>"/>
                        <input type="hidden" name="udf1" value="<?php echo $_SESSION['MEMBERSHIP_PLAN'];?>"/>
                        <input type="hidden" name="udf2" value="<?php echo $_SESSION['MEMBERSHIP_PLAN_ID'];?>"/>
                        <INPUT TYPE="submit" class="btn gt-btn-orange flat  gt-btn-xxl" value="CheckOut" >
                   </form> 
				  <?php } ?>
              </div>
              <?php }?>
            </label>
            <?php }?>  
         
            <?php
				$payu_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='5'"));
				if($payu_data->status=='APPROVED'){
			  ?>
            <label for="gt-plan-2" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
              <div class="col-xxl-1 col-xl-1 col-lg-2 col-sm-2 col-xs-16 gt-margin-top-25">
                
              </div>
              <?php
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$planid."'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
$get_mem_data=mysqli_fetch_object($DatabaseCo->dbLink->query("select * from register where matri_id='".$mid."'"));
?>
              <div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
                <h4>Pay using PayUMoney
                </h4>
                <p>
                  Plan: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_name;?>
                  </span> , Amount: 
                  <span class="gt-text-orange">
                    <?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount; ?>
                  </span>
                </p>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-16 col-sm-16 col-xs-16 gt-margin-top-15 text-center">
                <form action="PayUMoney_form" method="post" name="frmPayPal1">
                  <input type="hidden" name="plan_id" value="<?php echo $DatabaseCo->dbRow->plan_id;?>"> 
                  <input type="hidden" name="plan_name" value="<?php echo $DatabaseCo->dbRow->plan_name;?>">
                  <input type="hidden" name="plan_amount" value="<?php if($DatabaseCo->dbRow->plan_amount_type=='INR')
                                                                 { 
                                                                 echo $DatabaseCo->dbRow->plan_amount;
                                                                 }
                                                                 else
                                                                 {
                                                                 echo round($DatabaseCo->dbRow->plan_amount);
                                                                 }?>">
                  <input type="hidden" name="plan_amount_type" value="INR">
                  <!--<input type="submit" name="submit_payu" value="Paynow" class="btn btn-warning btn-large">-->
                  <center>
                    <input name="submit_payu" type='submit' id="PayUMoney" value='PayUMoney' class="btn gt-btn-orange gt-btn-xxl flat">
                  </center>
                </form>         
                
              </div>
              <?php }?>
            </label>
            <?php }?>
            <?php
				$bank_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='4'"));
				if($bank_data->status=='APPROVED'){
			 ?>	
            <label for="gt-plan-5" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
              <div class="col-xxl-1 col-xl-1 col-lg-2 col-sm-2 col-xs-16 gt-margin-top-25">
                
              </div>
              <div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
                <h4>Pay at Office
                </h4>
                <p class="gt-margin-top-20">
                  Bank Name :
                  <span class="gt-text-orange">
                    <?php echo $bank_data->bank_detail;?>
                  </span>
                </p>
                <p>
                  Bank Account Type :
                  <span class="gt-text-orange">
                    <?php echo $bank_data->bank_account_type;?>
                  </span>
                </p>
                <p>
                  Bank Account Name :
                  <span class="gt-text-orange">
                    <?php echo $bank_data->bank_account_name;?>
                  </span>
                </p>
                <p>
                  Bank Account No :
                  <span class="gt-text-orange">
                    <?php echo $bank_data->bank_account_no;?>
                  </span>
                </p>
                <p>
                  Bank IFSC Code :
                  <span class="gt-text-orange">
                    <?php echo $bank_data->bank_ifsc;?>
                  </span>
                </p>
              </div>
              
            </label>
            <?php } ?>
            
          </div>
        </div>
      </div>
      <?php include "parts/footer-before-login.php"; ?>
    </div>
    <!-- Jquery --->
    <script src="js/jquery.min.js">
    </script>
    <!--- Jquery END --->
    <!--- BOOTSTRAP AND GREEN JS--->
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.validate.js">
    </script>
    <script src="js/green.js">
    </script> 
    <!--- BOOTSTRAP AND GREEN JS END--->
    <!--- LOADER JS--->
    <script>
      (function($) {
        var $window = $(window),
            $html = $('.mobile-collapse');
        $window.width(function width() {
          if ($window.width() > 767) {
            return $html.addClass('in');
          }
          $html.removeClass('in');
        }
                     );
      }
      )(jQuery);
    </script> 
    <script> 
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
    <!--- LOADER JS END --->
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
