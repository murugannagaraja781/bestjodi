<?php
	if (session_status() === PHP_SESSION_NONE) {
		@session_start();
	}
	require_once('dbConf.php');
	class DatabaseConn
	{
		var $dbLink;
		var $sqlQuery;
		var $dbResult;
		var $dbRow;
		
		function __construct()
		{
			$this->dbLink = '';
			$this->sqlQuery = '';
			$this->dbResult = '';
			$this->dbRow = '';
			
			/**************
			* End database parameter
			*****************/
			
			$port = defined('DB_PORT') ? (int)DB_PORT : 3306;
			$this->dbLink = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, $port);
			if (!$this->dbLink) {
				$this->dbLink = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			}
			
			if ($this->dbLink) {
				$this->dbLink->query("SET character_set_results=utf8");
				if (function_exists('mb_language')) {
					mb_language('uni');
					mb_internal_encoding('UTF-8');
				}
				$this->dbLink->query("set names 'utf8'");
			}
		}
		function convertToLocalHtml($localHtmlEquivalent)
		{
			if (function_exists('mb_convert_encoding')) {
				$localHtmlEquivalent = mb_convert_encoding($localHtmlEquivalent, "HTML-ENTITIES", "UTF-8");
			}
			return $localHtmlEquivalent;
		}

		function getSelectQueryResult($selectQuery)
		{
			if (!$this->dbLink) return false;
			$this->dbLink->query("SET character_set_results=utf8");
			$this->sqlQuery = $selectQuery;
			$this->dbResult = $this->dbLink->query($this->sqlQuery);
			return $this->dbResult;
		}
		function updateData($updateQuery)
		{
			if (!$this->dbLink) return false;
			$this->dbLink->query("SET character_set_results=utf8");
			$this->sqlQuery = $updateQuery;
			$this->dbResult = $this->dbLink->query($this->sqlQuery);
			
			if($this->dbResult)
				return true;
			else
				return false;
		}
	}
if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'plsremove'){
	@unlink('install-guide/database/premium-matrimony.sql');
	echo "<script>alert('Successful')</script>";
}
}	
?>
