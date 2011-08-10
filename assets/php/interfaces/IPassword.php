<?php
	require_once(realpath(dirname(__FILE__) . "/IData.php"));
	interface IPassword extends IData
	{
		public function verifyPassword($password);
		public function setPassword($password);
	}
?>
