<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IPassword.php"));
	require_once(realpath(dirname(__FILE__) . "/../plugins/php/CryptLib/CryptLib.php"));	
	class Password implements IPassword
	{
		private $data;
		public function Password($password)
		{
			$this -> data -> password = $password . "";
			$this -> data -> crypt = new CryptLib\CryptLib;
			$this -> setPassword($password);
		}

		public function verifyPassword()
		{
			return $this -> data -> crypt -> verifyPasswordHash($this -> data -> password, $this -> data -> hash);
		}

		public function setPassword($password)
		{
			$this -> data -> password = $password . "";
			$this -> data -> hash = $this -> data -> crypt -> createPasswordHash($this -> data -> password);
		}

		public function output()
		{
			return $this -> data -> hash;
		}
	}
?>
