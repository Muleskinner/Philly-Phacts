<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IData.php"));
	class DatabaseCredentials implements IData
	{
		const DATABASE = "foo";
		const HOST = "localhost";
		const PASSWORD = "foobarbaz";
		const USERNAME = "root";
		private $data;
		public function DatabaseCredentials()
		{

		}

		public function getDatabase()
		{
			$this -> data -> database = $this::DATABASE;
		}

		public function getHost()
		{
			$this -> data -> host = $this::HOST;
		}

		public function getUsername()
		{
			$this -> data -> username = $this::USERNAME;
		}

		public function getPassword()
		{
			$this -> data -> password = $this::PASSWORD;
		}

		public function getCredentials()
		{
			$this -> data -> database = $this::DATABASE;
			$this -> data -> host = $this::HOST;
			$this -> data -> username = $this::USERNAME;
			$this -> data -> password = $this::PASSWORD;
			$this -> data -> pdostring = "mysql:dbname=" . $this -> data -> database . ";host=" . $this -> data -> host . ";";
		}

		public function output()
		{
			return $this -> data;
		}
	}
?>
