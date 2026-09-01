<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

if(isset($_POST['exp_status']) && $_POST['exp_status']=='accept_all')
{
	$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Accept' where ei_id in (".$_POST['exp_id'].")");
	
}
if(isset($_POST['exp_status']) && $_POST['exp_status']=='reject_all')
{
	$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Reject' where ei_id in (".$_POST['exp_id'].")");
	
}


?>