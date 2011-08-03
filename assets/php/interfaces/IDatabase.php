<?php
	require_once("IData.php");
	interface IDatabase extends IData
	{
		public function connect();
	}
?>
