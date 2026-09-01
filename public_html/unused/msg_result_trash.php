<?php

include_once 'databaseConn.php';

include_once './lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();

include_once './class/Config.class.php';

$configObj = new Config();

?>



<?php



if(isset($_POST['msg_status']) && $_POST['msg_status']=='replay_msg')

{

	echo "<script>window.location='composeMessages.php?msg_id=".$_POST['msg_id']."'</script>";	

	

}



if(isset($_POST['msg_status']) && $_POST['msg_status']=='forward_msg')

{

	echo "<script>window.location='composeMessages.php?msg_id=".$_POST['msg_id']."&frwd=1'</script>";	

	

}



/*if(isset($_POST['msg_status']) && $_POST['msg_status']=='trash')	

{

	$msg_id=explode(",",$_POST['msg_id']);



	foreach($msg_id as $key=>$value)

	{

		$DatabaseCo->dbLink->query("update messages set trash_sender='Yes' where mes_id='".$value."'");

		

	}

	echo "<script>alert('Your messages delete action complete successfully.');</script>";

}

*/



if(isset($_POST['msg_status']) && $_POST['msg_status']=='important')	

{

	$msg_id=explode(",",$_POST['msg_id']);



	foreach($msg_id as $key=>$value)

	{

		$DatabaseCo->dbLink->query("update messages set msg_important_status='Yes' where mes_id='".$value."'");

	}

	

	echo "<script>alert('Your messages important action complete successfully.');</script>";

}





if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='No')

{

	$DatabaseCo->dbLink->query("update messages set msg_important_status='No' where mes_id='".$_POST['msg_id']."'");

}



if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='Yes')

{

	$DatabaseCo->dbLink->query("update messages set msg_important_status='Yes' where mes_id='".$_POST['msg_id']."'");



}





								

if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read')

{



$get_msg=$DatabaseCo->dbLink->query("select * from messages where (from_id='".$_SESSION['user_id']."' and trash_sender='Yes' and msg_status='trash' and msg_read_status='Yes') or (to_id='".$_SESSION['user_id']."' and trash_receiver='Yes' and msg_status='trash' and msg_read_status='Yes') order by mes_id desc");

								

}

else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='unread')

{

									

$get_msg=$DatabaseCo->dbLink->query("select * from messages where (from_id='".$_SESSION['user_id']."' and trash_sender='Yes' and msg_status='trash' and msg_read_status='No') or (to_id='".$_SESSION['user_id']."' and trash_receiver='Yes' and msg_status='trash' and msg_read_status='No') order by mes_id desc");



}

else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read_all')

{



$get_msg=$DatabaseCo->dbLink->query("select * from messages where (from_id='".$_SESSION['user_id']."' and trash_sender='Yes' and msg_status='trash') or (to_id='".$_SESSION['user_id']."' and trash_receiver='Yes' and msg_status='trash') order by mes_id desc");	



}

else

{



$get_msg=$DatabaseCo->dbLink->query("select * from messages where (from_id='".$_SESSION['user_id']."' and trash_sender='Yes' and msg_status='trash') or (to_id='".$_SESSION['user_id']."' and trash_receiver='Yes' and msg_status='trash') order by mes_id desc");	



}





if(mysqli_num_rows($get_msg)>0)

{								

?>

                        <form method="post" action="" id="msg_data_form">

                                <ul class="xxl-16 xl-16 s-16 l-16 m-16 xs-16 bg-white margin-top-10px ne_inbox_msg_section padding-lr-zero list"  >

                               

									<?php

                                    while($DatabaseCo->dbRow = mysqli_fetch_object($get_msg))							{

                                    ?>

                                        <?php include "parts/main_msg_trash.php" ;?>

                                    <?php

                                    }

                                    ?>

                            	

								</ul>

                       

                       </form>

<?php

}

else{

?>

 <form method="post" action="" id="msg_data_form">
<ul class="xxl-16 xl-16 s-16 l-16 m-16 xs-16 bg-white margin-top-10px ne_inbox_msg_section padding-lr-zero list"  >

     <div class="thumbnail">

      	<img src="img/nodata-available.jpg">

     </div>

</ul>  
</form>                

<?php 

	}

?>   