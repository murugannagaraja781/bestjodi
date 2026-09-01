<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
if(isset($_REQUEST['paypal']))
{
$pay_name="Paypal";
$email_id=htmlspecialchars($_REQUEST['email_id'],ENT_QUOTES);
$status=$_REQUEST['status'];
$DatabaseCo->dbLink->query("update payment_method set `pay_name`='$pay_name',`pay_email`='$email_id',`status`='$status' where pay_id='1'"); 
echo '<script>alert("Record updated Successfully");</script>';
}
if(isset($_REQUEST['checkout']))
{
$pay_name="2checkout";
$app_id=$_REQUEST['app_id'];
$app_status=$_REQUEST['app_status'];
$description=htmlspecialchars($_REQUEST['description'],ENT_QUOTES);
$DatabaseCo->dbLink->query("update payment_method set `pay_name`='$pay_name',`merchant_id`='$app_id',`check_desc`='$description',`status`='$app_status' where `pay_id`='3'");
echo '<script>alert("Record updated Successfully");</script>';
}
if(isset($_REQUEST['ccavenue'])){
	$pay_name="CCAvenue";
	$pay_email=$_REQUEST['pay_email'];
	$c_app_status=$_REQUEST['c_app_status'];
	$merchant_id=$_REQUEST['merchant_id'];
	$merchant_key=$_REQUEST['merchant_key'];
	$cc_access_code=$_REQUEST['cc_access_code'];
	$DatabaseCo->dbLink->query("update payment_method set pay_name='$pay_name',pay_email='$pay_email',status='$c_app_status',merchant_id='$merchant_id',merchant_key='$merchant_key',cc_access_code='$cc_access_code' where pay_id='2'");
	echo '<script>alert("Record updated Successfully");</script>';
}
if(isset($_REQUEST['payumoney']))
{
$pay_name="payumoney";
$merchant_key=$_REQUEST['merchant_key'];
$app_status=$_REQUEST['app_status'];
$merchant_id=$_REQUEST['merchant_id'];
$salt_key=$_REQUEST['salt_key'];
$DatabaseCo->dbLink->query("update payment_method set `pay_name`='$pay_name',`merchant_key`='$merchant_key',`merchant_id`='$merchant_id',`salt_key`='$salt_key',`status`='$app_status' where `pay_id`='5'");
echo '<script>alert("Record updated Successfully");</script>';
}
if(isset($_REQUEST['bank_detail_submit']))
{
$pay_name="Bank Detail";
$bank_detail=htmlspecialchars($_REQUEST['bank_detail'],ENT_QUOTES);
$bank_account_no=htmlspecialchars($_REQUEST['bank_account_no'],ENT_QUOTES);
$bank_account_name=htmlspecialchars($_REQUEST['bank_account_name'],ENT_QUOTES);
$bank_account_type=htmlspecialchars($_REQUEST['bank_account_type'],ENT_QUOTES);
$bank_ifsc=htmlspecialchars($_REQUEST['bank_ifsc'],ENT_QUOTES);
$bank_status=$_REQUEST['bank_status'];
$DatabaseCo->dbLink->query("update payment_method set `pay_name`='$pay_name',`bank_detail`='$bank_detail',`bank_account_no`='$bank_account_no',`bank_account_name`='$bank_account_name',`bank_account_type`='$bank_account_type',`bank_ifsc`='$bank_ifsc',`status`='$bank_status' where pay_id='4'");
echo '<script>alert("Record updated Successfully");</script>';
}
$sql1=$DatabaseCo->dbLink->query("select `pay_name`,`pay_email`,`status` from payment_method where pay_id='1'");
$row1=mysqli_fetch_array($sql1);
$sql2=$DatabaseCo->dbLink->query("select `pay_name`,`ccavenue_id`,`status`,`pay_email`,`merchant_key`,`merchant_id`,`cc_access_code` from payment_method where pay_id='2'");
$row2=mysqli_fetch_array($sql2);
$sql3=$DatabaseCo->dbLink->query("select `pay_name`,`merchant_id`,`check_desc`,`status` from payment_method where pay_id='3'");
$row3=mysqli_fetch_array($sql3);
$sql4=$DatabaseCo->dbLink->query("select `pay_name`,`bank_detail`,`bank_account_no`,`bank_account_type`,`bank_account_name`,`bank_ifsc`,`status` from payment_method where pay_id='4'");
$row4=mysqli_fetch_array($sql4);
$sql5=$DatabaseCo->dbLink->query("select `pay_name`,`merchant_key`,`salt_key`,`merchant_id`,`status` from payment_method where pay_id='5'");
$row5=mysqli_fetch_array($sql5);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Payment Option
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
  </head>
  <body class="skin-blue">
   <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
  <div class="wrapper" style="display:none" id="body">

      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="lightGrey">
            Payment Option
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active">Payment Option
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h4>
                    Paypal Setting
                  </h4>
                </div>
                <div class="box-body">
                	<div class="row gtNewMemPlan">
                 		 <form name="add_paypal" id="add_paypal" method="post">
                    <center>
                      <img src="dist/img/credit/paypal.png">
                    </center>
                    <div class="col-md-6 col-xs-12 mt-10">
                      <div class="form-group">
                        <label>
                          Paypal Accont Email Id
                        </label>
                        <input type="text" class="form-control" name="email_id" data-validetta="required" value="<?php echo htmlspecialchars_decode($row1['pay_email']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6 col-xs-12 mt-10">
                      <div class="form-group">
                        <label>
                          Status
                        </label>
                        <select class="form-control" name="status" data-validetta="required">
                          <option value="APPROVED" 
                                  <?php if($row1['status']=='APPROVED'){echo "selected";}?>>
                          Active
                          </option>
                        <option  value="UNAPPROVED" 
                                <?php if($row1['status']=='UNAPPROVED'){echo "selected";}?>>
                        Inactive
                        </option>
                      </select>
                    </div>
                </div>
                <div class="form-group text-center">
                  <input type="submit" name="paypal" class="btn btn-green" value="Submit">
                  <input type="reset" class="btn btn-danger" value="cancel">
                </div>
                </form>
                	</div>
            	</div>
          	 </div>
          </div>
        	<!--<div class="col-lg-12 col-xs-12 mt-10">
          <div class="box box-success gtNewMemPlan">
            <form name="add_checkout" id="add_checkout" method="post">
              <div class="box-header with-border">
                <h4>
                  2Checkout
                </h4>
              </div>
              <div class="box-body clearfix">
                <center>
                  <img src="dist/img/credit/2-checkout.png">
                </center>
                <div class="col-md-6 col-xs-12 mt-10">
                  <div class="form-group">
                    <label>
                      2Checkout Application ID:
                    </label>
                    <input type="text" class="form-control" name="app_id" data-validetta="required" value="<?php echo $row3['merchant_id'];?>">
                  </div>
                  <div class="form-group">
                    <label>
                      Status
                    </label>
                    <select class="form-control" name="app_status" data-validetta="required">
                      <option value="APPROVED" 
                              <?php if($row3['status']=='APPROVED'){echo "selected";}?>>
                      Active
                      </option>
                    <option value="UNAPPROVED" 
                            <?php if($row3['status']=='UNAPPROVED'){echo "selected";}?>>
                    Inactive
                    </option>
                  </select>
              </div>
              </div>
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  2Checkout Description:
                </label>
                <textarea class="form-control" rows="5" name="description" data-validetta="required"> 
                  <?php echo htmlspecialchars($row3['check_desc']); ?>
                </textarea>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="checkout" class="btn btn-green" value="Submit">
              <input type="reset" class="btn btn-danger" value="cancel">
            </div>
          </div>
          </form>
      </div>
    </div>-->
   		    <div class="col-lg-12 col-xs-12 mt-10">
          <div class="box box-success gtNewMemPlan">
            <form name="add_payumoney" id="add_payumoney" method="post">
              <div class="box-header with-border">
                <h4>
                  Payumoney
                </h4>
              </div>
              <div class="box-body clearfix">
                <center>
                  <img src="dist/img/credit/payumoney-coupon.png" style="max-height: 50px;">
                </center>
                <div class="col-md-6 col-xs-12 mt-10">
                  <div class="form-group">
                    <label>
                      Merchant Key:
                    </label>
                    <input type="text" class="form-control" name="merchant_key" data-validetta="required" value="<?php echo $row5['merchant_key'];?>">
                  </div>
                  <div class="form-group">
                    <label>
                      Status
                    </label>
                    <select class="form-control" name="app_status" data-validetta="required">
                      <option value="APPROVED" 
                              <?php if($row5['status']=='APPROVED'){echo "selected";}?>>
                      Active
                      </option>
                    <option value="UNAPPROVED" 
                            <?php if($row5['status']=='UNAPPROVED'){echo "selected";}?>>
                    Inactive
                    </option>
                  </select>
              </div>
              </div>
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                    <label>
                      Merchant Id:
                    </label>
                    <input type="text" class="form-control" name="merchant_id" data-validetta="required" value="<?php echo $row5['merchant_id'];?>">
                  </div>
                  <div class="form-group">
                    <label>
                      Salt Key:
                    </label>
                    <input type="text" class="form-control" name="salt_key" data-validetta="required" value="<?php echo $row5['salt_key'];?>">
                  </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="payumoney" class="btn btn-green" value="Submit">
              <input type="reset" class="btn btn-danger" value="cancel">
            </div>
          </div>
          </form>
      </div>
    </div>
    		<div class="col-lg-12 col-xs-12 mt-10">
      <div class="box box-success">
        <form name="add_ccavenue" id="add_ccavenue" method="post">
          <div class="box-header with-border">
            <h4>
              CCAvenue Setting
            </h4>
          </div>
          <div class="box-body gtNewMemPlan">
          	<div class="row">
            <center>
              <img src="dist/img/credit/ccavenue.png">
            </center>
            
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  Pay Email
                </label>
                <input type="text" class="form-control" name="pay_email" data-validetta="required" value="<?php echo $row2['pay_email']; ?>">
              </div>
            </div>
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  CCAvenue Merchant Id
                </label>
                <input type="text" class="form-control" name="merchant_id" data-validetta="required" value="<?php echo $row2['merchant_id']; ?>">
              </div>
            </div>
             <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  CCAvenue Merchant Key
                </label>
                <input type="text" class="form-control" name="merchant_key" data-validetta="required" value="<?php echo $row2['merchant_key']; ?>">
              </div>
            </div>
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  CCAvenue Access Code
                </label>
                <input type="text" class="form-control" name="cc_access_code" data-validetta="required" value="<?php echo $row2['cc_access_code']; ?>">
              </div>
            </div>
            <div class="col-md-6 col-xs-12 mt-10">
              <div class="form-group">
                <label>
                  Status
                </label>
                <select class="form-control" name="c_app_status" data-validetta="required">
                  <option value="APPROVED" 
                          <?php if($row2['status']=='APPROVED'){echo "selected";}?>>
                  Active
                  </option>
                <option value="UNAPPROVED" 
                        <?php if($row2['status']=='UNAPPROVED'){echo "selected";}?>>
                Inactive
                </option>
              </select>
          	</div>
          </div>
          	<div class="col-xs-12">
        		<div class="form-group text-center">
          			<input type="submit" name="ccavenue" class="btn btn-green" value="Submit">
          			<input type="reset" class="btn btn-danger" value="cancel">
       		 	</div>
       		</div>
        	</div>
      	  </div>
      </form>
    </div>
  </div>		
  <div class="col-lg-12 col-xs-12 mt-10">
    <div class="box box-success">
      <form name="add_bank_detail" id="add_bank_detail" method="post">
        <div class="box-header with-border">
          <h4>
            Bank Details
          </h4>
        </div>
        <div class="box-body">
           <div class="row">
          <div class="col-md-6 col-xs-12 mt-10">
            <div class="form-group">
              <label>
                Enter Bank Name
              </label>
              <input type="text" class="form-control" name="bank_detail" data-validetta="required" value="<?php echo $row4['bank_detail']; ?>">
            </div>
            <div class="form-group">
              <label>
                Enter Account Type
              </label>
              <input type="text" class="form-control" name="bank_account_type" data-validetta="required" value="<?php echo $row4['bank_account_type']; ?>">
            </div>
            <div class="form-group">
              <label>
                Enter Account No
              </label>
              <input type="text" class="form-control" name="bank_account_no" data-validetta="required" value="<?php echo $row4['bank_account_no']; ?>">
            </div>
            
          </div>
          <div class="col-md-6 col-xs-12 mt-10">
          <div class="form-group">
              <label>
                Enter Bank IFSC Code
              </label>
              <input type="text" class="form-control" name="bank_ifsc" data-validetta="required" value="<?php echo $row4['bank_ifsc']; ?>">
            </div>
           <div class="form-group">
              <label>
                Enter Account Name
              </label>
              <input type="text" class="form-control" name="bank_account_name" data-validetta="required" value="<?php echo $row4['bank_account_no']; ?>">
            </div>
            <div class="form-group">
              <label>
                Status
              </label>
              <select class="form-control" name="bank_status" data-validetta="required">
                <option value="APPROVED" 
                        <?php if($row4['status']=='APPROVED'){echo "selected";}?>>
                Active
                </option>
              <option value="UNAPPROVED" 
                      <?php if($row4['status']=='UNAPPROVED'){echo "selected";}?>>
              Inactive
              </option>
            </select>
        </div>
        </div>
         <div class="clearfix"></div>
      	  <div class="form-group text-center">
        <input type="submit" name="bank_detail_submit" class="btn btn-green" value="Submit">
        <input type="reset" class="btn btn-danger" value="cancel">
      </div>
      	</div>
    	</div>
    </form>
</div>
</div>

		  <!-- right col -->
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
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
</script>
<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#add_paypal').validetta({
      errorClose : false,
      realTime : true
    }
                              );
    $('#add_checkout').validetta({
      errorClose : false,
      realTime : true
    }
                                );
    $('#add_ccavenue').validetta({
      errorClose : false,
      realTime : true
    }
                                );
    $('#add_bank_detail').validetta({
      errorClose : false,
      realTime : true
    }
                                   );
  }
   );
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>    
<!-- Morris.js charts -->
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  setPageContext("payment","pay-add");
</script>	
<!--jquery for left menu active class end--> 
<script src="dist/js/app.min.js" type="text/javascript">
</script>
</body>
</html> 