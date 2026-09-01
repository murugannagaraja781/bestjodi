<?php 
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['mobile'];
		$subject=$_POST['subject'];
		$mes=$_POST['message'];
		$from=$_POST['email'];
		$to="contact@thegreentech.in";
		
		$message = "<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet'>
</head>
<body style='margin:0px;padding-top:50px;padding-bottom:50px;background:rgb(232, 233, 234);font-family: 'Roboto', sans-serif;'>
	<div style='width:70%;margin:0 auto;background:rgb(255, 255, 255);box-shadow:0px 0px 3px 0px rgb(136, 136, 136);margin-top:10%;border-radius:3px;'>
    	<div style='border-bottom:1px solid rgba(204,204,204,1.00);padding:10px;'>
        	<h3 style='margin-top:0px;margin-bottom:0px;font-weight:400;padding-top:10px;padding-bottom:10px;color:#9e071b;font-size:22px;'>Green Web Tech- Contact Us</h3>
        </div>
        <div style='display:table;width:100%;padding-top:15px;padding-bottom:15px;'>
        	<div style='width:25%;float:left;margin-bottom:10px;'>
                <span style='padding:10px;font-size:15px;color:#6f6f6f;'>Name:</span> 
            </div>
            <div style='width:75%;float:left;margin-bottom:10px;'>
            	<span style='padding:10px;font-size:15px;color:#9e071b;'>$name</span>
            </div>
            <div style='float:none;'></div>
            <div style='width:25%;float:left;margin-bottom:10px;'>
                <span style='padding:10px;font-size:15px;color:#6f6f6f;'>Email Id:</span> 
            </div>
            <div style='width:75%;float:left;margin-bottom:10px;'>
            	<span style='padding:10px;font-size:15px;color:#9e071b;'>$email</span>
            </div>
            <div style='float:none;'></div>
            <div style='width:25%;float:left;margin-bottom:10px;'>
                 <span style='padding:10px;font-size:15px;color:#6f6f6f;'>Contact No:</span> 
            </div>
            <div style='width:75%;float:left;margin-bottom:10px;'>
            	<span style='padding:10px;font-size:15px;color:#9e071b;'> $phone</span>
            </div>
            <div style='float:none;'></div>
            <div style='width:25%;float:left;margin-bottom:10px;'>
                <span style='padding:10px;font-size:15px;color:#6f6f6f;'>Subject:</span> 
            </div>
            <div style='width:75%;float:left;margin-bottom:10px;'>
            	<span style='padding:10px;font-size:15px;color:#9e071b;'> $subject</span>
            </div>
            <div style='float:none;'></div>
            <div style='width:25%;float:left;margin-bottom:10px;'>
                <span style='padding:10px;font-size:15px;color:#6f6f6f;'>Message:</span> 
            </div>
            <div style='width:75%;float:left;margin-bottom:10px;'>
            	<span style='padding:10px;font-size:15px;color:#9e071b;'> $mes</span>
            </div>
        </div>
	</div>
</body>
</html>

               
                    ";

                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                    $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);	
				
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Thank you for contact us</title>
    	<meta name="description" content="Matrimonial website development in india with high end features also develop custom responsive matrimony script.">
    	<meta name="keywords" content="matrimonial sites for sale,readymade matrimonial script,matrimonial project in php with source code">
        <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon.png">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Boots Nav -->
        <link href="assets/bootsnav-master/css/bootsnav.css" rel="stylesheet">
        <!-- Themify Icons -->
        <link href="assets/themify-icons/themify-icons.css" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Animate CSS -->
        <link href="assets/bootsnav-master/css/animate.css" rel="stylesheet">
        <!-- Sweet Alert -->
        <link href="assets/sweet-alert/sweetalert.css" rel="stylesheet">
        <!-- Custom Style -->
        <link href="css/style.css" rel="stylesheet">
        <!-- Color CSS -->
        <link id="main" href="css/color_01.css" rel="stylesheet">
        <link id="theme" href="css/color_01.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- ==============================================
                     **PRE LOADER**
        =============================================== -->
        <div id="page-loader">
            <div class="loader-container">
                <div class="loader-logo">
                    <span>LOADING</span>
                </div>
                <div class="loader"></div>
            </div>
        </div>
        <!-- ==============================================
                     **MAIN HEADER**
        =============================================== -->
        <header class="header-wrapper solid-bg">
            <?php include("includes/menu.php"); ?>
            <!-- End Navigation -->
</header><!-- End Header -->
<!-- ==============================================
                     **MAIN BANNER**
=============================================== -->
<section class="main-banner paraxify banner-image-1 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-banner-content text-center">
                    <h2>Thank You</h2>
                    <p>Thank you for contact us.</p>
                </div>
            </div>
        </div>
    </div><!-- End Container -->
</section><!-- End Section -->
<!-- ==============================================
                     ** REQUEST FORM**
=============================================== -->
<section class="demo-request-form ptb-100 bg-gray">
    <div class="container">
        <div class="row">
            <div class="super-title text-center">
            	<h1><i class="ti-comment-alt"></i></h1>
                <h2 class="pt-20">Thank You For Contact Us</h2>
                <p class="pt-10">We will get back to you within 24 hours</p>
            </div>
           	<div class="col-xs-12 text-center">
            	<a href="index.php" class="btn btn-theme-primary">Continue</a>
            </div>
        </div>
        
    </div>
</section>

<!-- ==============================================
                     **FOOTER STARTS**
=============================================== -->        
<?php include("includes/footer.php"); ?><!-- End Footer -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Modenizer JS -->
        <script src="js/modernizr-custom.js"></script>
        <!-- Bootsvav Menu -->
        <script src="assets/bootsnav-master/js/bootsnav.js" type="text/javascript"></script>
        <!-- Parallax -->
        <script src="assets/paraxify/paraxify.min.js" type="text/javascript"></script>
        <!-- Way Points -->
        <script src="assets/waypoints/waypoints.min.js" type="text/javascript"></script>
        <!-- Conterup -->
        <script src="assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- Sweet Alert -->
        <script src="assets/sweet-alert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Form Validation -->
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <!-- Contact/Demo Request Script AJAX -->
        <script src="js/contact.js" type="text/javascript"></script>
        <!-- Custom JS -->
        <script src="js/custom.js"></script>
        
    </body>
</html>
