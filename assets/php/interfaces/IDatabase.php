<?php
	require_once(realpath(dirname(__FILE__) . "/IData.php"));
	interface IDatabase extends IData
	{
		public function connect();
	}
?>
