<?php
ob_start();	

	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	include_once 'lib/requestHandler.php';
	
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '798007383734559','126e91b840e50a43c3d3d38480f48482' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://thegreentech.in/premium-matri-demo/fb-config.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?fields=email,first_name,last_name,gender,birthday' );
  $response = $request->execute();
  // get response
  		$graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	  	$first_name = $graphObject->getProperty('first_name'); // To Get Facebook first name
		$last_name = $graphObject->getProperty('last_name'); // To Get Facebook first name
	    $femail = $graphObject->getProperty("email");   // To Get Facebook email ID
		$gender = $graphObject->getProperty("gender");
		$fb_birthday = $graphObject->getProperty("birthday");
		
		$org=explode('/',$fb_birthday);
		$month=$org[0];
		$day=$org[1];
		$year=$org[2];
	    
		 
		
           $query = "select * from register_view where fb_id='".$fbid."'";
           $SQL_STATEMENT = $DatabaseCo->dbLink->query($query);
		  
		     if($DatabaseCo->dbRow = mysqli_num_rows($SQL_STATEMENT)>0)
			 {
				  echo "<script>window.location='login?exist=yes';</script>";
			 }
	
	
	$url = 'http://graph.facebook.com/'.$fbid.'/picture?type=large';
	$data = file_get_contents($url);
	$fileName = time().'.jpg';
	$file = fopen($fileName, 'w+');
	$fl=fputs($file, $data);	
	fclose($file);
	copy($fileName, 'my_photos/'.$fileName);
	copy($fileName, 'my_photos_big/'.$fileName);
	unlink($fileName); 
	
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['fb_first_name'] = $first_name;
		$_SESSION['fb_last_name'] = $last_name;		
	    $_SESSION['fb_email'] =  $femail;
		$_SESSION['fb_gender']  = ucfirst($gender);	
		$_SESSION['fb_image']  = $fileName;
		$_SESSION['month']  = $month;
		$_SESSION['day']  = $day;
		$_SESSION['year']  = $year;
		
    /* ---- header location after session ----*/
		
		
  
  echo "<script>window.location='index';</script>";
} 
else
 {
  //$loginUrl = $helper->getLoginUrl();
  
  $loginUrl = $helper->getLoginUrl(array(
   'scope' => 'email,user_birthday'
 ));
 
 
 // 'scope' => ' email,user_birthday,user_about_me'

 header("Location: ".$loginUrl);
}

ob_flush();	
?>