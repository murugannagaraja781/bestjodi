<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
if (!isset($_GET['id'])) {
    header('location:all-vendor.php');
}
$city_result = $DatabaseCo->dbLink->query("select * from vendor_city");
$vendor_id = $_GET['id'];
$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$vendor_result = $DatabaseCo->dbLink->query("select * from vendors v left join vendor_city ct on v.city_id = ct.city_id where v.id = " . $vendor_id . "");
while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_result)) {
    $category_id = $DatabaseCo->dbRow->category_id;
    $vendor_name = $DatabaseCo->dbRow->name;
    $city_id = $DatabaseCo->dbRow->city_id;
    $address1 = $DatabaseCo->dbRow->address1;
    $address2 = $DatabaseCo->dbRow->address2;
    $pincode = $DatabaseCo->dbRow->pincode;
    $description = $DatabaseCo->dbRow->description;
    $mobile_no = $DatabaseCo->dbRow->mobile_no;
    $office_no = $DatabaseCo->dbRow->office_no;
    $email = $DatabaseCo->dbRow->email;
    $starting_price = $DatabaseCo->dbRow->starting_price;
    $starting_category = $DatabaseCo->dbRow->stating_category;
    $image = $DatabaseCo->dbRow->image;
    $image_1 = $DatabaseCo->dbRow->image_1;
    $image_2 = $DatabaseCo->dbRow->image_2;
    $image_3 = $DatabaseCo->dbRow->image_3;
    $image_4 = $DatabaseCo->dbRow->image_4;
    $image_5 = $DatabaseCo->dbRow->image_5;
    $image_6 = $DatabaseCo->dbRow->image_6;
    $image_7 = $DatabaseCo->dbRow->image_7;
    $image_8 = $DatabaseCo->dbRow->image_8;
}
$vendor_speci = $DatabaseCo->dbLink->query("select * from vendor_specification where vendor_id = " . $vendor_id . " ");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage | Email</title>
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
                        Edit Vendor
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
                                    <form action="vendor-form" method="post" id="update_vendor" enctype="multipart/form-data">
                                        <input type="hidden" name='id' value="<?php echo $vendor_id; ?>" >
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Category
                                                    </label>
                                                    <select data-validetta="required" name="category_id" id="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) { ?>

                                                            <option <?php echo ($category_id == $DatabaseCo->dbRow->id) ? 'selected' : ''; ?> value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Address 1
                                                    </label>
                                                    <input value="<?php echo $address1; ?>"  data-validetta="required" type="text" name="address1" id="address"  class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        City
                                                    </label>
                                                    <select data-validetta="required" class="form-control"  name="city_id" id="city" >
                                                        <option value="">Select City</option>
                                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) { ?>
                                                            <option <?php echo ($city_id == $DatabaseCo->dbRow->city_id) ? 'selected' : ''; ?> value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Name of Vendor
                                                    </label>
                                                    <input value="<?php echo $vendor_name; ?>"  data-validetta="required" name="name" id="name" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Address 2
                                                    </label>
                                                    <input value="<?php echo $address2; ?>"  type="text" name="address2" id="address2" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Pincode
                                                    </label>
                                                    <input value="<?php echo $pincode; ?>" data-validetta="required" name="pincode" id="pincode" type="text" class="form-control">
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
                                                    <?php if ($image != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image" id="image"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image" id="image"  data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Email Id
                                                    </label>
                                                    <input value="<?php echo $email; ?>"  name="email" id="email"  data-validetta="required,email" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Contact No
                                                    </label>
                                                    <input value="<?php echo $mobile_no; ?>" name="mobile" id="mobile"  data-validetta="required" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 1
                                                    </label>
                                                    <?php if ($image_1 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_1; ?> "  width="100"  height="100" class="img-responsive" >
                                                            <input name="image_1" id="image_1"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_1" id="image_1" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 2
                                                    </label>
                                                    <?php if ($image_2 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_2; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image_2" id="image_2" type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_2" id="image_2" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 3
                                                    </label>
                                                    <?php if ($image_3 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_3; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image_3" id="image_3"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_3" id="image_3" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 4
                                                    </label>
                                                    <?php if ($image_4 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_4; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image_4" id="image_4"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_4" id="image_4" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Vendor Starting Price
                                                    </label>
                                                    <input value="<?php echo $starting_price; ?>" data-validetta="required" name="starting_price" id="starting_price" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Vendor Starting Price Category
                                                    </label>
                                                    <input value="<?php echo $starting_category; ?>" data-validetta="required" name="starting_category" id="starting_category" type="text" class="form-control" placeholder="for Example 'per plate'">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Office Contact No
                                                    </label>
                                                    <input value="<?php echo $office_no; ?>" data-validetta="required" name="office_no" id="office_no"  data-validetta="required" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 5
                                                    </label>
                                                    <?php if ($image_5 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_5; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image_5" id="image_5"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_5" id="image_5" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 6
                                                    </label>
                                                    <?php if ($image_6 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_6; ?> " width="100"  height="100" class="img-responsive" >
                                                            <input name="image_6" id="image_6"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_6"id="image_6" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 7
                                                    </label>
                                                    <?php if ($image_7 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_7; ?> " width="100"  height="100" class="img-responsive" >
                                                            <input name="image_7" id="image_7"  type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_7" id="image_7" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Gallery Image 8
                                                    </label>
                                                    <?php if ($image_8 != "") { ?>
                                                        <div>
                                                            <img src="../vendors/vendor-img/<?php echo $image_8; ?> " width="100"  height="100" class="img-responsive">
                                                            <input name="image_8" id="image_8" type="file" class="form-control">
                                                        </div>
                                                    <?php } else { ?>
                                                        <input name="image_8" id="image_8" data-validetta="required" type="file" class="form-control">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Description
                                                    </label>
                                                    <textarea name="descriptiion" data-validetta="required" class="form-control" rows="5"><?php echo $description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <h1>Vendor Specification (Right bucket detail)</h1>
                                            </div>
                                            <div  id="vendo-speci" class="col-xs-12">
                                                <a id='addmore' class="btn btn-primary pull-right">Add More</a>
                                                <?php $i = 1; ?>
                                                <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_speci)) { ?>
                                                    <h4>Vendor Specification <?php echo $i++; ?></h4>
                                                    <div class="row" >
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Vendor Specification Title
                                                                </label>
                                                                <input name="attribute_name[<?php echo $DatabaseCo->dbRow->attribute_id; ?>]" data-validetta="required" value="<?php echo $DatabaseCo->dbRow->attribute_name; ?>" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Vendor Specification Description
                                                                </label>
                                                                <input type="text" value="<?php echo $DatabaseCo->dbRow->attribute_value; ?>" name="attribute_value[<?php echo $DatabaseCo->dbRow->attribute_id; ?>]" data-validetta="required" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="col-xs-12 text-center">
                                                <button id="submit-vendor-btn" type="submit" name='submit_vendor' class="btn btn-success btn-lg">Submit</button>
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
                count = <?php echo $i - 1; ?>;
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
                    $('#update_vendor').validetta({
                        errorClose: false,
                        realTime: true
                    });
                });
            });
        </script>
    </body>
</html>