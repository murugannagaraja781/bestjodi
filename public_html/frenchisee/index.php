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
		$username = isset($_POST['username'])?$_POST['username']:"";
		$password = md5($salt.$_POST['password']);
		if(isset($_POST['keep_login'])){
			setcookie("username", $username, time() + (86400 * 30), "/");
			setcookie("password", $_POST['password'], time() + (86400 * 30), "/");
		}else{				
			unset($_COOKIE['username']);
			setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
			unset($_COOKIE['password']);
 			setcookie('password', '', time() - 3600, '/'); // empty value and old timestamp
		}
		$SQL_STATEMENT = "select * from franchies where email='".$username."' and password='".$password."' AND status!='UNAPPROVED'";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		$statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
		if($statusObj->getActionSuccess()){
			$_SESSION['franchies_email'] = $DatabaseCo->dbRow->email;
			$_SESSION['franchies_user_id'] = $DatabaseCo->dbRow->id;
			echo "<script>window.location='members';</script>";
			exit();
		}else{
			$STATUS_MESSAGE = "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i>Invalid login</p>";
		}
	}
	if(isset($_GET['option'])){
		if($_GET['option']=="logout"){
			unset($_SESSION['franchies_user_name']);
			unset($_SESSION['franchies_user_id']);
			unset($_SESSION['franchies_email']);
			$STATUS_MESSAGE = "<p class='alert alert-info'><i class='fa fa-info-circle fa-fw fa-lg'></i>You are successfully loggged out.</p>";
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Dashboard | Log in - Frenchisee</title>
    

     <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link href="../css/validate.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END-->
  </head>
  <body class="login-page">
    <div class="login-box">
      
      <!-- /.login-logo -->
      <div class="login-box-body">
        
        <div class="login-logo">
        <a href="index">
          <b>Franchisee
          </b> Panel
        </a>
      </div>
      <p class="login-box-msg"> 
          <?php
if(!empty($STATUS_MESSAGE))
{         
echo  $STATUS_MESSAGE;
}
else
{
?>Sign in to start your session   
          <?php } ?>
        </p>
        <form action="" method="post" id="login_form">
          <div class="form-group has-feedback">
            <input name="username" type="text" class="form-control" placeholder="Username" data-validetta="required" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback">
            </span>
          </div>
          <div class="form-group has-feedback">
            <input name="password"  type="password" class="form-control" placeholder="Password" data-validetta="required" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback">
            </span>
          </div>
          <div class="row">
            <div class="col-xs-6">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" class="" name="keep_login" 
                         <?php if(isset($_COOKIE['password']) || isset($_COOKIE['username'])) { echo "checked";}?>> &nbsp;&nbsp;Remember Me
                </label>
              </div>                        
            </div>
            <!-- /.col -->
            <div class="col-xs-6 col-xs-6 pt-10 text-right gtForgotLink">
               <a href="forgot_password">Forgot Password?</a>
            </div>
            <!-- /.col -->
            <div class="col-xs-12 mt-10">
              <button type="submit" class="btn btn-green btn-block btn-flat btn-lg">Sign In
              </button>
            </div>
            <div class="col-xs-12 text-center mt-10">
              <h5 class="mb-5">Not Yet Sign Up?</h5>
              <h4 class="mt-0">
                <a href="register" class="">Sign Up
              </a>
            </div>
          </div>

        </form>
        
        <!-- /.social-auth-links -->
       
        
        </a>
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
      $(function(){
        $('#login_form').validetta({
          errorClose : false,
          realTime : true
        }
                                  );
      }
       );
    </script>
  </body>
</html>
