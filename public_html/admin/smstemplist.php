<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$sms_status = "";
if(isset($_GET['sms_status']))
{
$sms_status = $_GET['sms_status'];
$_SESSION['sms_status'] = $_GET['sms_status'];
}
else if(isset($_GET['page']))
{
$sms_status = $_SESSION['sms_status'];
}
else
{
$_SESSION['sms_status'] = "all";
$sms_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['temp_id']) && is_array($_POST['temp_id']))
{
$temp_id_arr = $_POST['temp_id'];
$temp_id_val = "(";
foreach($temp_id_arr as $temp_id)
{
$temp_id_val .= $temp_id.",";
}
$temp_id_val = substr($temp_id_val, 0, -1);
$temp_id_val .=")";
switch($ACTION)
{
case 'DELETE':    
$SQL_STATEMENT =  "delete from sms_templete where temp_id in ".$temp_id_val;  
break;
case 'APPROVED':
$SQL_STATEMENT =  "update sms_templete set status='APPROVED' where temp_id in ".$temp_id_val; 
break;
case 'UNAPPROVED':
$SQL_STATEMENT =  "update sms_templete set status='UNAPPROVED' where temp_id in ".$temp_id_val; 
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";    
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | SMS Template
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>   
    <link rel="stylesheet" href="css/libs/select2.css"/>   
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("sms","smstemp");
    </script> 
    <!--jquery for left menu active class end-->
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
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
            Add SMS Template
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New SMS Template
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
              <div class="box-top clearfix">
                <div class="col-lg-3 col-sm-4">
                  <a class="md-trigger btn btn-default btn-flat btn-lg btn-block add-details"  onclick="window.location='smstemplist" href="sms_templete" data-modal="modal-13">
                    <i class="fa fa-plus">
                    </i>Add SMS Template
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="smstemplist?sms_status=all" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-list">
                    </i>All SMS Template(
                    <?php echo getRowCount("select count(temp_id) from sms_templete",$DatabaseCo);?>)
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="smstemplist?sms_status=approved" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-thumbs-up">
                    </i>Approved SMS Template(
                    <?php echo getRowCount("select count(temp_id) from sms_templete where  status='APPROVED'",$DatabaseCo);?>)
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="smstemplist?sms_status=unapproved" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved SMS Template(
                    <?php echo getRowCount("select count(temp_id) from sms_templete where  status='UNAPPROVED'",$DatabaseCo);?>)
                  </a>
                </div>
              </div>
              <?php
if(!empty($STATUS_MESSAGE))
{ 
if($statusObj->getActionSuccess()){
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
}else{
echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";   
}
}
?>     
              <?php
$success= isset($_GET['success']) ? $_GET['success'] :"" ;
if(!empty($success))
{
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> Record is updated successfully.</div>";  
}
?>   
              <?php
$main_menu_count = getRowCount("select count(temp_id) from sms_templete".getWhereClauseForStatus($sms_status),$DatabaseCo);
if($main_menu_count>0)
{  
$SQL_STATEMENT =  "SELECT * FROM sms_templete ".getWhereClauseForStatus($sms_status)." ORDER BY temp_id DESC";
?>
              <div class="col-lg-12 col-xs-12 col-sm-12 neMrgATop10">
                <div class="box-top clearfix">
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-danger btn-lg btn-flat col-xs-12" onclick="submitActionForm('DELETE');">
                      <i class="fa fa-trash">
                      </i> Delete
                    </a>
                  </div>
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-success btn-lg btn-flat col-xs-12" onclick="submitActionForm('APPROVED');">
                      <i class="fa fa-thumbs-up">
                      </i>Approve
                    </a>
                  </div>
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-warning btn-lg btn-flat col-xs-12" onclick="submitActionForm('UNAPPROVED');">
                      <i class="fa fa-thumbs-down">
                      </i>Unapprove
                    </a>
                  </div>
                </div>
              </div>         
              <div class="col-xs-12">
                <!-- /.box -->
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">
                      <?php echo strtoupper($sms_status); ?> SMS Template List
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form method="post" action="smstemplist" id="action_form">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>
                              <input type="checkbox" name="check" id="selectall" class="second" />
                              <label for="selectall" class="label2">&nbsp;
                              </label> 
                            </th>
                            <th width="30%">Edit
                            </th>
                            <th width="20%">Status
                            </th>
                            <th width="30%">Template Name
                            </th>
                            <th width="20%">Template Content
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php           
$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
$rowCount=0;
while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult))
{   
?>
                          <tr>
                            <td>
                              <input type="checkbox" name="temp_id[]" id="Item <?php  echo $DatabaseCo->dbRow->temp_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->temp_id;?>"/>
                              <label for="Item <?php  echo $DatabaseCo->dbRow->temp_id;?>" class="label2">&nbsp;
                              </label>  
                            </td>
                            <td>
                              <a class="btn btn-danger md-trigger" href="sms_templete?id=<?php  echo $DatabaseCo->dbRow->temp_id;?>"
                                 title="Edit" id="edit_smstemplete">Edit
                              </a>
                            </td>
                            <?php
$likeDisLikeCss = "";
if($DatabaseCo->dbRow->status=="APPROVED")
$likeDisLikeCss = "fa-thumbs-up";
else
$likeDisLikeCss = "fa-thumbs-down";
?>     
                            <td>
                              <i class="fa <?php echo $likeDisLikeCss;?>">
                              </i>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->temp_name;?>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->temp_value;?>
                            </td>
                          </tr>
                          <?php
}
?>
                        </tbody>
                      </table>
                      <input  type="hidden" name="action" value="" id="action"/>
                    </form>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <?php
}
else
{
?>
              <div class="col-lg-12 col-xs-12 col-sm-12">
                <h4>There are no data for 
                  <?php echo strtoupper($sms_status); ?> Template. Please add data.
                </h4>
                <br/>
                <img src="../img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
              </div>
              <?php
}
?>   
              <!-- /.col -->
            </div>
            <!-- /.row -->
            </section>
          <!-- /.content -->
          </div>
        <!-- /.content-wrapper -->
        <?php include "page-part/footer.php"; ?>
      </div>
      <!-- ./wrapper -->
      <!-- page script -->
      <script type="text/javascript">
        $(function () {
          var refreshRequired = false;
          $("input[name=temp_id]").click(function(){
            $("#selectall").prop("checked", false);
          }
                                        );
          //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
          $("#selectall").click(function(){
            $(".second").prop("checked",$("#selectall").prop("checked"))
          }
                               ) 
          // add details //
          $('#example1').dataTable({
            "aaSorting": [  [3,'desc'] ],
            'aoColumnDefs': [{
              'bSortable': false,
              'info': true,          
              "paging":   true,
              'aTargets': [0,1,2,],
              'pageLength': 10       
            }
                            ]   
          }
                                  );
        }
         );
      </script>
      </body>
    </html>