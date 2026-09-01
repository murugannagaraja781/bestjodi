<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$sms_id='';
if(isset($_REQUEST['edit_sms_id']))
{
$sms_id=$_REQUEST['edit_sms_id'];
//echo "select * from sms_api where  sms_id='$sms_id'"; die();
$data=$DatabaseCo->dbLink->query("select * from sms_api where  sms_id='$sms_id'");
$row=mysqli_fetch_array($data);
if(isset($_REQUEST['updatesms']))
{
$sms_id=$_REQUEST['edit_sms_id'];
$basic_url=$_REQUEST['basic_url'];
$status=$_REQUEST['status'];
$DatabaseCo->dbLink->query("update sms_api set basic_url='$basic_url',status='$status' where sms_id='$sms_id'");
header("location:sms_api?success=Yes"); 
}
else
{
$statusObj = new Status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";    
}
}
if(isset($_POST['addsms']))
{
$basic_url=$_POST['basic_url'];
$status=$_POST['status'];
//echo "insert into sms_api(sms_id,basic_url,status)values('','".$basic_url."','".$status."') "; break;
$sql="insert into sms_api(basic_url,status) values('$basic_url','$status')";
$DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:sms_api?success=Yes"); 
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | SMS API
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New SMS Api
            <small>Control panel
            </small>
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New SMS Api
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="box-top clearfix">
                <div class="col-md-3 col-sm-6">
                  <a href="#" class="btn btn-success btn-lg btn-flat col-xs-12" onclick="window.location='sms_api'">
                    <i class="fa fa-list hidden-xs">
                    </i>All SMS Api
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xs-12 neMrgATop10">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <i class="fa fa-plus fa-fw">
                    </i> New SMS Api
                  </h4>
                </div>
                <div class="row">
                  <form name="addsms_api" id="addsms_api" method="post">
                    <div class="box-body">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Basic Url:
                          </label>
                          <textarea class="form-control textarea" style="height:200px;" name="basic_url" id="basic_url" data-validetta="required">
                            <?php if(isset($_REQUEST['edit_sms_id'])) { echo $row['basic_url']; } ?>
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label>
                            Status:
                          </label>
                          <input type="radio"  value="APPROVED" name="status" id="status" 
                                 <?php if($sms_id!='' &&  $row['status']=="APPROVED") {?> checked="checked" 
                          <?php } ?>  data-validetta="required"/>
                          <span class="radio-btn-text">Active
                          </span>
                          <input type="radio"  value="UNAPPROVED" name="status" id="status" 
                                 <?php if($sms_id!='' &&  $row['status']=="UNAPPROVED") {?> checked="checked" 
                          <?php } ?> data-validetta="required" />
                          <span class="radio-btn-text">Inactive
                          </span>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="col-md-2 col-md-offset-4 col-sm-4 col-xs-6 form-group">
                          <?php
if(isset($_REQUEST['edit_sms_id']))
{
?>
                          <input type="submit"  class="btn btn-danger btn-flat" value="Update" name="updatesms" title="Update"/>
                          <input type="hidden" name="updatesms" class="btn btn-danger btn-flat" value="submit" />
                          <?php
}
else
{
?>
                          <input type="submit"  class="btn btn-danger btn-flat" value="Add" name="addsms" title="Add"/>
                          <input type="hidden" name="addsms" value="submit" />
                          <?php
}
?>
                        </div>
                        <input type="reset" class="btn btn-danger btn-flat" value="Cancel" title="Cancel"/>
                      </div>
                      </form> 
                    </div>
                  <!--<div class="col-md-2 col-sm-4 col-xs-6 form-group">
<a href="" class="btn btn-danger btn-flat btn-block ">
Cancel
</a>
</div>
-->
                </div>
              </div>
            </div>
          </div>
          </div>
      </div>
      <!-- /.row (main row) -->
      </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  <?php include "page-part/footer.php"; ?>
  </div>
<!-- ./wrapper -->
<!-- jQuery 2.1.3 -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<!-- jQuery UI 1.11.2 -->
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#addsms_api').validetta({
      errorClose : false,
      realTime : true
    }
                              );
  }
   );
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>    
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  // setPageContext("email-temp","add-new-email");
</script> 
<!--jquery for left menu active class end-->
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
</body>
</html>