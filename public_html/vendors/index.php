<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$city_result = $DatabaseCo->dbLink->query("select * from vendor_city order by city_name asc");
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
        <link type="image/x-icon" href="../img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE TITLE DESCRIPTION END--> 


        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!-------------------Validation css ------------------>
        <link rel="stylesheet" href="css/validate.css">
        <!-------------------Validation css------------------>

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
        <link rel="stylesheet" href="../css/chosen.css">
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
                <div class="gtBgBannerTop">
                    <div class="container gtBgBannerTopContent">
                        <h4 class="text-center">
                            Your Wedding, Your Way
                        </h4>
                        <p class="text-center">
                            Find the best wedding vendors with thousands of trusted reviews
                        </p>
                        <form id="vendor_search_form" method="post" action="vendor-list" class="col-xl-12 col-xl-offset-2 col-lg-16">
                            <div class="col-xl-6 col-lg-6">
                                <select name="category_id" id="category" class="form-control" data-validetta="required" >
                                    <option value="">Select Category</option>
                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) { ?>
                                        <option value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <select data-placeholder="Choose a City..." class="chosen-select gt-form-control gt-height-auto" tabindex="5" name="city_id" id="city">
                                     <option value="">Select City</option>
                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) { ?>
                                        <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <button id="search-btn" type="submit" name="submit" class="btn btn-orange btn-block">Get Started</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container gtCatContainer">
                    <h3 class="text-center">
                        Find The Perfect Look
                    </h3>
                    <p class="text-center">
                        Get lost in thousands of photos of decor, outfits, jewellery and more to inspire you for your big day.
                    </p>
                    <div class="row gtMarginTop20">
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=outfit" class="gtPhotoBucket">
                                <img src="img/bridalwearnew.jpg" class="img-responsive">
                                <h4>OUTFITS</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=jewellery" class="gtPhotoBucket">
                                <img src="img/jewellerynew.jpg" class="img-responsive">
                                <h4>JEWELLERY</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=makeup" class="gtPhotoBucket">
                                <img src="img/MakeUp&HairHome.jpg" class="img-responsive">
                                <h4>MAKEUP & HAIR</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=decor" class="gtPhotoBucket">
                                <img src="img/decornew.jpg" class="img-responsive">
                                <h4>DECOR</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=photography" class="gtPhotoBucket">
                                <img src="img/PhotographyHome.jpg" class="img-responsive">
                                <h4>PHOTOGRAPHY</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=invitation" class="gtPhotoBucket">
                                <img src="img/invitationsHome.JPG" class="img-responsive">
                                <h4>INVITATION</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=catering" class="gtPhotoBucket">
                                <img src="img/CateringHome.jpg" class="img-responsive">
                                <h4>CATERING</h4>
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-4 col-sm-8">
                            <a href="vendor-list?tab=dj" class="gtPhotoBucket">
                                <img src="img/djHome.jpg" class="img-responsive">
                                <h4>DJ</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container gtImageContainer">
                    <div class="container">
                        <h4>Find Your Wedding Venue</h4>
                        <p>Check availability & pricing at the click of a button.</p>
                        <a href="vendor-list?tab=venue" class="btn btn-orange">Browse Venue</a>
                    </div>
                </div>
            </div>
            <?php include("parts/footer.php"); ?>
        </div>

        <!-- Jquery --->
        <script src="../js/jquery.min.js"></script>
        <!--- Jquery END --->
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="../js/bootstrap.js"></script>
       
        <!-------------------------------------- jQuery Validation ----------------------------------->
        <script type="text/javascript" src="../js/validetta.js"></script>
        <!-------------------------------------- jQuery Validation End---------------------------------->
        <script src="../js/green.js"></script> 
        <!--- BOOTSTRAP AND GREEN JS END--->
        <!--- OWL CAROUSEL --->
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/chosen.jquery.js" type="text/javascript"></script>
        <script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!--- OWL CAROUSEL END--->
        <script type="text/javascript">
            $(function() {
                $('#vendor_search_form').validetta({
                    errorClose: false,
                    realTime: true
                });
				
            });
        </script>

    </body>
</html>                                                                                                                             
