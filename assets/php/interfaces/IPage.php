<?php
	require_once(realpath(dirname(__FILE__) . "/IData.php"));
	interface IPage extends IData
	{
		public function addHeaders();
		public function addHeadTag();
		public function addBodyTag();
	}
?>
