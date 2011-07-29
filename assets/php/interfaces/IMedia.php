<?php
	require_once("IData.php");
	interface IMedia extends IData
	{
		public function parseParams($params);
	}
?>
