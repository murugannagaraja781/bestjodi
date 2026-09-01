<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$strquery='';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Manage database
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <script type="text/javascript" src="js/util/location.js">
    </script>
    <script type="text/javascript">
    </script>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
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
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="box-top clearfix" style="margin-top:20px;margin-bottom: 15px;">
                <div class="col-lg-3 col-sm-4">
                  <a class="md-trigger btn btn-default btn-flat btn-lg btn-block add-details"  onclick="window.location='DatabaseCheckUp'" href="javascript:;" data-modal="modal-13">
                    <i class="fa fa-plus">
                    </i>Go Back
                  </a>
                </div>
              </div>
              <div style="overflow: auto; width:100%; height:700px; background-color:white;">
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                  <tr>
                    <td class="red_text">
                      <?php
if (empty($_POST['query'])) 
{
echo "<h4>Blank Submission. Please, Enter Mysql Query For Results</h4>";
}
else
{
$strquery = $_POST['query'];
$select = mysqli_query($DatabaseCo->dbLink,$strquery) or die ("<h4>You Entered... Invalid SQL Command.</h4>");   
echo "<table style='font-family: Verdana;font-size: 12px;border-collapse:collapse;'>";
echo "<tr bgcolor=#000000 height='25px' style='color:#ffffff;'>";
while($column = mysqli_fetch_field($select))
{
echo "<td><b>".$column->name."</b></td>";
}
echo "</tr>";
while($array = mysqli_fetch_array($select)){
echo "<tr>";
foreach($array as $column => $value){
if(!is_int($column)){
echo "<td class='green_text'>$value</td>";
}
}
?>
                      <?php 
echo "</tr>";
}
echo "</table>";
}      
?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            </section>
          <!-- /.content -->
          </div>
        <!-- /.content-wrapper -->
        <?php include "page-part/footer.php"; ?>
      </div>
      <!-- ./wrapper -->
      <!-- page script -->
      </body>
    </html>
  <style type="text/css">
    .red_text
    {
      font-family:Lucida Sans, Arial;
      font-size:14px;
      font-weight:900;
      color:#7e0000;
      text-align:center;
    }
    .h4
    {
      font-family:Lucida Sans, Arial;
      font-size:19px;
      font-weight:900;
      color:#7e0000;
    }
    td {
      border: 1px solid #cccccc;
    }
    .green_text
    {
      font-family:Lucida Sans, Arial;
      font-size:14px;
      font-weight:900;
      color:red;
    }
    tr {
      border: 1px solid #7E0000;
    }
  </style>