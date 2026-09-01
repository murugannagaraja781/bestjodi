<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$user_id=$_SESSION['franchies_email'];
$salt='%^&$#@*!';
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{      
if(isset($_REQUEST['submit_form1']))
{
$firstname = isset($_POST['firstname'])?$_POST['firstname']:"";
$lastname = isset($_POST['lastname'])?$_POST['lastname']:"";
$mobile = isset($_POST['mobile'])?$_POST['mobile']:"";
$email = isset($_POST['email'])?$_POST['email']:"";
$password = md5($salt.$_POST['password']);
$company = isset($_POST['company'])?$_POST['company']:"";
$address1 = isset($_POST['address1'])?$_POST['address1']:"";
$address2 = isset($_POST['address2'])?$_POST['address2']:"";
$country = isset($_POST['country'])?$_POST['country']:"";
$state = isset($_POST['state'])?$_POST['state']:"";
$city = isset($_POST['city'])?$_POST['city']:"";
$pincode = isset($_POST['pincode'])?$_POST['pincode']:"";
if($password!='')
{									
$pass=",password='".md5($salt.$_POST['password'])."'";	
}
else
{
$pass='';	
}			
if(isset($user_id) && $user_id!='')
{
$SQL_STATEMENT="update franchies set first_name='$firstname',last_name='$lastname',mobile='$mobile',email='$email',password='$password',company='$company',address_1='$address1',address_2='$address2',country='$country',state='$state',city='$city',pincode='$pincode' where id='$user_id'";
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
}			
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$status_MESSAGE = "Please select value to complete action.";	  
} 
$sql=$DatabaseCo->dbLink->query("select * from franchies where email='$user_id'");
$row=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Edit Profile
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
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
        <!-- MODAL CSS -->
        <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
        <!-- MODAL CSS END-->
  
    <!-- iCheck -->
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
    <!-------------------chosen css ------------------>
    <link rel="stylesheet" href="../css/chosen.css">
    <link rel="stylesheet" href="../css/prism.css">
    <!-------------------chosen css end------------------>
    <!---------------Js Birth date------------------>  
      
    
    <style>
      .default {
        width: 252px !important;
      }
    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <section class="content-header">
          <h1 class="lightGrey">
            User Edit Profile
            
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Edit Profile
            </li>
          </ol>
        </section>
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="box-top">
          <div class="row">
            <div class="clearfix">
            </div>
            <?php
if(isset($_GET['status']) && $_GET['status']=="success")
{
$statusObj = new status();
$statusObj->setActionSuccess(true);
$status_MESSAGE="Member successfully Register.";	
}
if(!empty($status_MESSAGE))
{	
if($statusObj->getActionSuccess()){
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$status_MESSAGE."</div>";
}							}
?>
            <section class="content">
              <form method="post" name="user_detail" id="user_detail">
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     	 <lable>First Name
            			</lable>
            			<input name="firstname" type="text" class="form-control" placeholder="Enter First Name" data-validetta="required" value="<?php echo $row['first_name']?$row['first_name']:""; ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Mobile
                      </label>
                      <input type="text" class="form-control" placeholder="Enter Mobile" data-validetta="required" value="<?php echo $row['mobile']?$row['mobile']:""; ?>" name="mobile">
                    </div>
                    <div class="form-group">
                      <label>Password
                      </label>
                      <input type="password" class="form-control" placeholder="Enter Password"  name="password" 
                             <?php if(!isset($user_id)){?> data-validetta="required" 
                      <?php }?>>
                    </div>
                    <div class="form-group">
                      <lable>Company / Firm Name
            		  </lable>
                      <input name="company" type="text" class="form-control" placeholder="Enter Company / Firm Name" value="<?php echo $row['company']?$row['company']:""; ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>Address 2
						</lable>
						<input name="address2" type="text" class="form-control" placeholder="Enter Street Name" data-validetta="required" value="<?php echo $row['address_2']?$row['address_2']:""; ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <lable>Country
						</lable>
						<input name="country" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php echo $row['country']?$row['country']:""; ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>City
						</lable>
						<input name="city" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php echo $row['city']?$row['city']:""; ?>"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                   	<div class="form-group">
                     	 <lable>Last Name
            			</lable>
            			<input name="lastname" type="text" class="form-control" placeholder="Enter Last Name" data-validetta="required" value="<?php echo $row['last_name']; ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Email Id
                      </label>
                      <input type="email" class="form-control" placeholder="Enter Email Id" data-validetta="required,email" value="<?php echo $row['email']; ?>" name="email">
                    </div>
                    <div class="form-group">
                      <label>Confirm Password
                      </label>
                      <input type="password" class="form-control" 
                             <?php if(!isset($user_id)){?>data-validetta="required,equalTo[password]" 
                      <?php }?> placeholder="Enter Confirm Password">
                    </div>
                    <div class="form-group">
                      <lable>Address 1
					  </lable>
					  <input name="address1" type="text" class="form-control" placeholder="Enter Office or Home No" data-validetta="" value="<?php echo $row['address_1']?$row['address_1']:""; ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>State
						</lable>
						<input name="state" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php echo $row['state']?$row['state']:""; ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>Pin/Zip Code
            </lable>
            <input name="pincode" type="text" class="form-control" placeholder="Enter Pin/Zip Code" data-validetta="required" value="<?php echo $row['pincode']?$row['pincode']:""; ?>"/>
                    </div>
                  </div>
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn btn-warning btn-lg" name="submit_form1" value="Submit">
                </div>
              </form>
            </section>
            <section class="col-lg-7 col-xs-12 connectedSortable">
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 col-xs-12 connectedSortable">
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
          </div>
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
    <script type="text/javascript">  
      $(document).ready(function(e) {
        $('#dis_child').hide();
        setTimeout(function(){
          $('#success_msg').fadeOut('slow');
        }
                   , 6000);
        <?php if(isset($row['m_status']))
        {
          ?>
            check_status('<?php echo $row['m_status'];?>');
          <?php }
        ?>
      }
        );
        <!---------------Jquery Partener Caste End------------------>  
          $("#part_religion_id").on('change', function()
                                    {
            $("#CasteDivloader").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading...');
            var selectedReligion = $("#part_religion_id").val() 
            var dataString = 'religionId='+ selectedReligion;
            jQuery.ajax({
              type: "POST", // HTTP method POST or GET
              url: "../part_rel_caste", //Where to make Ajax calls
              dataType:"text", // Data type, HTML, json etc.
              data:dataString,			
              success:function(response)
              {
                $('#part_caste_id').find('option').remove().end().append(response);
                $('#part_caste_id').trigger('chosen:updated');
                $("#CasteDivloader").html('');
                var config = {
                  '.chosen-select'           : {
                  }
                  ,
                  '.chosen-select-deselect'  : {
                    allow_single_deselect:true}
                  ,
                  '.chosen-select-no-single' : {
                    disable_search_threshold:10}
                  ,
                  '.chosen-select-no-results': {
                    no_results_text:'Oops, nothing found!'}
                  ,
                  '.chosen-select-width'     : {
                    width:"95%"}
                }
                for (var selector in config)
                {
                  $(selector).chosen(config[selector]);
                }
              }
              ,			
            }
                       );
          }
                                   );
        <!---------------Jquery Partener Caste End------------------>  						
    </script>
    <script>	<!---------------Jquery Partener state,city start------------------>	 $("#part_country").change(function(e){
        $("#part_status1").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        values = 'state='+$("#part_country").chosen().val();
        $.ajax
        ({
          type: "POST",
          url: "../search_state",
          data: values,
          cache: false,
          success: function(html)
          {
            $("#part_state").html(html);
            $("#part_city").html('');
            $("#part_city").append('<option value="">Select State</option>');
            $("#part_status1").html('');
            $("#part_state").trigger("chosen:updated");
          }
        }
        );
      }
                                                                                                                  );
      $("#part_state").change(function(e){
        $("#part_status2").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        values = 'state_id='+$("#part_state").chosen().val()+'&country_id='+$("#part_country").chosen().val();
        $.ajax({
          type: "POST",
          url: "../search_city",
          data: values,
          cache: false,
          success: function(html)
          {
            $("#part_city").html(html);
            $("#part_status2").html('');
            $("#part_city").trigger("chosen:updated");
          }
        }
              );
      }
                             );
    </script>
    <!-------------------jquery get caste---------------->
    <script language="javascript" type="text/javascript">		function getXMLHTTP()	{
        //fuction to return the xml http object			var xmlhttp=false;				try			{				xmlhttp=new XMLHttpRequest();			}			catch(e)				{						try				{								xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");				}				catch(e)				{					try					{						xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");					}					catch(e1)					{						xmlhttp=false;					}				}			}							return xmlhttp;	}	function GetCaste(strURL) 	{			var req4 = getXMLHTTP();					if (req4) 			{				req4.onreadystatechange = function() 				{						if (req4.readyState == 4) 						{							if(req4.status == 200) 							{														document.getElementById('CasteDiv').innerHTML=req4.responseText;													} 							else 							{								alert("There was a problem while using XMLHTTP:\n" + req4.statusText);							}						}								}							req4.open("GET", strURL, true);				req4.send(null);			}					}	</script>
    <!-------------------jquery get caste End---------------->
    <script>
      <!-------------------jquery get state---------------->					$("#country_id").change(function()			{
        $("#status123").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax				({
          type: "POST",					url: "../ajax_country_state",					data: dataString,					cache: false,					success: function(html)					{
            $("#state123").html(html);
            $("#status123").html('');
          }
        }
                            );
      }
                                                                                                       );
      <!-------------------jquery get state End---------------->		<!-------------------jquery get city start---------------->		$("#state123").on('change',function()			{
        $("#status23").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id=$(this).val();
        var cnt_id=$("#country_id").val();
        var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
        $.ajax				({
          type: "POST",					url: "../ajax_country_state",					data: dataString,					cache: false,					success: function(html)					{
            $("#city123").html(html);
            $("#status23").html('');
          }
        }
                            );
      }
);
    </script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="js/util/location.js">
    </script>
    <script type="text/javascript" src="js/util/jquery.form.js">
    </script>
    <script type="text/javascript" src="./js/util/location-validation.js">
    </script>
    <script type="text/javascript">		imageform();
    </script>
    <script src="js/validetta.js" type="text/javascript">
    </script>
    <script type="text/javascript">    $(function(){
        $('#user_detail').validetta({
          errorClose : false,            realTime : true    	}
                                   );
        $('#other_detail').validetta({
          errorClose : false,            realTime : true    	}
                                    );
      }
                                        );
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>    
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">         setPageContext("user","user_edit");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript">
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <!--------------------------------------choosen----------------------------------->
    <script src="../js/chosen.jquery.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select'           : {
        }
        ,      '.chosen-select-deselect'  : {
          allow_single_deselect:true}
        ,      '.chosen-select-no-single' : {
          disable_search_threshold:10}
        ,      '.chosen-select-no-results': {
          no_results_text:'Oops, nothing found!'}
        ,      '.chosen-select-width'     : {
          width:"100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <!--------------------------------------choosen End ------------------------------->
  </body>
</html>
