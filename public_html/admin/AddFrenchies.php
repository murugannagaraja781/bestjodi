<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();

$franchies_status = "";
if(isset($_GET['franchies_status'])){
$franchies_status = $_GET['franchies_status'];
$_SESSION['franchies_status'] = $_GET['franchies_status'];
}
else if(isset($_GET['page']))
{
$franchies_status = $_SESSION['franchies_status'];
}
else
{
$_SESSION['franchies_status'] = "all";
$franchies_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['id']) && is_array($_POST['id']))
{
$id_arr = $_POST['id'];
$id_val = "(";
foreach($id_arr as $id)
{
$id_val .=  $id.",";
}
$id_val = substr($id_val, 0, -1);
$id_val .=")";
switch($ACTION)
{
case 'DELETE':    
$SQL_STATEMENT =  "delete from franchies where id in ".$id_val; 
break;
case 'APPROVED':
$SQL_STATEMENT =  "update  franchies set status='APPROVED' where id in ".$id_val; 
break;
case 'UNAPPROVED':
$SQL_STATEMENT =  "update  franchies set status='UNAPPROVED' where id in ".$id_val; 
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
}
else
{
$statusObj = new Status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";    
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Manage Franchies
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->   
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- IONICONS -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- IONICONS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>
    <script type="text/javascript" src="js/util/redirection.js">
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
          <h1 class="lightGrey">
                  Add Franchise
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li>Add New
            </li>
            <li class="active">Franchise
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="box-top updateSite">
               	<div class="row">
                <div class="col-lg-3 col-xs-12 col-sm-4"> 
                  <a href="AddFrenchies?franchies_status=all" class="btn btn-default btn-lg btn-block"> 
                    <i class="fa fa-list">
                    </i>All Franchise <span class="badge">
					  <?php echo getRowCount("select count(id) from  franchies",$DatabaseCo);?></span> 
                  </a> 
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4"> 
                  <a href="AddFrenchies?franchies_status=approved" class="btn btn-success btn-lg btn-block"> 
                    <i class="fa fa-thumbs-up">
                    </i>Approved Franchies <span class="badge">
                    <?php echo getRowCount("select count(id) from  franchies where status='APPROVED'",$DatabaseCo);?></span>
                  </a> 
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4"> 
                  <a href="AddFrenchies?franchies_status=unapproved" class="btn btn-success btn-lg btn-block"> 
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved Franchise <span class="badge">
                    <?php echo getRowCount("select count(id) from franchies where status='UNAPPROVED'",$DatabaseCo);?></span>
                  </a> 
                </div>
              </div>
              </div>
              <?php
if(!empty($STATUS_MESSAGE))
{ 
if($statusObj->getActionSuccess())
{
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
}
else
{
echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";   
}
}
?>
            </div>
            
            <?php
$main_menu_count = getRowCount("select count(id) from franchies".getWhereClauseForStatus($franchies_status),$DatabaseCo);
if($main_menu_count>0)
{  
$SQL_STATEMENT =  "SELECT * FROM franchies ".getWhereClauseForStatus($franchies_status)." ORDER BY id DESC";
?>
            <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
              <div class="box-top clearfix">
               	<div class="col-lg-1 col-sm-2">
                        	<input type="checkbox" name="check" id="selectall" class="second">
                            <label for="selectall" class="label2">&nbsp;</label>
                        </div>
                <div class="col-lg-2 col-xs-12 col-sm-4"> 
                  <a href="javascript:;" class="btn btn-danger btn-lg col-xs-12" onclick="submitActionForm('DELETE');"> 
                    <i class="fa fa-trash">
                    </i> Delete 
                  </a> 
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-4"> 
                  <a href="javascript:;" class="btn btn-success btn-lg col-xs-12" onclick="submitActionForm('APPROVED');"> 
                    <i class="fa fa-thumbs-up">
                    </i>Approve 
                  </a> 
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-4"> 
                  <a href="javascript:;" class="btn btn-warning btn-lg col-xs-12" onclick="submitActionForm('UNAPPROVED');"> 
                    <i class="fa fa-thumbs-down">
                    </i>Unapprove 
                  </a> 
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-4"> 
                  <a href="../frenchisee" target="_blank" class="btn btn-warning btn-lg col-xs-12" > 
                    <i class="fa fa-lock">
                    </i>Login Franchies 
                  </a> 
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-4"> 
                  <a href="../frenchisee/register" target="_blank" class="btn btn-warning btn-lg col-xs-12" > 
                    <i class="fa fa-lock">
                    </i>Register Franchies 
                  </a> 
                </div>
              </div>
            </div>
            <div class="col-xs-12 mt-10"> 
              <!-- /.box -->
              <div class="box">
               	<div class="box-header">
                   <h4 class=""><?php echo strtoupper($franchies_status);?> FRANCHISEE LIST</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="AddFrenchies" id="action_form">
                   	<div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                            <input type="checkbox" name="check" id="selectall" class="second" />
                            <label for="selectall" class="label2">&nbsp;
                            </label>
                          </th>
                          <th>Status
                          </th>
                          <th>Edit
                          </th>
                          <th>Name
                          </th>
                          <th>Email Id
                          </th>
                          <th>Mobile 
                          </th>
                          <th>Address
                          </th> 
                          <th>Pincode
                          </th>
                           <th>No of profile
                          </th> 
                          <th>Paid profile
                          </th>
                          <th>View all profile
                          </th>
                          <th>Commission
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
                            <input type="checkbox" name="id[]" id="Item <?php  echo $DatabaseCo->dbRow->id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->id;?>"/>
                            <label for="Item <?php  echo $DatabaseCo->dbRow->id;?>" class="label2">&nbsp;
                            </label>
                          </td>
                          <?php
							$likeDisLikeCss = "";
							if($DatabaseCo->dbRow->status=="APPROVED")
							$likeDisLikeCss = "fa-thumbs-up";
							else
							$likeDisLikeCss = "fa-thumbs-down";
							?>
                          <td class="updateSiteApprovalStatus ">
                            <i class="fa <?php echo $likeDisLikeCss;?>">
                            </i>
                          </td>
                          <td>
                            <a href="usereditprofile?franchies_id=<?php echo $DatabaseCo->dbRow->id;?>" class="btn btn-default btn-sm md-trigger edit-popup">
                              <i class="fa fa-edit">
                              </i>&nbsp;&nbsp;Edit
                            </a>
                          </td>
                          <td>
                            <?php  echo $DatabaseCo->dbRow->first_name ." ". $DatabaseCo->dbRow->last_name;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->email;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->mobile;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->address_1 .",". $DatabaseCo->dbRow->address_2 .",". $DatabaseCo->dbRow->country .",".$DatabaseCo->dbRow->state .",". $DatabaseCo->dbRow->city;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->pincode;?>
                          </td>
                          <td>
                           <?php
							$frenchise_id=$DatabaseCo->dbRow->id;
							$profile_fet = $DatabaseCo->dbLink->query("select * from register where franchies_id='$frenchise_id'");
						    $row1=mysqli_num_rows($profile_fet);
							echo $row1;
			  				?>
                            
                          </td>
                          <td>
                            <?php
							
							$paid_fet = $DatabaseCo->dbLink->query("select * from register where franchies_id='$frenchise_id' AND status='Paid'");
						    $row2=mysqli_num_rows($paid_fet);
							echo $row2;
			  				?>
                          </td>
                          <td>
                            <a href="frenchisee_reg_profile.php?franchies_id=<?php echo $DatabaseCo->dbRow->id; ?>">View </a>
                          </td>
                          <td>
                             <?php echo $DatabaseCo->dbRow->commission;?>%
                          </td>
                        </tr>
                        <?php
}
?>
                      </tbody>
                    </table>
                    </div>
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
 <div class="col-xs-12 mt-10">
  
   <div class="nodata-avail">
     
      <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
   
   </div>
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
      setPageContext("frenchisee","Addfrenchisee");
    </script> 
    <!--jquery for left menu active class end--> 
    <!-- DATA TABES SCRIPT --> 
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script> 
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script> 
    <!-- SlimScroll --> 
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">
    </script> 
    <!-- FastClick --> 
    <script src='plugins/fastclick/fastclick.min.js'>
    </script> 
    <!-- AdminLTE App --> 
    <script src="dist/js/app.min.js" type="text/javascript">
    </script> 
    <!--3D Slit effect pop js--> 
    <script src="js/classie.js">
    </script> 
    <script src="js/modalEffects.js">
    </script> 
    <!--ends--> 
    <!-- page script --> 
    <script type="text/javascript">
      $(function () {
        var refreshRequired = false;
        $("input[name=id]").click(function(){
          $("#selectall").prop("checked", false);
        }
                                 );
        // js for Check/Uncheck all CheckBoxes by Checkbox     // 
        $("#selectall").click(function(){
          $(".second").prop("checked",$("#selectall").prop("checked"))
        }
                             ) 
       
       
        
                                  );
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
<style type="text/css">
  .modal-open {
    padding-right: 0px !important;
    overflow: visible !important;
  }
  .md-show {
    padding-right: 0px !important;
  }
</style>
