<?php	
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$salt='%^&$#@*!';
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
$STATUS_MESSAGE = "";
if($isPostBack){
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
$commision = isset($_POST['commision'])?$_POST['commision']:"";
$SQL_STATEMENT = $DatabaseCo->dbLink->query("INSERT INTO `franchies` (`id`, `first_name`, `last_name`, `mobile`, `email`, `password`, `company`, `address_1`, `address_2`, `country`, `state`, `city`, `pincode`, `status`,`commission`) VALUES (NULL, '".$firstname."', '".$lastname."', '".$mobile."', '".$email."','".$password."', '".$company."', '".$address1."', '".$address2."', '".$country."', '".$state."', '".$city."', '".$pincode."', 'UNAPPROVED','20');");
$MAX_INDEX_ID = mysqli_insert_id($DatabaseCo->dbLink); 
if($MAX_INDEX_ID)
{
$STATUS_MESSAGE = "<p class='alert alert-success'><i class='fa fa-check fa-fw fa-lg'></i>Your profile successfully registered,Login after admin approval.</p>";
//echo "<script>window.location='index';</script>";
// exit;
}
else
{
$STATUS_MESSAGE = "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i>There is a problem in registration,Please try again.</p>";
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard | Sign Up - Frenchise
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
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
    <!-------------------chosen css ------------------>
    <link rel="stylesheet" href="../css/chosen.css">
    <link rel="stylesheet" href="../css/prism.css">
    <!-------------------chosen css end------------------>
    
   
  </head>
  <body class="login-page">
    <div class="login-box" style="width: 500px;">
      <div class="login-logo">
        <a href="index">
          <b>Franchisee
          </b> Sign Up
        </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"> 
          <?php if(!empty($STATUS_MESSAGE)){					
			echo  $STATUS_MESSAGE;
			}
		  ?>
        </p>
        <form action="" method="post" id="franchies_form" name="franchies_form">
          <div class="form-group has-feedback">
            <lable>First Name
            </lable>
            <input name="firstname" type="text" class="form-control" placeholder="Enter First Name" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Last Name
            </lable>
            <input name="lastname" type="text" class="form-control" placeholder="Enter Last Name" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Mobile No
            </lable>
            <input name="mobile" type="text" class="form-control" placeholder="Enter Mobile No" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Email Id
            </lable>
            <input name="email" type="text" class="form-control" placeholder="Enter Email Id" data-validetta="required,email" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Password
            </lable>
            <input name="password"  type="password" class="form-control" placeholder="Password" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Confirm Password
            </lable>
            <input name="confirm_password"  type="password" class="form-control" placeholder="Confirm Password" data-validetta="required,equalTo[password]" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Company / Firm Name
            </lable>
            <input name="company" type="text" class="form-control" placeholder="Enter Company / Firm Name" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Address 1
            </lable>
            <input name="address1" type="text" class="form-control" placeholder="Enter Office or Home No" data-validetta="" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Address 2
            </lable>
            <input name="address2" type="text" class="form-control" placeholder="Enter Street Name" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Country
            </lable>
            <input name="country" type="text" class="form-control" placeholder="" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>State
            </lable>
            <input name="state" type="text" class="form-control" placeholder="" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>City
            </lable>
            <input name="city" type="text" class="form-control" placeholder="" data-validetta="required" value=""/>
          </div>
          <div class="form-group has-feedback">
            <lable>Pin/Zip Code
            </lable>
            <input name="pincode" type="text" class="form-control" placeholder="Enter Pin/Zip Code" data-validetta="required" value=""/>
          </div>
          
          
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-12 mb-15">
              <button type="submit" class="btn btn-success btn-block btn-flat btn-lg">Sign Up
              </button>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 text-center">
            	<h5 class="mb-5 mt-10">
            		Already Member?
            	</h5>
            	<h4 class="mt-0">
            		<a href="index.php">Sign In</a>
            	</h4>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <div class="social-auth-links text-center">
          <p>
          </p>
        </div>
        <!-- /.social-auth-links -->
        
        <br>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript">
    </script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        }
                         );
      }
       );
    </script>
    <script src="../js/validetta.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#franchies_form').validetta({
          errorClose : false,
          realTime : true, 
          /* validators: {
							 remote : {
								check_username : {
									type : 'POST',
									url : 'remote',
									datatype : 'json'
								},
							}, 
						} */
        }
                                      );
      }
                       );
    </script>
  </body>
</html>
