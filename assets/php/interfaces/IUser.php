<?php
	require_once(realpath(dirname(__FILE__) . "/IData.php"));
	interface IUser extends IData
	{
		public function getEmail();
		public function getUsername();
		public function getPassword();
		public function getFullname();
		public function getUserLevel();
		public function getIndex();
		public function getUsergroup();
		public function getDisplayGroup();
		public function getGravatar();
	}
?>
