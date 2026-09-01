 <!--OWL CAROUSEL CSS-->
 <link href="css/owl.carousel.css" rel="stylesheet">
 <link href="css/owl.theme.css" rel="stylesheet">
 <!--OWL CAROUSEL CSS END-->
<div class="gt-vendor-strip">
	<div class="container">
		<div class="row">
			<div id="owl-vendor-strip" class="owl-carousel">
			<?php 
				$get_vendor = $DatabaseCo->dbLink->query("select id,category_id,name,city_id from vendors");
                   if (mysqli_num_rows($get_vendor) > 0) {
					   while ($vendor_row = mysqli_fetch_object($get_vendor)) {
			?>
				<div class="item row">
					<div class="col-xxl-16 text-center">
						<p>
					   	<?php echo $vendor_row->name; ?> 
						<?php $get_vendor_city = $DatabaseCo->dbLink->query("select city_name from vendor_city WHERE city_id='$vendor_row->city_id'");
						 $city_row=mysqli_fetch_object($get_vendor_city); ?> 
						 (<?php echo $city_row->city_name ?>)
						 <?php $get_vendor_cat = $DatabaseCo->dbLink->query("select name from vendor_category WHERE id='$vendor_row->category_id'");
						 $cat_row=mysqli_fetch_object($get_vendor_cat); ?> 
						<span> (Category - <?php echo $cat_row->name ?>)</span>
						  <a href="vendors/vendor-details?id=<?php echo $vendor_row->id?>" class="gt-margin-left-20">Check vendor detail<i class="fa fa-chevron-right gt-padding-left-5"></i></a></p>
					</div>
				</div>
			
			<?php }}?>	
				
			</div>
		</div>
	</div>
</div>
	
 