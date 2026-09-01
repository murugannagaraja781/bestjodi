<?php
 include_once '../databaseConn.php';
 include_once '../class/Config.class.php';
 $configObj = new Config();
 include_once './lib/requestHandler.php';
 $DatabaseCo = new DatabaseConn();
 include_once '../class/Config.class.php';
 $configObj = new Config();
 $DatabaseCoCount = new DatabaseConn();
$frenchise_id=$_SESSION['franchies_user_id'];
if(isset($_POST['submit'])){
	$account_name=$_POST['account_name'];
	$account_no=$_POST['account_no'];
	$account_type=$_POST['account_type'];
	$account_branch=$_POST['account_branch'];
	$upi=$_POST['upi'];
	$account_ifsc=$_POST['account_ifsc'];
	$bank_name=$_POST['bank_name'];
	
	$payment_approve = $DatabaseCo->dbLink->query("UPDATE franchies set acc_name='$account_name',acc_no='$account_no',acc_ifsc='$account_ifsc',acc_type='$account_type',acc_branch='$account_branch',acc_bank_name='$bank_name',acc_upi='$upi'  WHERE  id='$frenchise_id'");
	?>
	<script>window.location='editbankdetails.php';alert('Updated Successfully');</script>";
	<?php
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Frenchisee | Bank Details</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- IONICONS -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- IONICONS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
</head>
<body class="skin-blue">
	<!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
	<div class="wrapper" style="display:none" id="body">
    <!-- HEADER & LEFT MENU BAR -->
	<?php include "page-part/header.php"; ?> 
	<?php include "page-part/left_panel.php"; ?>
	<!-- HEADER & LEFT MENU BAR END-->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1 class="lightGrey">Bank Details</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Bank Details</li>
			</ol>
		</section>
		<section class="content">
			<div class="box">
			<div class="box-body">
			<div class="row">
				<?php 
					$frenchise_detail = $DatabaseCo->dbLink->query("SELECT * FROM franchies WHERE id='$frenchise_id'");
					$row=mysqli_fetch_object($frenchise_detail);
				?>
				<div class="col-lg-6 col-lg-offset-3">
					<form action="" method="post">
						<div class="gtFrapriceTitle">
						<h4>Add bank details</h4>
						</div>
						<div class="form-group">
							<label>
								Account Name
							</label>
							<input type="text" name="account_name" value="<?php if($row->acc_name != ''){ echo $row->acc_name;} ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>
								Account No
							</label>
							<input type="text" name="account_no" value="<?php if($row->acc_no != ''){ echo $row->acc_no; } ?>"  class="form-control">
						</div>
						<div class="form-group">
							<label>
								Account Type
							</label>
							<input type="text" name="account_type" value="<?php if($row->acc_type != ''){ echo $row->acc_type; } ?>"  class="form-control">
						</div>
						<div class="form-group">
							<label>
								IFSC
							</label>
							<input type="text" name="account_ifsc" value="<?php if($row->acc_ifsc != ''){ echo $row->acc_ifsc; } ?>"  class="form-control">
						</div>
						<div class="form-group">
							<label>
								Branch
							</label>
							<input type="text" name="account_branch" value="<?php if($row->acc_branch != ''){  echo $row->acc_branch;  } ?>"  class="form-control">
						</div>
						<div class="form-group">
							<label>
								Bank Name
							</label>
							<input type="text" name="bank_name" value="<?php if($row->acc_bank_name != ''){  echo $row->acc_bank_name; } ?>"  class="form-control">
						</div>
						<div class="form-group">
							<label>
								Upi id (if any)
							</label>
							<input type="text" name="upi" value="<?php if($row->acc_upi != ''){  echo $row->acc_upi; } ?>" class="form-control">
						</div>
						<div class="form-group text-center">
							<input type="submit" name="submit" value="SUBMIT" class="btn btn-green btn-lg">
						</div>
					</form>
				</div>
				<div class="col-lg-7">
					
				</div>
			</div>
			</div>
			</div>
		</section><!-- /.content -->
		<!-- /.content-wrapper -->
      </div>
		<?php include "page-part/footer.php"; ?>
	<!-- ./wrapper -->
 </div>
    
	<!-- jQuery 2.1.3 -->
	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
	<!-- jQuery UI 1.11.2 -->
	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>     
	
	
	<!-- Slimscroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- FastClick -->
	<script src='plugins/fastclick/fastclick.min.js'></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js" type="text/javascript"></script>
	<!--jquery for left menu active class-->
	<script type="text/javascript" src="dist/js/general.js"></script>
	<script type="text/javascript" src="dist/js/cookieapi.js"></script>
	<script type="text/javascript">
		setPageContext("payments","total_payment");
	</script>
    
</body>
</html>