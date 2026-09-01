<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select birthplace,birthtime,star,moonsign,manglik,dosh from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-book">
    </i>Horoscope Information
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return view1010('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form  method="post" name="reg_edit_10" id="reg_edit_10">
    <div class="row">
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Have Dosh? :
        </label>
        <select class="gt-form-control" name="dosh" onchange="yesnoCheck(this);">
        	<option value="No" <?php if($DatabaseCo->dbRow->dosh == 'No'){ echo 'selected' ;} ?>>
         		No
         	</option>
         	<option value="Yes" <?php if($DatabaseCo->dbRow->dosh == 'Yes' ){ echo 'selected'; } ?>>
         		Yes
         	</option>
         	
		</select>
      </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail" id="ifYes" style="display: <?php if(isset($DatabaseCo->dbRow->dosh ) == 'Yes' ){ echo 'block'; }else{ echo 'none';} ?> ;">
        <label>
          Dosh Type :
        </label>
        <select class="chosen-select gt-form-control" name="manglik[]" id="manglik" multiple>
          <?php $arr_manglik=explode(", ",$DatabaseCo->dbRow->manglik);?>
          <option value="Manglik" 
                  <?php if(in_array("Manglik",$arr_manglik)){ ?> selected="selected" 
          <?php } ?>>Manglik
          </option>
        <option value="Sarpa-dosh" 
                <?php if(in_array("Sarpa-dosh",$arr_manglik)){ ?> selected="selected" 
        <?php } ?>>Sarpa-dosh
        </option>
      <option value="Kala sarpa dosh" 
              <?php if(in_array("Kala sarpa dosh",$arr_manglik)){ ?> selected="selected" 
      <?php } ?>>Kala sarpa dosh
      </option>
    <option value="Rahu-dosh" 
            <?php if(in_array("Rahu-dosh",$arr_manglik)){ ?> selected="selected" 
    <?php } ?>>Rahu-dosh
    </option>
  <option value="Kethu dosh" 
          <?php if(in_array("Kethu dosh",$arr_manglik)){ ?> selected="selected" 
  <?php } ?>>Kethu dosh
  </option>
<option value="Kalathra-dosh" 
        <?php if(in_array("Kalathra-dosh",$arr_manglik)){ ?> selected="selected" 
<?php } ?>>Kalathra-dosh
</option>
</select>
      </div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail" >
  <div class="row">
    <div class="col-xs-6">
      <label>
        Moonsign :
      </label>
    </div>
    <div class="col-xs-4 text-center">
      <h4 class="gt-font-weight-400">
      </h4>
    </div>
    <div class="col-xs-6">
      <label>Star :
      </label>
    </div>
  </div>   
  <div class="row">
    <div class="col-xs-6">
      <select id="moonsign" name="moonsign" class="gt-form-control">
        <option value="">
          Select
        </option>
        <option value="Does not matter" <?php if($DatabaseCo->dbRow->moonsign == "Does not matter"){echo "selected";}?>>Does not matter
        </option>
        <option value="Mesh(Aries)" <?php if($DatabaseCo->dbRow->moonsign == "Mesh(Aries)"){echo "selected";}?>>Mesh (Aries)
        </option>
        <option value="Vrishabh(Taurus)" <?php if($DatabaseCo->dbRow->moonsign == "Vrishabh(Taurus)"){echo "selected";}?>>Vrishabh (Taurus)
        </option>
        <option value="Mithun(Gemini)" <?php if($DatabaseCo->dbRow->moonsign == "Mithun(Gemini)"){echo "selected";}?>>Mithun (Gemini)
        </option>
        <option value="Karka(Cancer)" <?php if($DatabaseCo->dbRow->moonsign == "Karka(Cancer)"){echo "selected";}?>>Karka (Cancer)
        </option>
        <option value="Simha(Leo)" <?php if($DatabaseCo->dbRow->moonsign == "Simha(Leo)"){echo "selected";}?>>Simha (Leo)
        </option>
        <option value="Kanya(Virgo)" <?php if($DatabaseCo->dbRow->moonsign == "Kanya(Virgo)"){echo "selected";}?>>Kanya (Virgo)
        </option>
        <option value="Tula(Libra)" <?php if($DatabaseCo->dbRow->moonsign == "Tula(Libra)"){echo "selected";}?>>Tula (Libra)
        </option>
        <option value="Vrischika(Scorpio)" <?php if($DatabaseCo->dbRow->moonsign == "Vrischika(Scorpio)"){echo "selected";}?>>Vrischika (Scorpio)
        </option>
        <option value="Dhanu(Sagittarious)" <?php if($DatabaseCo->dbRow->moonsign == "Dhanu(Sagittarious)"){echo "selected";}?>>Dhanu (Sagittarious)
        </option>
        <option value="Makar(Capricorn)" <?php if($DatabaseCo->dbRow->moonsign == "Makar(Capricorn)"){echo "selected";}?>>Makar (Capricorn)
        </option>
        <option value="Kumbha(Aquarious)" <?php if($DatabaseCo->dbRow->moonsign == "Kumbha(Aquarious)"){echo "selected";}?>>Kumbha (Aquarious)
        </option>
        <option value="Meen(Pisces)" <?php if($DatabaseCo->dbRow->moonsign == "Meen(Pisces)"){echo "selected";}?>>Meen (Pisces)
        </option>
      </select>
    </div>
    <div class="col-xs-4 text-center">
      <h4 class="gt-font-weight-400">&amp;
      </h4>
    </div>
    <div class="col-xs-6">
      <select id="star" name="star" class="gt-form-control">

        <option value="">
         Select
        </option>
        
        <option value="Does not matter" <?php if($DatabaseCo->dbRow->star == "Does not matter"){echo "selected";}?>>Does not matter
        </option>
        <option value="ANUSHAM" <?php if($DatabaseCo->dbRow->star == "ANUSHAM"){echo "selected";}?>>ANUSHAM
        </option>
        <option value="ASWINI" <?php if($DatabaseCo->dbRow->star == "ASWINI"){echo "selected";}?>>ASWINI
        </option>
        <option value="AVITTAM" <?php if($DatabaseCo->dbRow->star == "AVITTAM"){echo "selected";}?>>AVITTAM
        </option>
        <option value="AYILYAM" <?php if($DatabaseCo->dbRow->star == "AYILYAM"){echo "selected";}?>>AYILYAM
        </option>
        <option value="BHARANI" <?php if($DatabaseCo->dbRow->star == "BHARANI"){echo "selected";}?>>BHARANI
        </option>
        <option value="CHITHIRAI" <?php if($DatabaseCo->dbRow->star == "CHITHIRAI"){echo "selected";}?>>CHITHIRAI
        </option>
        <option value="HASTHAM" <?php if($DatabaseCo->dbRow->star == "HASTHAM"){echo "selected";}?>>HASTHAM
        </option>
        <option value="KETTAI" <?php if($DatabaseCo->dbRow->star == "KETTAI"){echo "selected";}?>>KETTAI
        </option>
        <option value="KRITHIGAI" <?php if($DatabaseCo->dbRow->star == "KRITHIGAI"){echo "selected";}?>>KRITHIGAI
        </option>
        <option value="MAHAM" <?php if($DatabaseCo->dbRow->star == "MAHAM"){echo "selected";}?>>MAHAM
        </option>
        <option value="MOOLAM" <?php if($DatabaseCo->dbRow->star == "MOOLAM"){echo "selected";}?>>MOOLAM
        </option>
        <option value="MRIGASIRISHAM" <?php if($DatabaseCo->dbRow->star == "MRIGASIRISHAM"){echo "selected";}?>>MRIGASIRISHAM
        </option>
        <option value="POOSAM" <?php if($DatabaseCo->dbRow->star == "POOSAM"){echo "selected";}?>>POOSAM
        </option>
        <option value="PUNARPUSAM" <?php if($DatabaseCo->dbRow->star == "PUNARPUSAM"){echo "selected";}?>>PUNARPUSAM
        </option>
        <option value="PURADAM" <?php if($DatabaseCo->dbRow->star == "PURADAM"){echo "selected";}?>>PURADAM
        </option>
        <option value="PURAM" <?php if($DatabaseCo->dbRow->star == "PURAM"){echo "selected";}?>>PURAM
        </option>
        <option value="PURATATHI" <?php if($DatabaseCo->dbRow->star == "PURATATHI"){echo "selected";}?>>PURATATHI
        </option>
        <option value="REVATHI" <?php if($DatabaseCo->dbRow->star == "REVATHI"){echo "selected";}?>>REVATHI
        </option>
        <option value="ROHINI" <?php if($DatabaseCo->dbRow->star == "ROHINI"){echo "selected";}?>>ROHINI
        </option>
        <option value="SADAYAM" <?php if($DatabaseCo->dbRow->star == "SADAYAM"){echo "selected";}?>>SADAYAM
        </option>
        <option value="SWATHI" <?php if($DatabaseCo->dbRow->star == "SWATHI"){echo "selected";}?>>SWATHI
        </option>
        <option value="THIRUVADIRAI" <?php if($DatabaseCo->dbRow->star == "THIRUVADIRAI"){echo "selected";}?>>THIRUVADIRAI
        </option>
        <option value="THIRUVONAM" <?php if($DatabaseCo->dbRow->star == "THIRUVONAM"){echo "selected";}?>>THIRUVONAM
        </option>
        <option value="UTHRADAM" <?php if($DatabaseCo->dbRow->star == "UTHRADAM"){echo "selected";}?>>UTHRADAM
        </option>
        <option value="UTHRAM" <?php if($DatabaseCo->dbRow->star == "UTHRAM"){echo "selected";}?>>UTHRAM
        </option>
        <option value="UTHRATADHI" <?php if($DatabaseCo->dbRow->star == "UTHRATADHI"){echo "selected";}?>>UTHRATADHI
        </option>
        <option value="VISAKAM" <?php if($DatabaseCo->dbRow->star == "VISAKAM"){echo "selected";}?>>VISAKAM
        </option>
      </select>
    </div>
  </div>
</div>
<div class="clearfix">
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Birth Time   :
  </label>
  <select name="birthtime" class="gt-form-control">
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." am";?>" >
      <?php echo $i.":".$k." am";?>
    </option>	
    <?php
}
}
?>
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." pm";?>" >
      <?php echo $i.":".$k." pm";?>
    </option>	
    <?php
}
}
?>
    <option value="<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthtime,ENT_QUOTES); ?>" selected>
      <?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthtime,ENT_QUOTES); ?>
    </option>
  </select>	
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Birth Of Place  :
  </label>
  <input type="text" class="gt-form-control valid" value="<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthplace,ENT_QUOTES); ?>" name="birthplace" >
</div>
</div>
</form>
</div>
<script>
		function yesnoCheck(that) {
			if (that.value == "Yes") {

				document.getElementById("ifYes").style.display = "block";
			} else {
				document.getElementById("ifYes").style.display = "none";
			}
		}
	   </script>
<script type="text/javascript">
  function view1010(status){
    view10(status);
  }
</script>                    
<!-- CHOSEN -->
<script type="text/javascript">
  var config = {
    '.chosen-select'           : {
    }
    ,
    '.chosen-select-deselect'  : {
      allow_single_deselect:true}
    ,
    '.chosen-select-no-single' : {
      disable_search_threshold:10}
    ,
    '.chosen-select-no-results': {
      no_results_text:'Oops, nothing found!'}
    ,
    '.chosen-select-width'     : {
      width:"100%"}
  }
  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }
</script>
<!-- CHOSEN END-->
<script>
		$('.valid').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault(alert('Spacial Character Not Allowed.'));
       return false;	  
	}		
});
</script>
