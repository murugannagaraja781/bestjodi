<?php

	error_reporting(0);

	include_once 'databaseConn.php';

	require_once('auth.php');

	include_once './lib/requestHandler.php';

	include_once './class/Config.class.php';

	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;

	$configObj = new Config();

	$DatabaseCo = new DatabaseConn();

	

	$to = $_GET['email'];

	





						

?>




<div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title" id="myModalLabel">Photo Request</h4>

              </div>

               

              <div class="modal-body">                 

                      <div class="form-group"> 

				<form action="" method="post">

                        <table width="83%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">
                        
                        
                        <?php
                        
                         if(isset($_REQUEST['req-password']))
                        
                         {?>
                        
                           <tr>
                        
                            <td colspan="5" style="color:green;"><h5><?php if(isset($result)){ echo $result; }?></h5></td>
                        
                          </tr>
                        
                          <?php
                        
                         }
                        
                         
                        
                        else
                        
                        {?>
                        
                        
                        
                        <tr>
                        
                        <td>
                        
                        
                        
                        <tr>
                        
                        <td colspan="2">
                        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                        
                        <input type="radio" checked="checked" value="We found your profile to be a good match. Please upload Photo to proceed further." name="msg" />We found your profile to be a good match. Please upload Photo to proceed further.<br /><br />
                        
                        <input type="radio" value="I am interested in your profile. I would like to view your photo now." name="msg" />I am interested in your profile. I would like to view your photo now.
                        
                        
                        
                        </td>
                        
                        </tr>
                        
                        <tr>
                        
                        <td colspan="2" align="center" height="20">
                        
                        
                        
                        </td>
                        
                        </tr>
                        
                        
                        
                        
                        
                        <tr>
                        
                        <td colspan="2" align="center">
                        
                        <input class="btn btn-primary" type="submit" name="req-photo"  value="Send Request">
                        
                        
                        
                        
                        
                        </td>
                        
                        </tr>
                        
                       
                        
                        </td>
                        
                        </tr>
                        
                        
                        
                        
                        
                        <?php
                        
                        }
                        
                        ?>
                        
                        </table>
                         </form>  
					</div>
			</div>		
            <div class="clearfix"></div>

 				 <div class="modal-footer">

                

                <button type="button" class="btn btn-default ne-cursor" data-dismiss="modal">Close</button>

              </div>

                    

            </div>

          </div>
