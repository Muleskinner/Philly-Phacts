<?php
	require_once(realpath(dirname(__FILE__) . "/IData.php"));
	interface IMedia extends IData
	{
		public function parseParams($params);
	}
?>
