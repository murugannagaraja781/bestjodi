<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();

$response = array( 'valid' => false, 'message' => 'Sorry, Something went wrong!');
if( isset($_REQUEST['email']) ) {

$get_data = $DatabaseCo->dbLink->query("select * from franchies where email='" . $_REQUEST['email'] . "'");

  if (mysqli_num_rows($get_data)>0) {
    $response = array( 'valid' => false, 'message' => 'This email is already taken!' );
  } else {
    $response = array( 'valid' => true );
  }

}

echo json_encode($response);

?>