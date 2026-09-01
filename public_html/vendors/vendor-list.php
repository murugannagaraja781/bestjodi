<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();

$category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
$city_result = $DatabaseCo->dbLink->query("select * from vendor_city");

if(isset($_GET['clear'])){
	$_POST = array();	
}
if (isset($_POST['submit'])) {
    $category_id = (isset($_POST['category_id']) && $_POST['category_id'] != "") ? $_POST['category_id'] : "";
    $city_id = (isset($_POST['city_id']) && $_POST['city_id'] != "") ? $_POST['city_id'] : "";
	
    $vendor_name = (isset($_POST['vendor']) && $_POST['vendor'] != "") ? $_POST['vendor'] : "";
    $sql = "select * from vendors v left join vendor_city ct on v.city_id = ct.city_id where";

    if ($category_id != "") {
        $sql.=" v.category_id = " . $category_id . "";
    }
    if ($city_id != "") {
        $sql.=" and v.city_id = " . $city_id . "";
    }
    if ($vendor_name != "") {
        $sql.=" and v.name like '%" . $vendor_name . "%' ";
    }

    $vendors_list = $DatabaseCo->dbLink->query($sql);
}
if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
    if ($tab == 'outfit') {
        $category_id = 4;
    } elseif ($tab == 'jewellery') {
        $category_id = 12;
    } elseif ($tab == 'makeup') {
        $category_id = 3;
    } elseif ($tab == 'decor') {
        $category_id = 6;
    } elseif ($tab == 'photography') {
        $category_id = 2;
    } elseif ($tab == 'invitation') {
        $category_id = 8;
    } elseif ($tab == 'catering') {
        $category_id = 13;
    } elseif ($tab == 'dj') {
        $category_id = 15;
    } elseif ($tab == 'venue') {
        $category_id = 1;
    }

    $sql = "select * from vendors where category_id = '". $category_id ."'";

    $vendors_list = $DatabaseCo->dbLink->query($sql);
}

if (isset($category_id) && $category_id != "") {
    while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) {
        if ($category_id == $DatabaseCo->dbRow->id) {
           $category_name = $DatabaseCo->dbRow->name;
        }
    }
    $category_result = $DatabaseCo->dbLink->query("select * from vendor_category");
}
if (isset($city_id) && $city_id != "") {
    while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) {
        if ($city_id == $DatabaseCo->dbRow->city_id) {
           $city_name = $DatabaseCo->dbRow->city_name;
        }
    }
    $city_result = $DatabaseCo->dbLink->query("select * from vendor_city");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE = edge">
        <meta name="viewport" content="width = device-width, initial-scale = 1">

        <!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>

        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />

        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  

        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE TITLE DESCRIPTION END-->  

        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
        <!-------------------Validation css ------------------>

        <link rel="stylesheet" href="../css/validate.css">

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
                <div class="container">
                    <form action="vendor-list" method="post" id="vendor_search">
                        <div class="row">
                            <div class="col-xxl-14 col-xxl-offset-1 col-xl-16 gtMarginTop80 gtVendorList">
                                <div class="col-xxl-4 col-xl-4">
                                   
                                    <select required name="category_id" id="category_id" class="form-control" data-validetta="required">
                                        <option value="">Select Category</option>
                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($category_result)) { ?>

                                            <option value="<?php echo $DatabaseCo->dbRow->id; ?>" ><?php echo $DatabaseCo->dbRow->name; ?></option>
                                        <?php } ?>
                                    </select>
                                   
                                </div>
                                <div class="col-xxl-4 col-xl-4">
                                    <select  class="chosen-select gt-form-control gt-height-auto" tabindex="5" name="city_id" id="city" >
                                        <option value="">Select City</option>
                                        <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($city_result)) { ?>
                                            <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xxl-5">
                                   <input type="text" name="vendor" class="form-control" aria-describedby="basic-addon2" placeholder="Search Vendor">									
                                </div>
                                <div class="col-xxl-3">
                                	<button class="btn btn-success btn-lg" id="submit" type="submit" name="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row gtMarginTop20">
                        <div class="col-xxl-16 text-center">
                            <?php if (isset($category_name)) { ?>

                                <b>Result:&nbsp;
                                </b><span class = ""><a href="vendor-list.php?clear=clear"><?= $category_name ?>&nbsp;
                                        <i class = "fa fa-times"></i></a></span>&nbsp;
                                &nbsp;
                                <?php if (isset($city_name)) { ?>
                                    <span class = ""><a href = "vendor-list.php?clear=clear"><?= $city_name ?>&nbsp;
                                            <i class = "fa fa-times"></i></a></span>
                                <?php } ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class = "row gtMarginTop30">
                        <div class = "col-xxl-4">
                            <ul class = "nav nav-tabs nav-pills nav-stacked gtTabs" role = "tablist">
                                
                                <li role="presentation" class="<?php
                                if (!isset($category_id) || $category_id == "") {
                                    echo 'active';
                                } elseif ($category_id == 1) {
                                    echo 'active';
                                } else {
                                    echo '';
                                }
                                ?>">
                                    <a href="#vendor-1" aria-controls="vendor-1" role="tab" data-toggle="tab">Wedding Venues</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '2') ? 'active' : ''; ?>">
                                    <a href="#vendor-2" aria-controls="vendor-2" role="tab" data-toggle="tab">Wedding Photographers</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '3') ? 'active' : ''; ?>">
                                    <a href="#vendor-3" aria-controls="vendor-3" role="tab" data-toggle="tab">Bridal Makeup</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '4') ? 'active' : ''; ?>">
                                    <a href="#vendor-4" aria-controls="vendor-4" role="tab" data-toggle="tab">Bridal Wear</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '5') ? 'active' : ''; ?>">
                                    <a href="#vendor-5" aria-controls="vendor-5" role="tab" data-toggle="tab">Groom Wear</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '6') ? 'active' : ''; ?>">
                                    <a href="#vendor-6" aria-controls="vendor-6" role="tab" data-toggle="tab">Wedding Decor</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '7') ? 'active' : ''; ?>">
                                    <a href="#vendor-7" aria-controls="vendor-7" role="tab" data-toggle="tab">Wedding Planner</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '8') ? 'active' : ''; ?>">
                                    <a href="#vendor-8" aria-controls="vendor-8" role="tab" data-toggle="tab">Wedding Cards</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '9') ? 'active' : ''; ?>">
                                    <a href="#vendor-9" aria-controls="vendor-9" role="tab" data-toggle="tab">Wedding Videography</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '10') ? 'active' : ''; ?>">
                                    <a href="#vendor-10" aria-controls="vendor-10" role="tab" data-toggle="tab">Mehendi Artist</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '11') ? 'active' : ''; ?>">
                                    <a href="#vendor-11" aria-controls="vendor-11" role="tab" data-toggle="tab">Wedding Cakes</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '12') ? 'active' : ''; ?>">
                                    <a href="#vendor-12" aria-controls="vendor-12" role="tab" data-toggle="tab">Wedding Jewellery</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '13') ? 'active' : ''; ?>">
                                    <a href="#vendor-13" aria-controls="vendor-13" role="tab" data-toggle="tab">Wedding Catering</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '14') ? 'active' : ''; ?>">
                                    <a href="#vendor-14" aria-controls="vendor-14" role="tab" data-toggle="tab">Trousseau Packers</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '15') ? 'active' : ''; ?>">
                                    <a href="#vendor-15" aria-controls="vendor-15" role="tab" data-toggle="tab">DJ</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '16') ? 'active' : ''; ?>">
                                    <a href="#vendor-16" aria-controls="vendor-16" role="tab" data-toggle="tab">Choreographers</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '17') ? 'active' : ''; ?>">
                                    <a href="#vendor-17" aria-controls="vendor-17" role="tab" data-toggle="tab">Wedding Accessories</a>
                                </li>
                                <li role="presentation" class="<?php echo ($category_id == '18') ? 'active' : ''; ?>">
                                    <a href="#vendor-18" aria-controls="vendor-18" role="tab" data-toggle="tab">Wedding Favors</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-xxl-12">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane
                                <?php
                                if (!isset($category_id) || $category_id == "") {
                                    echo 'active';
                                } elseif ($category_id == 1) {
                                    echo 'active';
                                } else {
                                    echo '';
                                }
                                ?>" id="vendor-1">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Venues</h4>
                                        </div>
                            
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 1) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p>Rs.<?php echo $DatabaseCo->dbRow->starting_price; ?>/-</p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5>
                                                                        <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                                                                        <?php
																			 $city= $DatabaseCo->dbRow->city_id;
																			 $get_vendor_city = $DatabaseCo->dbLink->query("select city_name from vendor_city WHERE city_id='$city'");
						 													 $DatabaseCo->dbRow=mysqli_fetch_object($get_vendor_city);
																			echo $DatabaseCo->dbRow->city_name; 
																		?>
                                                                   		</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_1_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 1 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_1_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '2') ? 'active' : ''; ?>" id="vendor-2">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Photographer</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 2) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_2_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 2 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_2_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '3') ? 'active' : ''; ?>" id="vendor-3">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Bridal Makeup</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 3) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_3_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 3 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_3_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '4') ? 'active' : ''; ?>" id="vendor-4">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Bridal Wear</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 4) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_4_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 4 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_4_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '5') ? 'active' : ''; ?>" id="vendor-5">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Groom Wear</h4>
                                        </div>
                                      
                                    </div>
                                    <div class="row">

                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 5) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_5_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 5 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_5_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '6') ? 'active' : ''; ?>" id="vendor-6">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Decor</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 6) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_6_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 6 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_6_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '7') ? 'active' : ''; ?>" id="vendor-7">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Planner</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 7) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_7_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 7 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_7_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '8') ? 'active' : ''; ?>" id="vendor-8">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Cards</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 8) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_8_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 8 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_8_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '9') ? 'active' : ''; ?>" id="vendor-9">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Videography</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 9) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_9_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 9 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_9_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '10') ? 'active' : ''; ?>" id="vendor-10">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Mehndi Artist</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 10) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_10_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 10 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_10_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '11') ? 'active' : ''; ?>" id="vendor-11">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Cakes</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 11) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_11_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 11 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_11_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '12') ? 'active' : ''; ?>" id="vendor-12">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Jwellery</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 12) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_12_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 12 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_12_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '13') ? 'active' : ''; ?>" id="vendor-13">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Catering</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 13) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_13_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 13 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_13_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '14') ? 'active' : ''; ?>" id="vendor-14">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Trousseau Packers</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 14) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?> <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_14_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 14 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_14_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '15') ? 'active' : ''; ?>" id="vendor-15">
                                    <div class="row text-center gtMarginBottom30">
                                       <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">DJ</h4>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 15) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?> <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_15_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 15 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_15_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '16') ? 'active' : ''; ?>" id="vendor-16">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Chereographer</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 16) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>  <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_16_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 16 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_16_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '17') ? 'active' : ''; ?>" id="vendor-17">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Accessories</h4>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?> <?php if ($category_id == 17) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?>  <?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_17_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 17 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_17_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo ($category_id == '18') ? 'active' : ''; ?>" id="vendor-18">
                                    <div class="row text-center gtMarginBottom30">
                                        <div class="col-xxl-16 col-xl-16">
                                            <h4 class="gtMarginTop30 gtMarginTop10">Wedding Favor</h4>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <?php if (isset($vendors_list)) { ?>
                                            <?php if ($category_id == 18) { ?>
                                                <?php if (mysqli_num_rows($vendors_list) > 0) { ?>
                                                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendors_list)) { ?>
                                                        <div class="col-xxl-8">
                                                            <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                                <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                                <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                                <div class="row">
                                                                    <div class="col-xxl-10">
                                                                        <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                                    </div>
                                                                    <div class="col-xxl-6">
                                                                        <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning">No Records found</div>
                                                <?php } ?><?php } ?>
                                        <?php } else { ?>
                                            <?php $vendor_18_list = $DatabaseCo->dbLink->query("select * from vendors v left join city ct on ct.city_id = v.city_id where category_id = 18 "); ?>
                                            <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($vendor_18_list)) { ?>
                                                <div class="col-xxl-8">
                                                    <a href="vendor-details?id=<?php echo $DatabaseCo->dbRow->id; ?>" class="gt-card">
                                                        <img src="vendor-img/<?php echo $DatabaseCo->dbRow->image; ?>" class="img-responsive" style="max-height:200px;width:100%;">
                                                        <p><?php echo $DatabaseCo->dbRow->starting_price; ?></p>
                                                        <div class="row">
                                                            <div class="col-xxl-10">
                                                                <h5 class=""><?php echo $DatabaseCo->dbRow->name; ?></h5>
                                                            </div>
                                                            <div class="col-xxl-6">
                                                                <h5><?php echo $DatabaseCo->dbRow->city_name; ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
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
        <!--- OWL CAROUSEL --->
        <script src="../js/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!--- OWL CAROUSEL END--->
 <script type="text/javascript" src="../js/validetta.js"></script>
        <script type="text/javascript">

            $(function() {
                $('#vendor_search').validetta({
                    errorClose: false,
                    realTime: true
                });
            });

        </script>
    </body>
</html>                                                                                                                             
