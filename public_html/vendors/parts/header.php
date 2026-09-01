<?php
	if(isset($_POST['submit'])){
	$name=trim(ucwords($_POST['txt_name']));
	  $from=$_POST['txt_email'];	  
	  $mobile=$_POST['phone_no'];
	  $subject1=$_POST['subject'];
	  $description=$_POST['description'];
	  $to =  $configObj->getConfigTo();
	 $website=$configObj->getConfigName();
	 $webfriendlyname=$configObj->getConfigFooter();
	  $subject="Vendor signup Details";
	  
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
                           
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                   Name : ".$name.".<br/>
		Email ID : ".$from.".<br/>
		Contact No : ".$mobile.".<br/>
		Subject : ".$subject1.".<br/>
		Description : ".$description.".<br/>                                 
                                    </b></p>
                           
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'></p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

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

?>
 
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color:white">
         <?php 
		  $fetch_detail=$DatabaseCo->dbLink->query("select * from vendor_site_settings where setting_id='1'");
		  $DatabaseCo->dbRow = mysqli_fetch_object($fetch_detail); ?>
         <?php echo $DatabaseCo->dbRow->vendor_header_name; ?>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#feedback" data-toggle="modal" data-target="#feedback"><i class="gi gi-pencil gtMarginRight10"></i>Vendor Signup</a></li>
        <li><a href="<?php echo $configObj->getConfigName(); ?>"><i class="gi gi-home gtMarginRight10"></i>Go To Main</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- Modal -->
<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form id="vendor_signup" method="post" action="">
        	<h3 class="text-center gt-text-orange">
            	Vendor Signup
            </h3>
            <article class="text-center">
            	<h4 class="">	
                	Be part of us.Be provide vendor service on are website
                </h4>
                <p>Just fill form and click on send.Its too easy.!</p>
            </article>
            <div class="form-group">
            	<label>
                	Full Name
                </label>
            	<input type="text" class="form-control" placeholder="Enter Your Full Name" name="txt_name" required>
            </div>
            <div class="form-group">
            	<label>
                	Email Id
                </label>
            	<input type="email" class="form-control" placeholder="Enter Your Valid Email Id" name="txt_email" required>
            </div>
            <div class="form-group">
            	<label>
                	Contact No
                </label>
            	<input type="text" class="form-control" placeholder="Enter Your Valid Contact No" name="phone_no" required>
            </div>
            <div class="form-group">
            	<label>
                	Subject
                </label>
            	<input type="text" class="form-control" placeholder="Enter Your Subject" name="subject" required> 
            </div>
            <div class="form-group">
            	<label>
                	Message
                </label>
            	<textarea class="form-control" rows="5" name="description" required></textarea>
            </div>
            <div class="form-group text-center">
            	<input type="submit" value="SUBMIT" name="submit" class="btn btn-warning btn-lg " >
            	
            </div>	
        </form>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="thanksMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center">Thank You</h3>
        <p class="text-center">We are very glad that you join us.We will contact us soon.</p>
      </div>
      
    </div>
  </div>
</div>

<script>
$(function(){
    $('#myModal').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 2000));
    });
});
</script>

