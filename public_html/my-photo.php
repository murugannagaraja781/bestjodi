<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

include_once 'auth.php';
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['image'])) {
    $image_name = substr($_POST['image_name'], -14);
    $img = $_POST['image']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    file_put_contents('my_photos/' . $image_name, $data);
}

$Row = $DatabaseCo->dbLink->query("select photo1,photo2,photo3,photo4,photo5,photo6,gender,photo_view_status,photo_protect,photo_pswd from register where matri_id='" . $mid . "'") or die(mysqli_error($DatabaseCo->dbLink));

$Row = mysqli_fetch_object($Row);
?>
<?php
if (isset($_GET['mp-rem-id'])) {
    $DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='" . $_GET['mp-rem-id'] . "'");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <meta name="theme-color" content="#549a11">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#549a11">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
		<!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <!-- WEB SITE TITLE DESCRIPTION END--> 

        <!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

		<!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->


        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
        
		<!----PHOTO CROP CSS---->
        <link rel="stylesheet" type="text/css" href="css/photocrop/component.css"/>
        <!----PHOTO CROP CSS END---->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    	<!-- ICON LOADER-->
		<div class="preloader-wrapper text-center">
			<div class="loader"></div>
			<h5>Loading...</h5>
		</div>
		<!-- ICON LOADER END-->
        <div id="body" style="display:none">
        <?php include "parts/header.php"; ?>
        <?php include "parts/menu-aft-login.php"; ?>

        <div class="container gt-margin-top-20">
            <div class="row">
                <div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center">
                    <h2 class="gt-margin-top-0 gt-text-orange">
                        Upload & Profile Picture Settings
                    </h2>
                    <article>
                        <p>
                            Here is your option to set your profile pictures and other pictures.Remember upload profile picture gives you 10 times better respose.So do it now if you didnt.
                        </p>
                    </article>
                </div>
                <div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
                    <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                        Options <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="collapse mobile-collapse" id="collapseExample">
                        <?php include "parts/left_panel.php"; ?>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
                    <div class="gt-profile-pic-title">
                        <h4>
                            Change Or Upload Profile Picture
                        </h4>
                    </div>
                    <div class="gt-profile-pic-panel">
                        <div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
                            <div class="row">
                                <div class="col-xxl-5 col-xxl-offset-3 col-xl-7 col-xl-offset-1 col-lg-8 gt-margin-bottom-15">
                                    <h4 class="gt-font-weight-400 text-muted">
                                        Photo Privacy Status:- 
                                    </h4>
                                </div>
                                
                                <div class="col-xxl-5 col-xl-7 col-lg-8 gt-margin-bottom-15">
                                	<?Php 
									  if ($Row->photo_protect == 'Yes' && $Row->photo_pswd!=''){ ?>
                                    	<a href="settings?photoVisiblity" class="btn gt-btn-green">SET PHOTO PRIVACY</a>
                                    <?Php }else{ ?>
                                    <select class="gt-form-control" id="view_photo" name="view_photo">	
                                        <option value="1" <?php
                                        if ($Row->photo_view_status == '1') {
                                            echo "selected";
                                        }
                                        ?>>Visible To All</option>
                                        <option value="2" <?php
                                        if ($Row->photo_view_status == '2') {
                                            echo "selected";
                                        }
                                        ?>>Visible To Paid Members</option>
                                        <option value="0" <?php
                                        if ($Row->photo_view_status == '0') {
                                            echo "selected";
                                        }
                                        ?>>Hidden For All</option>
                                    </select>
                                    <?php }?>
                                </div>
                            </div>
                            <form method="post" action="" id="profile_image" name="profile_image">
                                <div class="row" id="preview">
                                    <div class="col-xxl-6 col-xxl-offset-5 col-xl-6 col-xxl-offset-5 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5">
                                        <div class="imgmain col-xs-16">
                                            <img src="img/<?php echo strtolower($_SESSION['gender123']) . '.png'; ?>" class="img-responsive img-developer-larg">
                                            <a  href="" class="gt-myhome-caption">
                                                Change Profile Picture
                                            </a>
                                        </div>
                                    </div>
                                    <div id="loaderID"></div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-xxl-6 col-xl-16 col-xxl-offset-5">
                                    <div class="row">
                                        <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-lg-7 gt-margin-bottom-15">
                                            <a class="btn btn-computer gt-cursor" id="get_img">
                                                <i class="fa fa-desktop"></i><h4>Upload From Computer</h4>
                                            </a>
                                            <form action="edit_photo_upload" name="imageform" id="imageform" method="post" enctype="multipart/form-data">
                                                <input type="file" id="my_file" name="image">
                                            </form>
                                        </div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gt-profile-pic-title">
                        <h4>
                            Upload More Photoes
                        </h4>
                    </div>
                    <div class="gt-profile-pic-panel">
                        <div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
                            <form method="post" action="" id="profile_image1" name="profile_image1">
                                <div class="row" id="preview1">

                                </div>
                                <input type="hidden" name="img_id" id="img_id" value="">
                            </form>
                            <form action="edit_more_upload" name="imageform1" id="imageform1" method="post" enctype="multipart/form-data">
                                <input type="file" id="my_file1" name="image"></form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include "parts/footer-before-login.php"; ?>
		</div>
        
        <script src="js/jquery.min.js"></script>
       
        <script src="js/bootstrap.js"></script>
        <script src="js/green.js"></script>
        <script>
              $(document).ready(function() {
              $('#body').show();
              $('.preloader-wrapper').hide();
              });
        </script>
        <script>
            $('[data-toggle="popover"]').popover({
                trigger: 'click',
                'placement': 'top'
            });
        </script>
        <script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 991) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script>
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  
<script type="text/javascript" src="js/photoupload/jquery.min.js"></script>
<script type="text/javascript">
    var $16 = jQuery.noConflict();
</script>
<script type="text/javascript" src="js/photoupload/jquery.form.js"></script>
<script type="text/javascript">
    document.getElementById('get_img').onclick = function() {
        document.getElementById('my_file').click();
    };
    function edit_id() {
        $('#editimg1').click(function() {
            $("#preview1").html('');
            $('#img_id').val('');
        });

        $('#edit1').click(function() {
            $('#img_id').val('1');
            document.getElementById('my_file1').click();
        });

        $('#edit2').click(function() {
            $('#img_id').val('2');
            document.getElementById('my_file1').click();
        });

        $('#edit3').click(function() {
            $('#img_id').val('3');
            document.getElementById('my_file1').click();
        });
		
        $('#edit4').click(function() {
            $('#img_id').val('4');
            document.getElementById('my_file1').click();
        });

        $('#edit5').click(function() {
            $('#img_id').val('5');
            document.getElementById('my_file1').click();
        });

        $('#edit6').click(function() {
            $('#img_id').val('6');
            document.getElementById('my_file1').click();
        });

        $('#delete1').click(function() {
            del_photo('1');
        });
		
        $('#delete2').click(function() {
            del_photo('2');
        });
		
        $('#delete3').click(function() {
            del_photo('3');
        });
		
        $('#delete4').click(function() {
            del_photo('4');
        });
		
        $('#delete5').click(function() {
            del_photo('5');
        });
		
        $('#delete6').click(function() {
            del_photo('6');
        });
		
        $('#delete7').click(function() {
            del_photo('7');
        });
		
        $('#delete8').click(function() {
            del_photo('8');
        });
    }

    function set_as_profile_photo(img_id) {
        var dataString = 'photo_id=' + img_id;
        jQuery.ajax({
            url: "./web-services/set_as_profile_photo",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response)
            {
                dis_thumbnail();
                display_photo1();
                display_more_photo();
                $("#loaderID").css("opacity", 1);
                $("#loaderID").css("z-index", 9999);
                $16('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-green"><font class="gt-margin-left-5">You have successfully edited your photo....&nbsp;&nbsp;</font></div></div>');

                setTimeout(function() {
                    $("#loaderID").css("opacity", 0);
                    $("#loaderID").css("z-index", -1);
                }, 3000);
            },
        });
    }

    function del_photo(del_id){
        var dataString = 'photo_id=' + del_id;
        jQuery.ajax({
            url: "./web-services/delete_photo",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response){
                dis_thumbnail();
                display_photo1();
                display_more_photo();
                $("#loaderID").css("opacity", 1);
                $("#loaderID").css("z-index", 9999);
                $16('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-green"><font class="gt-margin-left-5">Your photo has been deleted successfully...&nbsp;&nbsp;</font></div></div>');

                setTimeout(function() {
                    $("#loaderID").css("opacity", 0);
                    $("#loaderID").css("z-index", -1);
                }, 3000);
            },
        });
    }

    function display_photo1(){
        var dataString = '';
        jQuery.ajax({
            url: "./web-services/display_photo1",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response){
                console.log()
                $("#preview .imgmain").html('');
                $("#preview .imgmain").append(response);
            },
        });
    }
    function display_more_photo(){
        var dataString = '';
        jQuery.ajax({
            url: "./web-services/display_more_photo",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response){
                $("#preview1").html('');
                $("#preview1").append(response);
                edit_id();
            },
        });
    }
    function profile_image(){
        var dataString = $("#profile_image").serialize() + '&edit_details=profile_image';
        jQuery.ajax({
            url: "./web-services/editdetails",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response){
                dis_thumbnail();
                display_photo1();
                display_more_photo();
                $('#myModal').modal('toggle');
                $("#loaderID").css("opacity", 1);
                $("#loaderID").css("z-index", 9999);
                $16('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-green"><font class="gt-margin-left-5">You have successfully edited your photo....&nbsp;&nbsp;</font></div></div>');

                setTimeout(function() {
                    $("#loaderID").css("opacity", 0);
                    $("#loaderID").css("z-index", -1);
                }, 3000);
            },
        });
    }

    function profile_imageother(){
        var dataString = $("#profile_image1").serialize() + '&edit_details=profile_image';
        jQuery.ajax({
            url: "./web-services/editdetails",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response){
                display_more_photo();
                $("#loaderID").css("opacity", 1);
                $("#loaderID").css("z-index", 9999);
                $16('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-green"><font class="gt-margin-left-5">Your photo has been uploaded successfully...&nbsp;&nbsp;</font></div></div>');

                setTimeout(function() {
                    $("#loaderID").css("opacity", 0);
                    $("#loaderID").css("z-index", -1);
                }, 3000);
            },
        });
    }

    $(document).ready(function(){
        dis_thumbnail();
        display_photo1();
        display_more_photo();

        $('#view_photo').change(function() {
            var dataString = 'photo_view_status=' + $('#view_photo').val();
            jQuery.ajax({
                url: "./web-services/set_view_preference",
                type: "POST",
                data: dataString,
                cache: false,
                success: function(response)
                {
                    $("#loaderID").css("opacity", 1);
                    $("#loaderID").css("z-index", 9999);
                    $16('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">You have successfully selected your photo view preference....&nbsp;&nbsp;</font></div></div>');

                    setTimeout(function() {
                        $("#loaderID").css("opacity", 0);
                        $("#loaderID").css("z-index", -1);
                    }, 3000);
                },
            });
        });
		$('#editimg').on('click', function() {
            $16("#preview").html('');
        });
        $("myModal1").mousedown(function(e) {
            e.preventDefault();
            alert(e.which);
            if ((e.which == 1)) {
                alert("left button");
            }
            if ((e.which == 3)) {
                alert("right button");
				
            } else if ((e.which == 2)) {
                alert("middle button");
            }
        }).mousedown('contextmenu', function(e) {
            e.preventDefault();
        });

        $16('#my_file').live('change', function() {
            $16('#loaderID').html('<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2" style="position: fixed; z-index: 9999; opacity: 1; top: 50%; left: 54%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div></div>');
            $16('#imageform').ajaxForm({
                target: '#preview'
            }).submit();
            $16('#preview > .ththumbnail').hide();
            $16('#preview > .ththumbnail').hide();
        });
        $16('#image_mobile').live('change', function() {
            $16("#preview").html('');
            $16('#preview').html('<div style="height:240px;text-align:center;"><img src="img/loading.gif" alt="Uploading...."/></div>');
            $16('#imageformmobile').ajaxForm({
                target: '#preview'
            }).submit();
            $16('#demo_photo').hide();
            $16('#demo_photo1').hide();
        });
        $16('#my_file1').live('change', function() {
            $16("#loaderID").css("opacity", 1);
            $16("#loaderID").css("z-index", 9999);
            $16('#loaderID').html('<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2" style="position: fixed; z-index: 9999; opacity: 1; top: 50%; left: 54%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div></div>');
            $16('#imageform1').ajaxForm({
                success: function(responce)
                {
                    if (responce != '')
                    {
                        $('#preview1').html(responce);
                        $16("#loaderID").css("opacity", 0);
                        $16("#loaderID").css("z-index", -1);
                    }
                    else
                    {
                        $16("#loaderID").css("opacity", 0);
                        $16("#loaderID").css("z-index", -1);
                    }
                }
            }).submit();
        });
        $16('#image_mobile1').live('change', function() {
            $16("#preview1").html('');
            $16('#preview1').html('<div style="height:240px;text-align:center;"><img src="img/loading.gif" alt="Uploading...."/></div>');
            $16('#imageformmobile1').ajaxForm({
                target: '#preview1'
            }).submit();
        });
    });
    function dis_thumbnail()
    {
        var dataString = '';
        jQuery.ajax({
            url: "./web-services/display_thumbnail",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response)
            {
                $("#dis_thumbnail").html('');
                $("#dis_thumbnail").append(response);
            },
        });
    }
</script>
