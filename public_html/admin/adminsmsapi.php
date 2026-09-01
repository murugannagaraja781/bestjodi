<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Manage SMS Api
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>   
    <link rel="stylesheet" href="css/libs/select2.css"/>   
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script>
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/util/select2.min.js">
    </script>
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <script type="text/javascript" src="js/util/location.js">
    </script>
    <script type="text/javascript">
    </script>
    <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
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
            Add SMS Api
            <small>Control panel
            </small>
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New SMS Api
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
                  <a class="md-trigger btn btn-default btn-flat btn-lg btn-block add-details"  onclick="window.location='addsms_api?action=ADD'" href="javascript:;" data-modal="modal-13">
                    <i class="fa fa-plus">
                    </i>Add SMS Api
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="adminsmsapi?smsapi_status=all" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-list">
                    </i>All SMS Api(
                    <?php echo getRowCount("select count(sms_id) from sms_api",$DatabaseCo);?>)
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="adminsmsapi?smsapi_status=approved" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-thumbs-up">
                    </i>Approved SMS Api(
                    <?php echo getRowCount("select count(sms_id) from sms_api where  status='APPROVED'",$DatabaseCo);?>)
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="adminsmsapi?smsapi_status=unapproved" class="btn btn-success btn-lg btn-flat col-xs-12">
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved SMS Api(
                    <?php echo getRowCount("select count(sms_id) from sms_api where  status='UNAPPROVED'",$DatabaseCo);?>)
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
echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";   
}
?>   
              <?php
$main_menu_count = getRowCount("select count(sms_id) from sms_api".getWhereClauseForStatus($smsapi_status),$DatabaseCo);
if($main_menu_count>0)
{  
$SQL_STATEMENT =  "SELECT * FROM sms_api ".getWhereClauseForStatus($smsapi_status)." ORDER BY sms_id DESC";
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
                      <?php echo strtoupper($smsapi_status); ?> sms Templete List
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form method="post" action="adminsmsapi" id="action_form">
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
                            <th width="20%">status
                            </th>
                            <th width="30%">Basic Url
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
                              <input type="checkbox" name="sms_id[]" id="Item <?php  echo $DatabaseCo->dbRow->sms_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->sms_id;?>"/>
                              <label for="Item <?php  echo $DatabaseCo->dbRow->sms_id;?>" class="label2">&nbsp;
                              </label>  
                            </td>
                            <td>
                              <a class="btn btn-danger md-trigger" href="addsms_api?edit_sms_id=<?php  echo $DatabaseCo->dbRow->sms_id;?>"
                                 title="Edit" id="edit_smsapi">Edit
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
                              <?php  echo $DatabaseCo->dbRow->basic_url;?>
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
                  <?php echo strtoupper($smsapi_status); ?> Main Menu. Please add data.
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
          $("input[name=sms_id]").click(function(){
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
          //new $.fn.dataTable.FixedHeader($('#example1'));
        }
         );
      </script>
      </body>
    </html>