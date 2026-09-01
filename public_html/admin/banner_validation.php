<?php 
error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$ACTION = isset($_REQUEST['action']) ? $_REQUEST['action'] :"" ;
$sample='';
$banner1_new='';
$banner2_new='';
$banner3_new='';
$errorFlag = false;
$erroMessage = "";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{	
$maxsize    = 2097152;
$acceptable = array(
'image/jpeg',
'image/jpg',
'image/gif',
'image/png');
if(isset($_REQUEST['updatebanner']))
{	
if(@is_uploaded_file($_FILES["banner1"]["tmp_name"]))
{
if(!in_array($_FILES['banner1']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid <b>Banner 1</b> file type. Only JPEG, JPG, GIF and PNG types are accepted.</li>";
$errorFlag = true;
}
else if($_FILES['banner1']['size']>=$maxsize || $_FILES['banner1']['size'] == 0)
{
$erroMessage .= "<li><b>Banner 1</b> image size is to large .</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$banner1=$_FILES['banner1']['name'];
$banner1_new = str_replace(" ","-",$banner1);
unlink("../banner/".$_REQUEST['old_banner1']);
$upload_banner1=copy($_FILES["banner1"]["tmp_name"], "../banner/" .$banner1_new);
}
}
else
{
$banner1_new=$_REQUEST['old_banner1'];
}
if(@is_uploaded_file($_FILES["banner2"]["tmp_name"]))
{
if(!in_array($_FILES['banner2']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid <b>Banner 2</b> file type. Only JPEG, JPG, GIF and PNG types are accepted.</li>";
$errorFlag = true;
}
else if($_FILES['banner2']['size']>=$maxsize || $_FILES['banner2']['size'] == 0)
{
$erroMessage .= "<li><b>Banner 2</b> image size is to large .</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$banner2=$_FILES['banner2']['name'];
$banner2_new = str_replace(" ","-",$banner2);
unlink("../banner/".$_REQUEST['old_banner2']);
$upload_banner2=copy($_FILES["banner2"]["tmp_name"], "../banner/" .$banner2_new);
}
}
else
{
$banner2_new=$_REQUEST['old_banner2'];
}	
if(@is_uploaded_file($_FILES["banner3"]["tmp_name"]))
{
if(!in_array($_FILES['banner3']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid <b>Banner 3</b> file type. Only JPEG, JPG, GIF and PNG types are accepted.</li>";
$errorFlag = true;
}
if($_FILES['banner3']['size']>=$maxsize || $_FILES['banner3']['size'] == 0)
{
$erroMessage .= "<li><b>Banner 3</b> image size is to large .</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$banner3=$_FILES['banner3']['name'];
$banner3_new = str_replace(" ","-",$banner3);
unlink("../banner/".$_REQUEST['old_banner3']);
$upload_banner3=copy($_FILES["banner3"]["tmp_name"], "../banner/" .$banner3_new);
}
}
else
{
$banner3_new=$_REQUEST['old_banner3'];
}
}
if(!$errorFlag)
{
$STATUS_MESSAGE="";            
$SQL_STATEMENT = "";
$ERROR_FLAG = false;  
if(isset($_REQUEST['updatebanner']))
{
switch($ACTION)
{
case 'UPDATE':
$SQL_STATEMENT="update site_config set banner1='$banner1_new',banner2='$banner2_new',banner3='$banner3_new' where id='1' ";
break;
}
$statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
$response = array();
$response['successStatus'] = $statusObj->getActionSuccess();
$response['responseMessage'] = $STATUS_MESSAGE;
header('Content-type: application/json');
echo json_encode($response);
}
}
else
{
$response = array();
$response['successStatus'] = false;
$response['responseMessage'] = $erroMessage;
header('Content-type: application/json');
echo json_encode($response);	   		
}
}
?>
