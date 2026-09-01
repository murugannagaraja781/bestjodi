<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
?>
<html>
<head>
<title> CCavenue Payment Gateway</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	//error_reporting(0);
	$getccdetails=mysqli_fetch_object($DatabaseCo->dbLink->query("select `pay_name`,`ccavenue_id`,`status`,`pay_email`,`merchant_key`,merchant_id,merchant_key,cc_access_code from payment_method where pay_id='2'"));
	
	$merchant_data='';
	$working_key= $getccdetails->merchant_key;//Shared by CCAVENUES
	$access_code=$getccdetails->cc_access_code;//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="POST" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

