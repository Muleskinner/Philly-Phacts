<?php
	require_once("IData.php");
	interface IPage extends IData
	{
		public function addHeaders();
		public function addHeadTag();
		public function addBodyTag();
	}
?>
