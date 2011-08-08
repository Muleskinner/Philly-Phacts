<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IDatabase.php"));
	class UserQueries implements IDatabase
	{
		const SUBSTRING_LIMIT = 3;
		private $data;
		public function UserQueries($database, $user, $password)
		{
			$this -> data -> database = $database;
			$this -> data -> username = $user;
			$this -> data -> password = $password;
		}

		public function connect()
		{
			$this -> data -> connection = new PDO($this -> data -> database, $this -> data -> username, $this -> data -> password);
		}

		public function getUserByEmail($email)
		{
			$query -> str = "SELECT * FROM `users` WHERE `email`=:email LIMIT 1";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			$email = $email . "";
			if($email)
			{
				$prepared -> bindParam(":email", $email, PDO::PARAM_STR);
			}else if(!$email)
			{
				die("PostQueries -> getUserByEmail: Email not provided");
			}
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
			$this -> data -> result = $this -> data -> result[0];
		}

		public function getUserByName($name)
		{
			$query -> str = "SELECT * FROM `users` WHERE `username`=:name LIMIT 1";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			$name = $name . "";
			if($name)
			{
				$prepared -> bindParam(":name", $name, PDO::PARAM_STR);
			}else if(!$name)
			{
				die("PostQueries -> getUserByName: Name not provided");
			}
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
			$this -> data -> result = $this -> data -> result[0];
		}

		public function getUserByIndex($index)
		{
			$query -> str = "SELECT * FROM `users` WHERE `index`=:index LIMIT 1";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			if(!is_int($index))
			{
				die("PostQueries -> getUserByIndex: Index provided is not an integer");
			}
			$prepared -> bindParam(":index", $index, PDO::PARAM_INT);
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
			$this -> data -> result = $this -> data -> result[0];
		}

		public function getUsersByLevel($level)
		{
			$query -> str = "SELECT * FROM `users` WHERE `userlevel`=:level ORDER BY `username` ASC";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			if(!is_int($level))
			{
				die("PostQueries -> getUsersByLevel: Level provided is not an integer");
			}
			$prepared -> bindParam(":level", $level, PDO::PARAM_INT);
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function getUsersBySubstring($substring)
		{
			$query -> str = "SELECT * FROM `users` WHERE `username` LIKE :substring";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			$substring = "%" . $substring . "%";
			if(strlen($substring) < $this::SUBSTRING_LIMIT - 2)
			{
				die("PostQueries -> getUsersBySubstring: Substring must be at least " . $this::SUBSTRING_LIMIT . " characters");
			}
			$prepared -> bindParam(":substring", $substring, PDO::PARAM_STR);
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function getAllUsers($order)
		{
			$query -> str = "SELECT * FROM `users`";
			$query -> orderStr = "SELECT * FROM `users` ORDER BY `username` :order";
			$order = $order . "";
			$orders = array("ASC", "DESC");
			$prepared;
			if($order && in_array($order, $orders))
			{
				$prepared = $this -> data -> connection -> prepare($query -> orderStr);
				$prepared -> bindParam(":order", $newOrder, PDO::PARAM_STR);
			}else if($order && !in_array($order, $orders))
			{
				die("PostQueries -> getAllUsers: Order not recognized as valid (\"ASC\" | \"DESC\")");
			}else if(!$order)
			{
				$prepared = $this -> data -> connection -> prepare($query -> str);
			}
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function output()
		{
			return $this -> data -> result;
		}
	}
?>
