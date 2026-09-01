<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();

$vendor_id = $_GET['id'];
$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$vendor_result = $DatabaseCo->dbLink->query("select * from vendors v left join vendor_city ct on v.city_id = ct.city_id where v.id = " . $vendor_id . "");
$row = mysqli_fetch_object($vendor_result);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />

        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  

        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->

        <!--OWL CAROUSEL CSS-->
        <link href="../css/owl.carousel.css" rel="stylesheet">
        <link href="../css/owl.theme.css" rel="stylesheet">
        <!--OWL CAROUSEL CSS END-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- ICON LOADER-->
        <div class="preloader-wrapper"><i class="gi gi-loader gi-spin"></i></div>
        <!-- ICON LOADER END-->

        <div id="body" style="display:none">
            <div id="wrap">
                <?php include ("parts/header.php"); ?>
                <div class="container gtMarginTop80">
                    <div class="row">
                        <div class="col-xxl-10">
                            <div class="gt-detail-card">
                                <img src="<?php echo ($row->image != "") ? "vendor-img/".$row->image : "img/1446026774_viv.jpg"; ?>" style="">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4><?php echo $row->name; ?><small><?php echo $row->city_name; ?></small></h4>
                                        <p><?php echo $row->address1 . $row->address2; ?>, <?php echo $row->city_name; ?>, <?php echo $row->pincode; ?></p>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="" class="btn btn-success gtMarginTop20"><i class="fa fa-phone gtMarginRight10"></i>Contact Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="gt-detail-card">
                                <div class="gt-detail-card-head">
                                    Gallery
                                </div>
                                <div class="gt-detail-card-body">

                                    <div class="col-xxl-4 col-xl-4 col-lg-8">
                                        <div class="row">
                                            <div class="thumbnail">
                                                <img src="<?php echo ($row->image_1 != "") ? "vendor-img/".$row->image_1 : "vendor-img/1442732616_cq5dam.web.468.263__2_.jpeg"; ?>" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-8">
                                        <div class="row">
                                            <div class="thumbnail">
                                                <img src="<?php echo ($row->image_2 != "") ? "vendor-img/".$row->image_2 : "vendor-img/1442732616_cq5dam.web.468.263__2_.jpeg"; ?>" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-8">
                                        <div class="row">
                                            <div class="thumbnail">
                                                <img src="<?php echo ($row->image_4 != "") ? "vendor-img/".$row->image_3 : "vendor-img/1442732616_cq5dam.web.468.263__2_.jpeg"; ?>" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-8">
                                        <div class="row">
                                            <div class="thumbnail">
                                                <img src="<?php echo ($row->image_4 != "") ? "vendor-img/".$row->image_4 : "vendor-img/1442732616_cq5dam.web.468.263__2_.jpeg"; ?>" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="gt-detail-card">
                                <div class="gt-detail-card-head">
                                    Description
                                </div>
                                <div class="gt-detail-card-body">
                                    <p class="gt-description">
                                        <?php echo $row->description; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div class="gt-small-detail-card">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h4>Starting Price</h4>
                                        <p><?php echo $row->stating_category; ?></p>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <h4>Rs.<?php echo $row->starting_price; ?></h4>
                                        <small>*Plus Taxes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="gt-small-detail-card">
                                <div class="gt-card-head">
                                    Venue Details
                                </div>
                                <?php
                                $vendor_speci = $DatabaseCo->dbLink->query("select * from vendor_specification where vendor_id = " . $vendor_id . " ");
                                ?>
                                <div class="gt-card-body">
                                    <?php if (mysqli_num_rows($vendor_speci) > 0) { ?>
                                        <?php while ($row = mysqli_fetch_object($vendor_speci)) { ?>
                                            <div class="gt-card-body-detail">
                                                <h5><?php echo $row->attribute_name; ?></h5>
                                                <p><?php echo $row->attribute_value; ?></p>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
            </div>
            <?php include ("parts/footer.php"); ?>
        </div>

        <!-- Jquery --->
        <script src="../js/jquery.min.js"></script>
        <!--- Jquery END --->
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="../js/bootstrap.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <script src="../js/green.js"></script> 
        <!--- BOOTSTRAP AND GREEN JS END--->
        <!--- OWL CAROUSEL --->
        <script src="../js/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!--- OWL CAROUSEL END--->


    </body>
</html>                                                                                                                             
