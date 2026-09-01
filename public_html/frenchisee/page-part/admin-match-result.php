<?php



$today1 = strtotime ('now');



$today=date("Y-m-d",$today1);



?>



<div class="col-lg-12 col-xs-12 col-md-12 neAdminResult">



<form action="" method="post" class="form-data" id="action_form">



                    	<div class="row">



                        	<div class="col-lg-2 col-xs-2 col-md-1 neMrgAbottom10 neMrgATop10">



                                 <input type="hidden" name="action" value="SEND">



                                 <input type="checkbox" name="index_id[]" id="Item <?php  echo $Row->index_id;?>" class="second" value="<?php  echo $Row->index_id;?>"/> 



                                



                                <label for="Item <?php  echo $Row->index_id;?>" class="label2">&nbsp;



    



    	 <input type="hidden" name="email[]" value="<?php echo $Row->email; ?>" />



         <input type="hidden" name="my_id" value="<?php echo  $_SESSION['mem_email']; ?>" />



    </label>				



   



                            </div>


							<div class="<?php if($Row->fstatus=='Featured'){ echo "col-lg-6"; }else{ echo "col-lg-7";}?> col-xs-10 col-md-5">
                            <h3 class="">



                               <?php echo $Row->username;?><small>(&nbsp;&nbsp; <?php echo $Row->matri_id;?>&nbsp;&nbsp;)</small>



                               <?php if(isset($_SESSION['m_status']) && $_SESSION['m_status']=='match')



									 { ?>



                                     



                              <small><a href="new-match-to-member?email=<?php echo $Row->email; ?>" class="btn btn-info btn-sm text-danger"  target="_blank"><?php echo $sm; ?> match found</a></small>



                           		<?php	} ?>







                            </h3>

							<?php

								$check_alive=$DatabaseCo->dbLink->query("select sent_on from matches_list where my_id='". $_SESSION['mem_email']."' and other_id=".$Row->index_id);

								if(isset($check_alive) && mysqli_num_rows($check_alive)==0)
								{
								?>
									<span style="color:red;  text-align:center; " ><b>This profile have not been sent yet</b></span>&nbsp;&nbsp;
								<?php 
								}
								else
								{
									$fetch=mysqli_fetch_array($check_alive) 
								?>
								<ul>



									<ol class="inlineEdit" id="<?php echo $Row->index_id; ?>" style="float:right; width:120px; color:white;">



									<span><?php echo $fetch['sent_on']; ?></span></ol>           



									</ul>
									<p style="color:green; width:auto; " ><b>Already sent on <?php $ao=$fetch['sent_on'];echo date('F j, Y', (strtotime($ao)));?></b></p>
								<?php	 

								}
								?>

                            </div>



                            <ul class="<?php if($Row->fstatus=='Featured'){ echo "col-lg-4"; }else{ echo "col-lg-3";}?> col-lg-4 col-xs-12 col-md-6 topRightDetail">



                                <?php if($Row->fstatus=='Featured'){?>



                                <li class="col-lg-5 col-xs-4 text-center">



                                    <i class="fa fa-star"></i><span class="hidden-xs">Featured</span>



                                </li>



                                <?php }?>



                                <?php if($Row->status=='Paid'){?>



                                <li class="col-lg-5 col-xs-4 text-center">



                                   <i class="fa fa-money"></i><span class="hidden-xs"> Paid</span>



                                </li>



                                <?php }elseif($Row->status=='Active'){?>



                                <li class="col-lg-7 col-xs-4 text-center">



                                    <i class="fa fa-thumbs-up"></i><span class="hidden-xs"> Approved</span>



                                </li>



                                <?php }elseif($Row->status=='Inactive'){?>



                                <li class="col-lg-8 col-xs-4 text-center">



                                    <i class="fa fa-thumbs-down text-danger"></i><span class="hidden-xs"> Unapproved</span>



                                </li>



                                <?php }elseif($Row->status=='Suspended'){?>



                                <li class="col-lg-8 col-xs-4 text-center">



                                    <i class="fa fa-user-times text-danger"></i><span class="hidden-xs"> Suspended</span>



                                </li>



                                <?php }?>



                                



                            </ul>



                            



                            <div class="clearfix"></div>

							<div class="col-lg-1 col-xs-12 col-sm-6 col-md-1">



                            	<div class="row">



                                	<ul class="nav nav-tabs nav-stacked text-center">



                                    	<li>



                                        	<a title="Mobile Approval">



                                            	<i class="fa fa-phone fa-fw <?php if($Row->contact_view_security=='0'){ echo "text-danger";}?>"></i>



                                            </a>



                                        </li>



                                        <li>



                                        	<a title="Profile Photo Approval">



                                            	<i class="fa fa-picture-o <?php if($Row->photo1_approve=='UNAPPROVED'){ echo "text-danger";}?>"></i>



                                            </a>



                                        </li>



                                        <li>



                                        	<a title="Email Approval">



                                            	<i class="fa fa-envelope <?php if($Row->cpass_status!='yes' && $Row->status=='Inactive'){ echo "text-danger";}?>"></i>



                                            </a>



                                        </li>



                                        <li>



                                        	<a title="Horoscope Approval">



                                            	<i class="fa fa-fire fa-fw <?php if($Row->hor_check=='UNAPPROVED' && $Row->hor_photo!=''){ echo "text-danger";}?>"></i>



                                            </a>



                                        </li>



                                        



                                    </ul>



                                </div>



                            </div>


                        	<div class="col-lg-2 col-xs-12 col-sm-6 col-md-3 imgPaddingRightZero">



                            <?php



			if($Row->photo1=='' && !file_exists("../my_photos/".$Row->photo1.""))



			{



				?>



          <img src="../img/photo-default.png" alt="User Image" height="150" width="130" border="1" />



          <?php



		  }else



          {?>



           <img src="../my_photos/watermark.php?image=<?php echo $Row->photo1; ?>&watermark=watermark.png" alt="User Image" height="150" width="130" />



           <?php



          }



          ?>



                            



                            	<!--<img src="dist/img/user7-128x128.jpg" class="img-responsive">-->



                            </div>



                            


                            <div class="col-lg-9 col-xs-12 neMrgATop10 col-md-8 PaddingLftRigZero-xs">

								<div class="col-lg-6 col-xs-12 neAdminResultDetail">

                            		<div class="col-lg-5 col-xs-5">

                                		Email :

                                	</div>

                                	<div class="col-lg-7 col-xs-7 text-green">

                                		<?php echo $Row->email;?>

                                	</div>

                            	</div>
								
								<div class="col-lg-6 col-xs-12 neAdminResultDetail">

                            		<div class="col-lg-5 col-xs-5">

                                		Gender :

                                	</div>

                                	<div class="col-lg-7 col-xs-7 text-green">

                                		<?php echo $Row->gender;?>

                                	</div>

                            	</div>

                            	<div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Country :



                                	</div>



                                	<div class="col-lg-7 col-xs-7 text-red">



                                		<?php echo $Row->country_name;?>



                                	</div>



                            	</div>



                                <div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Mother tongue :



                                	</div>



                                	<div class="col-lg-7 col-xs-7">

                                        <?php

                $a=mysqli_fetch_array(mysqli_query($DatabaseCo->dbLink,"SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS my_language FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id, a.m_tongue ) >0 WHERE a.index_id = '".$Row->index_id."'  GROUP BY a.m_tongue"));

                echo $a['my_language'];?>

                                		<?php //echo $Row->mtongue_name;?>



                                	</div>



                            	</div>



                                <div class="col-lg-6 col-xs-12  neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Age



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                		<?php echo floor((time() - strtotime($Row->birthdate))/31556926); ?> Years



                                	</div>



                            	</div>



                            	<div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Education:



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                		<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '".$Row->matri_id."'  GROUP BY a.edu_detail"));

                                                echo $a['edu_name']; ?>




                                	</div>



                            	</div>



                            	<div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Height



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                		 <?php $ao2 = $Row->height;$ft2= (int) ($ao2/12);$inch2 = $ao2 % 12;echo $ft2."ft". " ".$inch2."in";?>



                                	</div>



                            	</div>



                                



                                <div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Location :



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                		<?php echo $Row->city_name;?>,<?php echo $Row->state_name;?>,<?php echo $Row->country_name;?>



                                	</div>



                            	</div>



                                <div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Religion :



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                    	<?php echo $Row->religion_name;?>



                                	</div>



                            	</div>



                                <div class="col-lg-6 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-5 col-xs-5">



                                		Caste :



                                	</div>



                                	<div class="col-lg-7 col-xs-7">



                                    	<?php echo $Row->caste_name;?>



                                	</div>



                            	</div>



                                



                                <div class="col-lg-12 col-xs-12 neAdminResultDetail">



                            		<div class="col-lg-2 col-xs-5">



                                		About Me: 



                                	</div>



                                	<div class="col-lg-10 col-xs-7">



                                    	<ul>



                                        	<li>



                                            	<?php if($Row->profile_text!=''){echo substr($Row->profile_text,0,200);}else{echo "N/A";}?>



                                            </li>



                                        </ul>



                                	</div>



                            	</div>



                                <?php 



								if(isset($_GET['member_status']))



  										{



    									$member_status = $_GET['member_status'];



   										



 										 }



  ?>



  									<?php 



									if($member_status=='Active')



									{ ?>



								



                            



 						             <div class="col-lg-3 col-sm-6 pull-right">



<a class="btn btn-info btn-flat  btn-block add-details"  href="javascript:;"  onClick="approveaspaid('<?php echo $Row->matri_id;?>')" data-toggle="modal" data-target="#modal-14">



Approve As Paid



	</a>



    </div>               



    					     <?php }



							 



	                              else if(isset($Row->exp_date) && $Row->exp_date<$today)



							         { ?>



                                     <div class="col-lg-3 col-sm-6 pull-right">



<a class="btn btn-info btn-flat  btn-block add-details"  href="javascript:;"  onClick="approveaspaid('<?php echo $Row->matri_id;?>')" data-toggle="modal" data-target="#modal-14">



Renew Membership



	</a>



    </div>



 							         <?php }



									 else if(isset($_REQUEST['plan_status']) && $_REQUEST['plan_status']=='Edit' && $member_status=='Paid')



									 { ?>



										 <div class="col-lg-3 col-sm-6 pull-right">



<a class="btn btn-info btn-flat  btn-block add-details"  href="javascript:;"  onClick="editplan('<?php echo $Row->matri_id;?>')" data-toggle="modal" data-target="#modal-14">



Edit Plan



	</a>



    </div>					  <?php }



									                             



									else



									{



									 ?>



								



                                <div class="col-lg-2 col-xs-6 pull-right">



                                	<a class="btn btn-info btn-flat  btn-block" href="memberFullProfile?email=<?php echo $Row->email;?>">



                                		View Profile



                               		</a>



                                </div>



                                <div class="col-lg-2 col-xs-6 pull-right">



                            		<a class="btn btn-danger btn-flat  btn-block" href="editprofile?matri_id=<?php echo $Row->matri_id;?>">



                                		Edit Profile 



                               		</a>



                                </div>



                                <?php } ?>



								



                                



	



                             </div>



                         </div>



                         <input type="hidden" value="<?php echo $sm; ?>" name="count" id="count">



                         </form>



                    </div>