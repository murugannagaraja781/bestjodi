<?php
 include_once '../databaseConn.php';
 include_once '../class/Config.class.php';
 $configObj = new Config();
 include_once './lib/requestHandler.php';
 $DatabaseCo = new DatabaseConn();
 include_once '../class/Config.class.php';
 $configObj = new Config();
 $DatabaseCoCount = new DatabaseConn();
$frenchise_id=$_SESSION['franchies_user_id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Frenchisee | Payment Request Pending</title>
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
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
</head>
<body class="skin-blue">
	<!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
	<div class="wrapper" style="display:none" id="body">
    <!-- HEADER & LEFT MENU BAR -->
	<?php include "page-part/header.php"; ?> 
	<?php include "page-part/left_panel.php"; ?>
	<!-- HEADER & LEFT MENU BAR END-->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1 class="lightGrey">Payment Request Pending</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Payment Request Pending</li>
			</ol>
		</section>
		<!-- /.content -->
		<section class="content">
          <div class="row">
            <div class="col-xs-12 mt-10"> 
              <!-- /.box -->
              <div class="box">
               	
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="AddFrenchies" id="action_form">
                   	<div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Status
                          </th>
                          <th>Amount
                          </th>
                          <th>Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                        $commision1 = $DatabaseCo->dbLink->query("select * from frenchise_commision where frenchise_id='$frenchise_id' AND status='PENDING'");
						  	while($row = mysqli_fetch_array($commision1)){
						?>
                        <tr>
                          
                            
                          <td class="updateSiteApprovalStatus">
                            <?php
							
							if($row['status'] == 'APPROVED'){
								echo "<i class='fa fa-thumbs-up'></i> Approved";
							}elseif($row['status'] == 'UNAPPROVED'){
								echo "<i class='fa fa-thumbs-down'></i> Unapproved";
							}else{
								echo "<i class='fa fa-clock-o'></i> Pending";
							}
							?>
                          </td>
                         
                          <td>
                            <?php echo $row['amount'];?>
                          </td>
                          <td>
                            <?php echo $row['date'];?>
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
            
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </section>
		<!-- /.content-wrapper -->
      </div>
		<?php include "page-part/footer.php"; ?>
	<!-- ./wrapper -->
 </div>
    
	<!-- jQuery 2.1.3 -->
	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
	<!-- jQuery UI 1.11.2 -->
	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>     
	
	
	<!-- Slimscroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- FastClick -->
	<script src='plugins/fastclick/fastclick.min.js'></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js" type="text/javascript"></script>
	<!--jquery for left menu active class-->
	<script type="text/javascript" src="dist/js/general.js"></script>
	<script type="text/javascript" src="dist/js/cookieapi.js"></script>
	<script type="text/javascript">
		setPageContext("payment","payment_pending");
	</script>
    
</body>
</html>