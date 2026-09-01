         <?php 
		  $fetch_detail=$DatabaseCo->dbLink->query("select * from vendor_site_settings where setting_id='1'");
		  $DatabaseCo->dbRow = mysqli_fetch_object($fetch_detail); ?>
        
           	<div class="footer">
            	<footer>
                	<div class="container">
                    	<div class="col-xl-9 footerNav">
                			<a href="index.php">Home</a>
                            <a href="<?php echo $DatabaseCo->dbRow->about_us_link; ?>">About Us</a>
                            <a href="<?php echo $DatabaseCo->dbRow->contact_us_link; ?>">Contact Us</a>
                            <a href="<?php echo $DatabaseCo->dbRow->terms_link; ?>">Terms</a>
                            <a href="<?php echo $DatabaseCo->dbRow->privacy_link; ?>">Privacy Policy</a>
                        </div>
                        <div class="col-xl-7 footerSiteLink">
                        	All Rights Reserved By&nbsp;&nbsp;<a href="<?php echo $configObj->getConfigName(); ?>"><?php echo $configObj->getConfigFooter();?></a>
                        </div>
                    </div>
                </footer>
            </div>