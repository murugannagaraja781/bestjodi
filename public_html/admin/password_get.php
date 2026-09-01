<?php
	if (session_status() === PHP_SESSION_NONE) {
		@session_start();
	}
	include_once '../databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$db = $DatabaseCo->dbLink;
        
	if(isset($_POST['submit']) and $_POST['submit']=='Log In' && $db)
	{
		$logid = mysqli_real_escape_string($db, $_POST['username']);
		$passwd = mysqli_real_escape_string($db, $_POST['password']);
				
		$sql = "select * from admin_users where uname='$logid' and pswd='$passwd'";
		$res = mysqli_query($db, $sql);
				
		if($res && $row = mysqli_fetch_array($res))
		{			
			$_SESSION['admin_user_name'] = $row['uname'];
			$_SESSION['admin_user_id'] = $row['id'];
			
			$role_id = (int)$row['role_id'];
			$sql2 = "select * from admin_role where role_id='$role_id'";
			$res2 = mysqli_query($db, $sql2);
		
			if($res2 && $row2 = mysqli_fetch_array($res2))
			{		
				$_SESSION['role']=$row2['role_name'];
				$_SESSION['add']=$row2['add_rights'];
				$_SESSION['edit']=$row2['edit_rights'];
				$_SESSION['delete']=$row2['delete_rights'];
				$_SESSION['read_only']=$row2['read_only'];
				$_SESSION['email']=$row2['email'];
				$_SESSION['profile_status']=$row2['profile_status'];
				$_SESSION['video_status']=$row2['video_status'];
				$_SESSION['chat_status']=$row2['chat_status'];
				$_SESSION['matching_status']=$row2['matching_status'];
				$_SESSION['wpstat']=$row2['wp_status'];
				$_SESSION['adv']=$row2['adv_status'];
				$_SESSION['cms']=$row2['cms_status'];
				$_SESSION['pay']=$row2['payment_status'];
				$_SESSION['mship']=$row2['mship_status'];
				$_SESSION['member']=$row2['member_status'];
				$_SESSION['users']=$row2['user_status'];
				$_SESSION['site']=$row2['site_status'];
				$_SESSION['approval']=$row2['approval_status'];
			}				
	
			echo "<script>window.location='dashboard.php';</script>";
		}
		else
		{
			?>
			<script>
				alert('Wrong Login Details.');
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Login Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
 <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.horizontal.scroll.css" />
		<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
		<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />	
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
</head>
<body id="login-body">
 	<div id="logo-wrapper">
    	<h2 class="logo">Admin Panel</h2>
    
    	<div class="login-box cf">
    		<h3 class="title">Log In</h3>
            <form action="" method="post">
             
            	<p class="error-msg-text">
            	
            	 <?php
					if(!empty($STATUS_MESSAGE))
					{	
					
							echo  $STATUS_MESSAGE;
					}
			?>
            	</p>
                <p><label  class="email-label">Email</label></p>
                <p><input type="text" class="email-desc" name="username"/></p>
                <p><label  class="email-label">Password</label></p>
                <p><input type="password" class="email-desc" name="password" /></p>
                <p><input type="submit" name="submit" value="Log In" class="login-btn"/>
                <a href="forgot.php" title="Forgot Your Password?" class="forgot-pwd">Forgot Your Password?</a>
                </p>
            </form>
    	</div>
    </div>
</body>
</html>
