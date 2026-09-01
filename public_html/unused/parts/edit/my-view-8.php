<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

	if(isset($_REQUEST['about_family']))
	{
	
		$about=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['about_family']);
	
		$DatabaseCo->dbLink->query("UPDATE register SET family_details='".$about."' where matri_id='$matri_id'");
	
				$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$matri_id'");
	
						$rowcc = mysqli_fetch_array($result3);
	
						$name = $rowcc['firstname']." ".$rowcc['lastname'];
	
						$matriid = $rowcc['matri_id'];
	
						$cpass = $rowcc['cpassword'];
	
						$website = $rowcc['web_name'];
	
						$webfriendlyname = $rowcc['web_frienly_name'];
	
						$from = $rowcc['from_email'];
	
						$to = $rowcc['email'];
	
						$name = $rowcc['username'];
	
						$subject = "You Just Updated your About My Family";	

					$message = "
                    <html>
                    <body>
                    <table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                      <tbody>
                      <tr>
                        <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
                              <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                                    <tbody>
                                            <tr style='background:#f9f9f9'>
                                            <td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
                                                            <span tabindex='0' class='aBn' data-term='goog_849968294'>

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $matriid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";

                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                    $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);	
						 
	
						 
	
	}
	

	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select family_details from register where matri_id='$matri_id'");

	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

?>
<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-star"></i>About My Family</span>
                        <a class="pull-right btn gt-btn-orange" onClick="return edit8();">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">EDIT</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<div class="row">
                        	<div class="col-xxl-16 col-xl-16 col-lg-16 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	
                                	<article>
                                    	<p>
                                        	<?php echo $DatabaseCo->dbRow->family_details;?>
                                        </p>
                                    </article>
                               
                            </div>
                        </div>
                    </div>