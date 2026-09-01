
<li>
                            	<div class="col-xxl-2 col-xs-6 col-sm-6 col-md-8 col-lg-2 gt-margin-top-5">
                                	<input type="checkbox" class="display-inline" name="msg_id" id="msg_id" value="<?php echo $DatabaseCo->dbRow->mes_id;?>" >
                                    <a class="gt-margin-left-10 font-18 gt-cursor" onClick="importantfun(<?php echo $DatabaseCo->dbRow->mes_id;?>,<?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "'No'";}else{ echo "'Yes'";} ?>);">
                                    	<i class="fa fa-star <?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "gt-text-blue gt-margin-right-10";} ?>"></i>
                                    </a>
                                </div>
                               
                                <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&trash=1" class="col-xxl-4 col-xs-10 col-sm-10 col-md-8 col-lg-4" data-toggle="tooltip" data-placement="left" title="<?php echo $DatabaseCo->dbRow->to_id;?>" class="col-xxl-4 col-xs-10 col-sm-10 col-md-8 col-lg-4">
                                	<h4 class="name"><?php echo $DatabaseCo->dbRow->to_id;?></h4>
                                </a>
                               
                                <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&trash=1" class="col-xxl-8 col-xs-16 col-sm-16 col-md-16 col-lg-8 gt-margin-top-8" title="<?php echo $DatabaseCo->dbRow->to_id;?>">
                                	<span class="font-12"><b class="name1"><?php $data_msg=substr($DatabaseCo->dbRow->subject,0,50);
									
										if($data_msg!=''){echo $data_msg;}else{ echo "N/A";}
									?></b></span>
                                </a>
                                <div class="col-xxl-2 col-xs-16 col-sm-16 col-md-16 col-lg-2 ">
                                	<h4 class="name2"><?php echo date('d M Y', strtotime($DatabaseCo->dbRow->sent_date)); ?></h4>
                                </div>
                                
                            </li>



<?php /*?><li class="ne_inbox_msg xxl-16 xl-16 s-16 xs-16 m-16 l-16">

                            	<div class="xxl-12 xl-16 xs-16 s-16 m-16 padding-lr-zero">

 

                           	  	     <div class="ne_font_16 xxl-6 xl-6 xs-16 s-16 m-16 padding-lr-zero">

                                    	

                                        <input type="checkbox" class="table-checkbox ne_disply-inline-blk ne_mrg_ri8_5 margin-top-5px pull-left" name="msg_id" id="msg_id" value="<?php echo $DatabaseCo->dbRow->mes_id;?>" >

                						

                                        <a class="ne_inbox_msg_imp pull-left ne_mrg_ri8_5 ne-cursor" onClick="importantfun(<?php echo $DatabaseCo->dbRow->mes_id;?>,<?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "'No'";}else{ echo "'Yes'";} ?>);"> "ne_inbox_msg_imp_active"for selected star-

                                        	<i class="fa fa-star <?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "ne_inbox_msg_imp_active";} ?>"></i>

                                        </a>

                                        <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&trash=1" class="ne_font_18 pull-left" data-toggle="tooltip" data-placement="left" title="<?php echo $DatabaseCo->dbRow->to_id;?>">

                                        	<div class="padding-lr-zero ne_inbox_msg_id ne_inbox_msg_id_unreaded ne_font_11 name" >-- "ne_inbox_msg_id_readed" class for readed msg(unbold)-

                                               <?php

											   if($DatabaseCo->dbRow->trash_sender=='Yes')

											   {

											    echo $DatabaseCo->dbRow->to_id;

											   }

											   elseif($DatabaseCo->dbRow->trash_receiver=='Yes')

											   {

												echo $DatabaseCo->dbRow->from_id;   

											   }

												

												?>

                                            

                                            </div>

                                        </a>

                                    </div>

                                    

                                    <!-------------------------------for desktop------------------------------------------->

                                    <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&trash=1" class="xxl-10 xl-10 xs-16 s-16 m-16 ne_inbox_msg_content padding-lr-zero-320 margin-top-5px-320 hidden-xs">

                                		<b class="ne_mrg_ri8_5 ne_font_11 name">(&nbsp;<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->subject); ?>&nbsp;) &nbsp;</b><?php //echo substr(htmlspecialchars_decode($DatabaseCo->dbRow->msg_content),0,45).'...'; ?>

                                    </a>

                                    <!-------------------------------for desktop End------------------------------------------->

                                    <!-------------------------------for mobile------------------------------------------->

                                    <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&trash=1" class="xxl-10 xs-16 s-16 m-16 ne_inbox_msg_content padding-lr-zero-320 margin-top-5px-320 visible-xs">

                                		<b class="ne_mrg_ri8_5 name1">(&nbsp;<?php echo $DatabaseCo->dbRow->subject; ?>&nbsp;) &nbsp;</b><?php //echo substr(htmlspecialchars_decode($DatabaseCo->dbRow->msg_content),0,10); ?>

                                    </a>

                                    <!-------------------------------for mobile End------------------------------------------->

                                </div>

                                <div class="xxl-4 xl-16 xs-16 ne_font_12 right-text ne_pad_tp_3px margin-top-5px-320 name2">

                                 	<i class="fa fa-clock-o ne_mrg_ri8_5"></i><?php echo date('d M Y ,H:i A', strtotime($DatabaseCo->dbRow->sent_date)); ?>

                                    

                                </div>

                            </li><?php */?>

