<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['submit'])){
	$header_name=$_POST['header_name'];
	$contact_link=$_POST['contact_link'];
	$about_link=$_POST['about_link'];
	$terms_link=$_POST['terms_link'];
	$privacy_link=$_POST['privacy_link'];
	$status=$_POST['status'];
	$qry="update vendor_site_settings set vendor_header_name='".$header_name."',contact_us_link='".$contact_link."',about_us_link='".$about_link."',terms_link='".$terms_link."',privacy_link='".$privacy_link."',status='".$status."' where setting_id='1'";
	$update=$DatabaseCo->dbLink->query($qry);
	echo'<script>window.location="vendor-site-settings.php";</script>';
}
$fetch_detail=$DatabaseCo->dbLink->query("select * from vendor_site_settings where setting_id='1'");
$DatabaseCo->dbRow = mysqli_fetch_object($fetch_detail); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage | Vendor Site Setting</title>
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
                    <h1 class="lightGrey">
                        Vendor Site Settings
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Vendor Site Settings</li>
                    </ol>
                </section>
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <div class="box-body">
                            <div class="box box-success">
                                <div class="box-body">
                                   	<form class="" action="" method="post">
                                    <div class="row">
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				Header Name
                                    			</label>
                                    			<input type="text" value="<?php echo $DatabaseCo->dbRow->vendor_header_name; ?>" name="header_name" class="form-control" >
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				Contact us link
                                    			</label>
                                    			<input type="text" value="<?php echo $DatabaseCo->dbRow->contact_us_link; ?>" name="contact_link" class="form-control" >
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				About us link
                                    			</label>
                                    			<input type="text" value="<?php echo $DatabaseCo->dbRow->about_us_link; ?>" name="about_link" class="form-control" >
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				 Terms link
                                    			</label>
                                    			<input type="text" value="<?php echo $DatabaseCo->dbRow->terms_link; ?>" name="terms_link" class="form-control" >
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				 Privacy link
                                    			</label>
                                    			<input type="text" value="<?php echo $DatabaseCo->dbRow->privacy_link; ?>" name="privacy_link" class="form-control" >
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group">
                                    			<label>
                                    				Status
                                    			</label>
                                    			<select class="form-control" name="status">
                                    				<option value="ACTIVE" <?php if($DatabaseCo->dbRow->status == 'ACTIVE'){ echo 'selected' ;} ?>>ACTIVE</option>
                                    				<option value="INACTIVE" <?php if($DatabaseCo->dbRow->status == 'INACTIVE'){ echo 'selected' ;} ?>>INACTIVE</option>
                                    			</select>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-12 text-center siteLogo">
                                    		<input type="submit" value="Submit" name="submit" class="btn btn-danger">
                                    	</div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </div>
            <?php include "page-part/footer.php"; ?>
        </div><!-- ./wrapper -->
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="../js/validetta.js" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!--jquery for left menu active class-->
        <script type="text/javascript" src="dist/js/general.js"></script>
        <script type="text/javascript" src="dist/js/cookieapi.js"></script>
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
               $("#submit-vendor-btn").click(function() {
                    $('#add_vendor').validetta({
                        errorClose: false,
                        realTime: true
                    });
                });
            });</script>
             <script type="text/javascript">
            setPageContext("Vendors", "vendor-site");
        </script>
    </body>
</html>