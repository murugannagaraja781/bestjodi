<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$desg_id = isset($_POST['desg_id']) ? $_POST['desg_id'] :"" ;



$desg_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['desg_name']))

			{

            	$erroMessage .= "<li>Designation should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['desg_name']) < 1)

				{

            		$erroMessage .= "<li>Designation Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['desg_status']))

			{

			$erroMessage .= "<li>Designation Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$desg_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['desg_name']);

				$status   = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['desg_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      $SQL_STATEMENT = "INSERT into designation (desg_name,status)  values ('".$desg_name."','".$status."')";


    

                            break;

                    case 'UPDATE':

                            $desg_id = $_POST['desg_id'];

                           $SQL_STATEMENT =  "UPDATE designation  set desg_name='".$desg_name."',status='".$status."' WHERE desg_id=".$desg_id;	

                            break;

                            

            }

    

             $statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);

             $STATUS_MESSAGE = $statusObj->getStatusMessage();

	     

	     

	     $response = array();

	     $response['successStatus'] = $statusObj->getActionSuccess();

	     $response['responseMessage'] = $STATUS_MESSAGE;

	     header('Content-type: application/json');

	     echo json_encode($response);

	   	}

	   	else

	   	{

	   	 	

	     $response = array();

	     $response['successStatus'] = false;

	     $response['responseMessage'] = $erroMessage;

	     header('Content-type: application/json');

	     echo json_encode($response);	   		

	   	}

	   	

}



?>