<?php

session_start();

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

FacebookSession::setDefaultApplication( '454326058104026','00eb599196cfeefec9c0c77877354a31' );

// login helper with redirect_uri

    $helper = new FacebookRedirectLoginHelper('http://shaadimate.in/fbconfig.php' );

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

  $request = new FacebookRequest( $session, 'GET', '/me' );

  $response = $request->execute();

  // get response

  $graphObject = $response->getGraphObject();

     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID

 	    $fbuname = $graphObject->getProperty('username');  // To Get Facebook Username

		$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name

		$fbbdate = $graphObject->getProperty('birthday'); // To Get Facebook full name

		$fbcountry = $graphObject->getProperty('country'); // To Get Facebook full name

		$fbstate = $graphObject->getProperty('state'); // To Get Facebook full name

		$fbcity = $graphObject->getProperty('city'); // To Get Facebook full name

		

		$fbaddress = $graphObject->getProperty('address'); // To Get Facebook full name

		

		$fbemail_hashes = $graphObject->getProperty('email_hashes'); // To Get Facebook full name

		$fblanguages = $graphObject->getProperty('languages'); // To Get Facebook full name

		$fbpic_big = $graphObject->getProperty('pic_big'); // To Get Facebook full name

		$fbsex = $graphObject->getProperty('gender'); // To Get Facebook full name

		

		

		

		

	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID

	/* ---- Session Variables -----*/

	    $_SESSION['FBID'] = $fbid;           

        $_SESSION['FULLNAME'] = $fbfullname;

	   	$_SESSION['USERNAME'] = $fbuname;

        $_SESSION['EMAIL'] =  $femail;

   		$_SESSION['LANGUAGE'] =  $fblanguages;

		$_SESSION['email_hashes'] =  $fbemail_hashes;

		$_SESSION['address'] =  $fbaddress;

		$_SESSION['city'] =  $fbcity;

		$_SESSION['state'] =  $fbstate;

		$_SESSION['country'] =  $fbcountry;

		$_SESSION['bdate'] =  $fbbdate;

		$_SESSION['fbpic_big'] =  $fbpic_big;

   		$_SESSION['sex'] = $fbsex;	

   	

    /* ---- header location after session ----*/

  header("Location:index.php");

} else {

  $loginUrl = $helper->getLoginUrl();

 header("Location: ".$loginUrl);

}

?>