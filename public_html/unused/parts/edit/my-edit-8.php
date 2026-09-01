<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
	
	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select family_details from register where matri_id='$matri_id'");

	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
	
	
	
	?>

<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-star"></i>About My Family</span>
                        <a class="pull-right btn gt-btn-orange" onClick="return view88('edit');">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">Submit</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<div class="row">
                        	<div class="col-xxl-16 col-xl-16 col-lg-16 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                                <label>
                                  About My Family  :
                                </label>
                                <form  method="post" name="reg_edit_8" id="reg_edit_8" >
                                <textarea class="gt-form-control" rows="5" name="about_family" data-validetta="required"><?php echo $DatabaseCo->dbRow->family_details;?> </textarea>
                                </form>
                             </div>
                        </div>
                    </div>
                    
 <script type="text/javascript" src="./js/validetta.js"></script>                

 <script type="text/javascript">

    

	function view88(status){	

       
	
		$(function(){
		
    	$('#reg_edit_8').validetta({

    		errorClose : false,

			onValid : function( event ) {

       		 event.preventDefault();	

	   		 view8(status);

    		}

    	});

    });

		

		$('#reg_edit_8').submit();

		 

		     

    }

	

    </script>
                   