<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$city_result = $DatabaseCo->dbLink->query("select * from vendor_city");

$sql = "select * from vendors v left join vendor_city ct on v.city_id = ct.city_id";
if (isset($_POST['search'])) {
    $category_id = (isset($_POST['category_id']) && $_POST['category_id'] != "") ? $_POST['category_id'] : "";
    $city_id = (isset($_POST['city_id']) && $_POST['city_id'] != "") ? $_POST['city_id'] : "";
    if ($category_id != "") {
        $sql.=" where v.category_id = " . $category_id . "";
    }
    if ($city_id != "") {
        $sql.=" and v.city_id = " . $city_id . "";
    }
}
$vendors_list = $DatabaseCo->dbLink->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage | All Vendors</title>
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
                    <h1>
                        All Vendor
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">All Vendor</li>
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
                                    <?php if (isset($_SESSION['vendor'])) { ?>
                                        <div class="alert alert-<?php echo $_SESSION['vendor']['status']; ?>">
                                            <?php echo $_SESSION['vendor']['msg']; ?>
                                        </div>
                                        <?php unset($_SESSION['vendor']); ?>
                                    <?php } ?>
                                    <form action="" method="post" id="vendor_search" >
                                        <div class="col-xs-12">
                                            <div class="col-md-3 col-md-offset-2">
                                                <div class="form-group">
                                                    <select required name="category_id" id="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) { ?>

                                                            <option <?php echo (isset($category_id) && $category_id == $DatabaseCo->dbRow->id) ? 'selected' : ''; ?> value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select  class="chosen-select form-control gt-height-auto" tabindex="5" name="city_id" id="city_id" >
                                                        <option value="">Select City</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) { ?>
                                                            <option <?php echo (isset($city_id) && $city_id == $DatabaseCo->dbRow->city_id) ? 'selected' : ''; ?> value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button type="submit" name="search" id="search" class="btn btn-danger ">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div class="row mt-10">
                                        <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                <div class="col-md-4">
                                                   	<div class="gtCard">
                                                    <a href="edit-vendor?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="">
    													<img src="../vendors/vendor-img/<?php echo $DatabaseCo->dbRow->image;?> " class="img-responsive">
													</a>
                                                    <div class="col-xs-12">
                                                      <h4><?php echo $DatabaseCo->dbRow->name; ?></h4>
                                                      <h5 class=""><i class="fa fa-map-marker lightGrey mr-10" ></i><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                    </div>
                                                    <div >
                                                    	<div class="col-md-6 col-xs-12">
                                                    		<a href="vendor-form.php?action=delete&id=<?php echo $DatabaseCo->dbRow->id; ?>" class="btn btn-danger btn-block">Delete</a>
                                                    	</div>
                                                    	<div class="col-md-6 col-xs-12">
                                                    		<a href="edit-vendor?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="btn btn-success btn-block">Edit</a>
                                                    	</div>
                                                    </div>
													</div>
                                                </div>

                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="col-xs-12 mt-10">
  
   <div class="nodata-avail">
     
      <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
   
   </div>
</div>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
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
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!--jquery for left menu active class-->
        <script type="text/javascript" src="dist/js/general.js"></script>
        <script type="text/javascript" src="dist/js/cookieapi.js"></script>
        <script type="text/javascript">
            setPageContext("Vendors", "allVendor");
        </script>	
        <script src="dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>