
<footer class="footer-before-login gt-margin-top-25">



   		<div class="container">



    		<div class="row">



            	 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">



                	<h4 class="gt-text-green">



                    	Help And Support



                    </h4>



                    <ul class="">



                    	<li>



                        	<a href="contactUs.php">



                            	Contact Us



                            </a>



                        </li>



                        <li>



                        	<a href="cms?cms_id=19">



                            	FAQ



                            </a>



                        </li>



                        <li>



                        	<a href="cms?cms_id=16">



                            	Refund policy



                            </a>



                        </li>



                    </ul>



                </div>



                <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">



                	<h4 class="gt-text-green">



                    	Terms & Policy



                    </h4>



                    <ul class="">



                    	<li>



                        	<a href="cms?cms_id=7">



                            	Terms and Conditions



                            </a>



                        </li>



                        <li>



                        	<a href="cms?cms_id=6">



                            	Privacy Policy



                            </a>



                        </li>



                        <li>



                        	<a href="cms?cms_id=15">



                            	Report Misuse



                            </a>



                        </li>



                    </ul>



                </div>



                 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">



                	<h4 class="gt-text-green">



                    	Need Help?



                    </h4>



                    <ul class="">



                    	<li>



                        	<a href="login">



                            	Login



                            </a>



                        </li>



                        <li>



                        	<a href="index">



                            	Register



                            </a>



                        </li>



                        <li>



                        	<a href="membership">



                            	Premium Membership



                            </a>



                        </li>

 <li>



                        	<a href="marryyou-admin/franchies_login">



                            	Franchies Login



                            </a>



                        </li>



                    </ul>



                </div>



                 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">



                	<h4 class="gt-text-green">



                    	Information



                    </h4>



                    <ul class="">



                    	<li>



                        	<a href="success-story">



                            	Success Story



                            </a>



                        </li>



                        



                        <li>



                        	<a href="cms?cms_id=8">



                            	About us



                            </a>



                        </li>

						<li>



                        	<a href="#feedback" data-toggle="modal" data-target="#feedback">



                            	Associate with us



                            </a>



                        </li>
                        <li>



                        	<a href="wedding-planner" >



                            	Wedding Directory



                            </a>



                        </li>

                     </ul>



                </div>
                
			</div>
          </div>
    	</div>
  </footer>
  <div class="container-fluid gt-footer-bottom">
  	<div class="row">
  		<div class="container text-center">
        	All rights reserved by @ <a href="http://marryyou.in/">Marryyou.in</a>
		</div>
    </div>
 </div>
 <?php
	if(isset($_POST['sub_contact']))
	{
	$name=trim(ucwords($_POST['txt_name']));
	  $from=$_POST['txt_email'];	  
	  $mobile=$_POST['phone_no'];
	  $subject1=$_POST['subject'];
	  $description=$_POST['description'];
	  $to =  $configObj->getConfigTo();
	 $website=$configObj->getConfigName();
	 $webfriendlyname=$configObj->getConfigFooter();
	  $subject="Associate with us";
	  
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
<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <form>
        	<h3 class="text-center gt-text-orange">
            	Associate With Us
            </h3>
            
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
            	<input type="text" class="form-control" placeholder="Enter Your Valid Email Id" name="txt_email" required>
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
                	Description
                </label>
            	<textarea class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group text-center">
            	<button type="submit" name="sub_contact" class="btn btn-warning btn-lg " data-toggle="modal" data-target="#myModal" data-dismiss="modal">
                        <i class="fa fa-paper-plane gt-margin-right-10"></i>Submit
                </button>
            </div>	
        </form>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="text-center">Thank You For Connecting</h3>
        <p class="text-center">We are very glad that you contact us we contact you soon.</p>
      </div>
      
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<!--<script>

 document.onkeydown = function(e) {

        if (e.ctrlKey && 

            (e.keyCode === 67 || 

             e.keyCode === 86 || 

             e.keyCode === 85 || 

             e.keyCode === 117)) {

           

            return false;

        } else {

            return true;

        }

};







</script>
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
<script language=JavaScript>

var message="Function Disabled!";



function clickIE4(){

if (event.button==2){



return false;

}

}



function clickNS4(e){

if (document.layers||document.getElementById&&!document.all){

if (e.which==2||e.which==3){



return false;

}

}

}



if (document.layers){

document.captureEvents(Event.MOUSEDOWN);

document.onmousedown=clickNS4;

}

else if (document.all&&!document.getElementById){

document.onmousedown=clickIE4;

}



document.oncontextmenu=new Function("return false")



</script>-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new  Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75359315-1', 'auto');
  ga('send', 'pageview');

</script>



 