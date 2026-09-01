<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$city_result = $DatabaseCo->dbLink->query("select * from vendor_city");


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage | Add Vendor</title>
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
                        Add Vendor
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add / Edit Vendor</li>
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
                                    <form action="vendor-form" method="post" id="add_vendor" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Category
                                                    </label>
                                                    <select data-validetta="required" name="category_id" id="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) { ?>

                                                            <option <?php echo (isset($category_id) && $category_id == $DatabaseCo->dbRow->id) ? 'selected' : ''; ?> value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Address 1
                                                    </label>
                                                    <input name="address1" data-validetta="required" type="text" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        City
                                                    </label>
                                                    <select data-validetta="required" class="form-control"  name="city_id" id="city" >
                                                        <option value="">Select City</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) { ?>
                                                            <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Name of Vendor
                                                    </label>
                                                    <input type="text" data-validetta="required" name="name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Address 2
                                                    </label>
                                                    <input type="text"  name="address2" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Pincode
                                                    </label>
                                                    <input type="text"  data-validetta="required" name="pincode" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <h1>Vendor Detail</h1>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Vendor Image
                                                    </label>
                                                    <input type="file" data-validetta="required" name="image" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Email Id
                                                    </label>
                                                    <input type="text" data-validetta="required,email" name="email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Contact No
                                                    </label>
                                                    <input type="text" data-validetta="required" name="mobile" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 1
                                                    </label>
                                                    <input type="file"  name="image_1" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 2
                                                    </label>
                                                    <input type="file"  name="image_2" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 3
                                                    </label>
                                                    <input type="file"  name="image_3" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 4
                                                    </label>
                                                    <input type="file"  name="image_4" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Vendor Starting Price
                                                    </label>
                                                    <input type="text"  data-validetta="required" name="starting_price" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Vendor Starting Price Category
                                                    </label>
                                                    <input type="text" class="form-control" data-validetta="required" name="starting_category" placeholder="for Example 'per plate'">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Contact No 2
                                                    </label>
                                                    <input type="text" data-validetta="required" name="office_no" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 5
                                                    </label>
                                                    <input type="file"   name="image_5" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 6
                                                    </label>
                                                    <input type="file"  name="image_6" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 7
                                                    </label>
                                                    <input type="file"  name="image_7" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 8
                                                    </label>
                                                    <input type="file"   name="image_8" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Description
                                                    </label>
                                                    <textarea name="descriptiion" data-validetta="required" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <h1>Vendor Specification (Right bucket detail)</h1>
                                            </div>
                                            <div class="col-xs-12" id="vendo-speci">
                                                <a id='addmore' class="btn btn-primary pull-right">Add More</a>
                                                <h4>Vendor Specification 1</h4>
                                                <div class="row" >
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Vendor Specification Title
                                                            </label>
                                                            <input name="attribute_name[1]" data-validetta="required" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Vendor Specification Description
                                                            </label>
                                                            <input type="text" name="attribute_value[1]" data-validetta="required" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 text-center">
                                                <button id="submit-vendor-btn" type="submit" name="submit_vendor" class="btn btn-success btn-lg">Submit</button>
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
                count = 1;
                $("#addmore").click(function() {
                    count = count + 1;
                    $.ajax({
                        type: "POST",
                        url: "vendor-form",
                        data: {'addmore': count},
                        cache: false,
                        success: function(html) {
                            $("#vendo-speci").append(html);
                        }
                    });

                });
                $("#submit-vendor-btn").click(function() {
                    $('#add_vendor').validetta({
                        errorClose: false,
                        realTime: true
                    });
                });
            });</script>
             <script type="text/javascript">
            setPageContext("Vendors", "Addvendor");
        </script>
    </body>
</html>