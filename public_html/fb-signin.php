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
FacebookSession::setDefaultApplication( '1714729758853738','4791207b9d08b83859cb4cb929b6c4b7' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://keralamatrimonyweb.com/fb-signin.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) 
{
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?fields=email' );
  $response = $request->execute();
  // get response
  		$graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	  	$full_name = $graphObject->getProperty('name'); // To Get Facebook first name
	    $femail = $graphObject->getProperty("email"); 
	   
	   if($femail!='')
	   {
		$chkemail=" or email='".$femail."'";
	   }
	   else
	   {
		$chkemail= "";   
	   }
		
		   $STATUS_MESSAGE="";
           $SQL_STATEMENT = $DatabaseCo->dbLink->query("select * from register where (fb_id='".$fbid."' $chkemail) AND status!='Suspended'");
           //$statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
		   
		   
		  
		   
		 if($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
         {
		     if($DatabaseCo->dbRow->status!='Inactive')
		     {
                           
                $_SESSION['user_name'] = $DatabaseCo->dbRow->email;
                $_SESSION['user_id'] = $DatabaseCo->dbRow->matri_id;
				$_SESSION['uname'] = $DatabaseCo->dbRow->username;
				$_SESSION['gender123'] = $DatabaseCo->dbRow->gender;
				$_SESSION['uid'] = $DatabaseCo->dbRow->index_id;
				$_SESSION['email'] = $DatabaseCo->dbRow->email;
				$_SESSION['mem_status'] = $DatabaseCo->dbRow->status;
				$_SESSION['photo1'] = isset($DatabaseCo->dbRow->photo1)?$DatabaseCo->dbRow->photo1:'';
				$email = $_SESSION['email'];
				$browser = $_SERVER['HTTP_USER_AGENT'];
				$url = $_SERVER['HTTP_HOST'];
				$ip = $_SERVER['SERVER_ADDR'];
				$tm = mktime(date('h')+5,date('i')+30,date('s'));
				$login_dt = date('Y-m-d h:i:s',$tm);
				$date2 = date("d F ,Y", (strtotime($login_dt)));
				
				if($DatabaseCo->dbRow->mobile_verify_status=='No')
				{
					$_SESSION['last_login']='first_time';
				}
				
				$sql="UPDATE register set last_login='$login_dt' WHERE (fb_id='".$fbid."' OR email='".$femail."')";		
				
				$DatabaseCo->dbLink->query($sql);
				
							
				echo "<script>window.location='myhome'</script>";
                                
              }
              else
              {
                                ?>
                                <script>alert('YOUR ACCOUNT IS UNDER REVIEW. IT WILL BE ACTIVATED WITHIN 24HRS');</script>
                                <?php
								echo "<script>window.location='index';</script>";
              }
         }
          else
         {
            echo "<script>window.location='login?reply=no-data';</script>";
         }
		
   
 		 
} 
else
 {
	  //$loginUrl = $helper->getLoginUrl();
  
  $loginUrl = $helper->getLoginUrl(array(
   'scope' => 'email'
 ));
 
  header("Location: ".$loginUrl);
  
   
}

ob_flush();	
?>

