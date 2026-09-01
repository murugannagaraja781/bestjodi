<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Frenchise Payment Approve
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
               Frenchise Payment Approved
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
            <li class="active">Franchise Payment Approved
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            
            
            <div class="col-xs-12 mt-10"> 
              <!-- /.box -->
              <div class="box">
               	<div class="box-header">
                   <h4 class="">Frenchise Payment Request Approved</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  
                   	<div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                            Frenchise Id
                          </th>
                          <th>Amout
                          </th>
                          <th>Date
                          </th>
                          <th>Status
                          </th>
                         
                          
                        </tr>
                      </thead>
                      <tbody>
                       <form action="" method="post">
                        <?php           
						 $commision1 = $DatabaseCo->dbLink->query("select * from frenchise_commision where status='APPROVED'");
							while($DatabaseCo->dbRow = mysqli_fetch_object($commision1)){   
						?>
                        <tr>
                          <td>
                            <?php echo $DatabaseCo->dbRow->frenchise_id;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->amount ; ?>
                          </td>
                          
                          <td>
                            <?php echo $DatabaseCo->dbRow->date ; ?>
                          </td>
                          <td class="updateSiteApprovalStatus">
                            <?php
							
							if($DatabaseCo->dbRow->status == 'APPROVED'){
								echo "<i class='fa fa-thumbs-up'></i> Approved";
							}elseif($DatabaseCo->dbRow->status == 'UNAPPROVED'){
								echo "<i class='fa fa-thumbs-down'></i> Unapproved";
							}else{
								echo "<i class='fa fa-clock-o'></i> Pending";
							}
							?>
                          </td>
                          
                        </tr>
                        <?php
}
?>
                     	</form>
                      </tbody>
                    </table>
                    </div>
                    
                 
                </div>
                <!-- /.box-body --> 
              </div>
              <!-- /.box --> 
            </div>
            
 
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
      setPageContext("frenchisee","franchisee-payment-request");
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
