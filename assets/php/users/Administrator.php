<?php
	require_once(realpath(dirname(__FILE__) . "/../interfaces/IUser.php"));
	class Administrator implements IUser
	{
		const DISPLAY_GROUP = "author";
		const USER_LEVEL = 4;
		const USER_GROUP = "administrator";
		private $data;
		public function Administrator($userdata)
		{
			$this -> data -> email = $userdata["email"];
			$this -> data -> username = $userdata["username"];
			$this -> data -> password = $userdata["password"];
			$this -> data -> fullname = $userdata["fullname"];
			$this -> data -> userlevel = $this::USER_LEVEL;			
			$this -> data -> index = $userdata["index"];
			$this -> data -> usergroup = $this::USER_GROUP;
			$this -> data -> displaygroup = $this::DISPLAY_GROUP;			
		}

		public function getEmail()
		{
			return $this -> data -> email;
		}

		public function getUsername()
		{
			return $this -> data -> username;
		}

		public function getPassword()
		{
			return $this -> data -> password;
		}

		public function getFullname()
		{
			return $this -> data -> fullname;
		}

		public function getUserLevel()
		{
			return $this -> data -> userlevel;
		}

		public function getIndex()
		{
			return $this -> data -> index;
		}

		public function getUsergroup()
		{
			return $this -> data -> usergroup;
		}

		public function getDisplayGroup()
		{
			return $this -> data -> displaygroup;
		}

		public function getGravatar()
		{
			
		}

		public function output()
		{
			return $this -> data;
		}
	}
?>
