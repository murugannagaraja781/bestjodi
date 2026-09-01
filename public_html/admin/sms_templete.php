<?php  
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$temp_id=isset($_GET['id']) ? $_GET['id'] :"" ; 
if($temp_id!='')
{
$result= mysqli_query($DatabaseCo->dbLink,"select * from sms_templete where temp_id='$temp_id'");
$row=mysqli_fetch_array($result);
}
if(isset($_REQUEST['add_sms']))
{ 
$temp_name=htmlspecialchars($_POST['temp_name'],ENT_QUOTES);
$temp_value=htmlspecialchars($_POST['temp_value'],ENT_QUOTES);
$status=htmlspecialchars($_POST['status'],ENT_QUOTES);
mysqli_query($DatabaseCo->dbLink,"insert into sms_templete (temp_name,temp_value,status) values ('$temp_name','$temp_value','$status')") or die(mysqli_error($DatabaseCo->dbLink));
header("location:smstemplist?success=Yes");
}
if(isset($_REQUEST['update_sms']))
{ 
$temp_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['id']);
$temp_name=htmlspecialchars($_POST['temp_name'],ENT_QUOTES);
$temp_value=htmlspecialchars($_POST['temp_value'],ENT_QUOTES);
$status=htmlspecialchars($_POST['status'],ENT_QUOTES);
mysqli_query($DatabaseCo->dbLink,"update sms_templete set  temp_name='$temp_name',temp_value='$temp_value',status='$status' where temp_id='$temp_id'") or die(mysqli_error($DatabaseCo->dbLink));
header("location:smstemplist?success=Yes");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard
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
            Add New SMS Template
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New SMS Template
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
                  <a href="smstemplist" class="btn btn-success btn-lg btn-flat col-xs-12" onclick="window.location='smstemplist'">
                    <i class="fa fa-list hidden-xs">
                    </i>All SMS Templates
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xs-12 neMrgATop10">
              <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <center>
                </center>
                <?php
if(!empty($STATUS_MESSAGE))
{ 
if($save)
{
echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
echo "<div class='error-msg' id='validationSummary'></div>";              
}
else
{
echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";  
}
}
else
{
echo "<div class='error-msg' id='validationSummary'></div>";            
}
?>  
                <div class="row">
                  <div class="box-body">
                    <form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_form">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Template  Name:
                          </label>
                          <input type="text" class="form-control" name="temp_name" value="<?php if($temp_id!=''){echo  $row['temp_name'];}?>" id="temp_name" title="name" data-validetta="required"/>
                        </div>
                      </div>
                      </br>
                    </br>
                  </br>
                </br>
              </br>
            <div class="col-xs-12 col-md-12">
              <div class="form-group">
                <label>
                  Template Content:
                </label>
                <textarea class="form-control textarea" style="height:200px;" name="temp_value"  id="temp_value" data-validetta="required">
                  <?php if($temp_id!=''){echo  htmlspecialchars_decode($row['temp_value']);}?>
                </textarea>
              </div>
              <div class="form-group">
                <label>
                  Status:
                </label>
                <input type="radio"  value="APPROVED" name="status" id="status" 
                       <?php if($temp_id!='' &&  $row['status']=="APPROVED") {?> checked="checked" 
                <?php } ?>  data-validetta="required"/>
                <span class="radio-btn-text">Active
                </span>
                <input type="radio"  value="UNAPPROVED" name="status" id="status" 
                       <?php if($temp_id!='' &&  $row['status']=="UNAPPROVED") {?> checked="checked" 
                <?php } ?> data-validetta="required" />
                <span class="radio-btn-text">Inactive
                </span>
              </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="col-xs-12">
              <div class="col-md-2 col-md-offset-4 col-sm-4 col-xs-6 form-group">
                <?php
if(!empty($temp_id))
{
?>
                <input type="submit"  class="btn btn-danger btn-flat" value="Update" name="update_sms" title="Update"/>
                <input type="hidden" name="update_sms" class="btn btn-danger btn-flat" value="submit" />
                <?php
}
else
{
?>
                <input type="submit"  class="btn btn-danger btn-flat" value="Add" name="add_sms" title="Add"/>
                <input type="hidden" name="add_sms" value="submit" />
                <?php
}
?>
              </div>
              <input type="reset" class="btn btn-danger btn-flat" value="Cancel" title="Cancel"/>
            </div>
            </form> 
          </div>
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
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#add_form').validetta({
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
<script src="dist/js/app.min.js" type="text/javascript">
</script>
</body>
</html>