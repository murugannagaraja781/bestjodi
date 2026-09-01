<?php



include_once '../databaseConn.php';
  include_once '../class/Config.class.php';

	$configObj = new Config();



include_once '../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();







$sql=$DatabaseCo->dbLink->query("select banner1,banner2,banner3 from site_config where id='1'");



$row=mysqli_fetch_array($sql);







?>







<!DOCTYPE html>



<html>



  <head>



    <meta charset="UTF-8">



    <title>Manage | Banner</title>



    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>



    <!-- Bootstrap 3.3.2 -->



    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    



    <!-- Theme style -->



    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />



     <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />



   



        



    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />











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



          Home Page Banner



          </h1>



          <ol class="breadcrumb">



            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>



            <li class="active"> Home Page Banner</li>



          </ol>



        </section>



		



        <!-- Main content -->



        <section class="content">



          <!-- Small boxes (Stat box) -->



          <!-- /.row -->



          <!-- Main row -->



          <div class="row">



          	<div class="box-body">



          		<div class="box box-success">



                



                <div class="box-body">



                <form method="post" enctype="multipart/form-data"



 name="banner_form" id="banner-form" action="banner_validation">



                  	<div class="row">



                		<div class='error-msg' id='validationSummary' style="display:none !important;"></div>



              <div class="clearfix"></div>



                   	 	<div class="col-md-6 col-md-offset-3 col-xs-12">



                    		<div class="form-group">



                    			<label>



                            		 Select Banner 1 <img src="../banner/<?php echo $row['banner1'];?>" style="max-width:200px; margin-left:50px;">



                            	</label>



                            	<input type="file" class="form-control" name="banner1">



                            </div>



                            <div class="form-group">



                    			<label>



                            		 Select Banner 2 <img src="../banner/<?php echo $row['banner2'];?>" style="max-width:200px; margin-left:50px;">



                            	</label>



                            	<input type="file" class="form-control" name="banner2">



                            </div>



                            



                            <div class="form-group">



                    			<label>



                            		 Select Banner 3 <img src="../banner/<?php echo $row['banner3'];?>" style="max-width:200px; margin-left:50px;">



                            	</label>



                            	<input type="file" class="form-control" name="banner3">



                            </div>



                            



                        </div>



                        



                    	<div class="col-xs-12 text-center">



                    		<div class="form-group">



                            <input type="submit" name="updatebanner" class="btn btn-danger btn-flat" value="Submit">



                             <input type="reset"  class="btn btn-danger btn-flat" value="Cancel">



                        		<input type="hidden" name="old_banner1" value="<?php echo $row['banner1']; ?>" >



                                <input type="hidden" name="old_banner2" value="<?php echo $row['banner2']; ?>">



                                <input type="hidden" name="old_banner3" value="<?php echo $row['banner3']; ?>">



                                <input type="hidden" name="action" value="UPDATE"/>



                         	</div>



                        </div>



                 	</div>



                 </form>



                 



                 <div class="alert alert-info alert-dismissable">



                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>



               



                <i class="icon fa fa-info"></i>



                Only JPEG, JPG, GIF, PNG types are accepted. 2 MB maximum size.



                



                



                </div>   



                </div>



                



              </div>



              </div>



          	<!-- right col -->



          </div><!-- /.row (main row) -->







        </section><!-- /.content -->



      </div>



      <!-- /.content-wrapper -->



      <?php include "page-part/footer.php"; ?>



    </div><!-- ./wrapper -->







    <!-- jQuery 2.1.3 -->



    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>



    <!-- jQuery UI 1.11.2 -->



    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>



    



    



    <script type="text/javascript" src="js/util/location.js"></script>



	<script type="text/javascript" src="js/util/jquery.form.js"></script>







     <script type="text/javascript" src="./js/util/location-validation.js"></script>



<script type="text/javascript">







		bannerform();







	</script>



     



    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



    <script>



      $.widget.bridge('uibutton', $.ui.button);



    </script>



    <!-- Bootstrap 3.3.2 JS -->



    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    



    <!-- AdminLTE App -->



    <script src="dist/js/app.min.js" type="text/javascript"></script>



    



    <!--jquery for left menu active class-->



    <script type="text/javascript" src="dist/js/general.js"></script>



	<script type="text/javascript" src="dist/js/cookieapi.js"></script>



    <script type="text/javascript">



        setPageContext("site-settings","sitebanner");



    </script>	



    <!--jquery for left menu active class end-->



     







   



  </body>



</html>