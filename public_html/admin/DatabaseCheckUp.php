<?php  
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$id = isset($_GET['id']) ? $_GET['id'] :"" ;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage |  Database Checkup
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
    <link rel="stylesheet" href="../css/validate.css">
  </head>
  <body class="skin-blue">
   <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
  <div class="wrapper" style="display:none" id="body">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="lightGrey">
            Manage database 
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> Check database 
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 col-xs-12 mt-10">
              <div class="box box-success">
                <div class="box-header with-border">
                	<h4>Database Checkup</h4>
                </div>
                <?php
if(!empty($STATUS_MESSAGE))
{	
if($save)
{
echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
echo "<div class='error-msg' id='validationSummary'></div>";							
}
else
{
echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
}
}
else
{
echo "<div class='error-msg' id='validationSummary'></div>";						
}
?>	
                <?php
$success= isset($_GET['success']) ? $_GET['success'] :"" ;
if(!empty($success))
{
echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
}
?>   
                <div class="row">
                  <div class="box-body gtNewMemPlan">
                    <form action="sql_dbresult" enctype="multipart/form-data" method="post" class="form-data" id="add_form">
                      <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                          <label>
                            Type your MySQL query : 
                          </label>
                          <textarea class="form-control textarea" name="query"  id="query" data-validetta="required" style="height:200px;"></textarea>
                        </div>
                        <div class="col-xs-12">
                          <div class="col-md-3 col-md-offset-5 col-sm-6 col-xs-12 form-group">
                            <input type="submit"  class="btn btn-green btn-lg" value="Add" name="add_advertise" title="Add"/>
                            <input type="reset" class="btn btn-danger btn-lg" value="Cancel" title="Cancel"/>
                          </div>
                         </div>
                      </div>
                   </form> 
                     
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include "page-part/footer.php"; ?>
    </div>
    <!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>    
    <!-- Morris.js charts -->
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      // setPageContext("site-settings","site");
    </script>
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <!---------------Jquery Form validation------------------>
    <script src="../js/validetta.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      $(function(){
        $('#add_form').validetta({
          errorClose : false,
          custom : {
            regname : {
              pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
              errorMessage : 'Custom Reg Error Message !'
            }
            ,
            // you can add more
            example : {
              pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
              errorMessage : 'Lan mal !'
            }
          }
          ,
          realTime : true
        }
                                );
      }
       );
    </script>
    <!---------------Jquery Form validation End------------------>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js">
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("database","impdata");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
  </body>
</html>
