<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <title>Express Interest Sent Pending - New Matri website</title>

    <!-----------------------------------Greenstrap------------------------------------>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	<!-----------------------------------Greenstrap End-------------------------------->
    <!-----------------------------------Font Awsome----------------------------------->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!-----------------------------------Font Awsome End------------------------------->
    <!------------------------------------owl carousel--------------------------------->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <!------------------------------------owl carousel End--------------------------------->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="preloader-wrapper">
      	<i class="gi gi-loader gi-spin"></i>
    </div>
    <div id="body" style="display:none">
    <?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    
    <div class="container">
    	<div class="row">
        	<div class="col-xxl-12 col-xl-12 col-xxl-offset-4 col-xl-offset-4">
            	<h2 class="gt-margin-top-0">
            	    Express Interest Sent Pending
                </h2>
                <article class="gt-margin-bottom-20">
                	<p>
                    	Here you can see your all Received express interest which you received from members.and with left side panel you can access other particluar express interest.
                    </p>
                </article>
            </div>
        	<?php include "parts/express-interest-side-pan.php" ?>
            <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-exp-main">
              <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16">
                <div class="row">
                  <div class="gt-exp-strip">
                            	<label class="col-xxl-1 col-xl-1 col-lg-1 col-xs-2 hidden-xs hidden-sm hidden-md" for="exp-rec-all-1">
                                	<input type="checkbox" id="exp-rec-all-1">
                                </label>
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-5 col-xs-7  hidden-xs hidden-sm hidden-md">
                                	<a href="" class="btn gt-btn-green"><i class="fa fa-bell gt-margin-right-10"></i>Send Reminder</a>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-md-5 col-xs-6  hidden-xs hidden-sm hidden-md">
                               	 	<a href="" class="btn btn-danger"><i class="fa fa-trash gt-margin-right-10"></i>Delete</a>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6 col-xs-6 pull-right">
                                	<div class="btn-group" role="group">
  										<button type="button" class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
  										<button type="button" class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
  									</div>
                                </div>
                            </div>
                     <?php include"parts/express-interest-sent.php"; ?>  
                     <?php include"parts/express-interest-sent.php"; ?>
                     <?php include"parts/express-interest-sent.php"; ?>   
                  <div class="gt-exp-strip gt-margin-top-15">
                            	<label class="col-xxl-1 col-xl-1 col-lg-1 col-xs-2 hidden-xs hidden-sm hidden-md" for="exp-rec-all-1">
                                	<input type="checkbox" id="exp-rec-all-1">
                                </label>
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-5 col-xs-7  hidden-xs hidden-sm hidden-md">
                                	<a href="" class="btn gt-btn-green"><i class="fa fa-bell gt-margin-right-10"></i>Send Reminder</a>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-md-5 col-xs-6  hidden-xs hidden-sm hidden-md">
                               	 	<a href="" class="btn btn-danger"><i class="fa fa-trash gt-margin-right-10"></i>Delete</a>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6 col-xs-6 pull-right">
                                	<div class="btn-group" role="group">
  										<button type="button" class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
  										<button type="button" class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
  									</div>
                                </div>
                            </div>
				</div>
              </div>
           </div>
        </div>
    </div>
    <?php include "parts/footer-before-login.php"; ?>
	
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js"></script>
    <script src="js/green.js"></script>
    <script>
	$(document).ready(function() {
    	$('#body').show();
    	$('.preloader-wrapper').hide();
	});
    </script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <script>
   	$('[data-toggle="popover"]').popover({
   	trigger: 'click',
    'placement': 'top'
     });
	</script>
    <script>
   jQuery(function ($) {
    var $active = $('#accordion .panel-collapse.in').prev().addClass('active');
    $active.find('a').prepend('<i class="fa fa-minus pull-right"></i>');
    $('#accordion .panel-heading').not($active).find('a').prepend('<i class="fa fa-plus pull-right"></i>');
    $('#accordion').on('show.bs.collapse', function (e) {
        $('#accordion .panel-heading.active').removeClass('active').find('.fa').toggleClass('fa-plus fa-minus');
        $(e.target).prev().addClass('active').find('.fa').toggleClass('fa-plus fa-minus');
    })
});
	</script>
    <script>
   	(function($) {
    var $window = $(window),
        $html = $('.mobile-collapse');
			$window.width(function width(){
        		if ($window.width() > 991) {
            	return $html.addClass('in');
        	}
			$html.removeClass('in');
    		});
		})(jQuery);
    </script>
	
    

	
  </body>
</html>                                                                                                                              <?php include'thumbnailjs.php';?>                  