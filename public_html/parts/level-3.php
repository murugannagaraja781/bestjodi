<?php
	include_once 'databaseConn.php';
	
	$DatabaseCo = new DatabaseConn();
	


	$get_adv_l3=mysqli_fetch_object($DatabaseCo->dbLink->query("select * from advertisement where adv_level='level-3' and status='APPROVED' order by rand() limit 0,1"));
	
	?>
	
    <a href="<?php echo $get_adv_l3->adv_link;?>" class="col-xs-16" target="_blank">
    <div class="container" style="max-width:1150px;">
    	<img src="advertise/<?php echo $get_adv_l3->adv_img;?>" class="img-responsive" style="max-height:80px !important;width:100%;">
    </div>
    </a>