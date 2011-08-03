<?php
	require_once("interfaces/IDatabase.php");
	class PostQueries implements IDatabase
	{
		const SUBSTRING_LIMIT = 3;
		private $data;
		public function PostQueries($database, $user, $password)
		{
			$this -> data -> database = $database;
			$this -> data -> username = $user;
			$this -> data -> password = $password;
			$this -> connect();
		}

		private function connect()
		{
			$this -> data -> connection = new PDO($this -> data -> database, $this -> data -> username, $this -> data -> password);
		}

		public function getPostByText($text)
		{
			$query -> str = "SELECT * FROM posts WHERE text=:text LIMIT 1";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			$text = $text . "";
			if($text)
			{
				$prepared -> bindParam(":text", $text);
			}else if(!$text)
			{
				die("PostQueries -> getPostByText: Text not provided");
			}
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function getPostByIndex($index)
		{
			$query -> str = "SELECT * FROM posts WHERE index=:index LIMIT 1";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			if(!is_int($index))
			{
				die("PostQueries -> getPostByIndex: Index provided is not an integer");
			}
			$prepared -> bindParam(":index", $index, PDO::PARAM_INT);
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function getPostsBySubstring($substring)
		{
			$query -> str = "SELECT * FROM posts WHERE text LIKE :substring";
			$prepared = $this -> data -> connection -> prepare($query -> str);
			$substring = "%" . $substring . "%";
			if(strlen($substring) < $this::SUBSTRING_LIMIT - 2)
			{
				die("PostQueries -> getPostsBySubstring: Substring must be at least " . $this::SUBSTRING_LIMIT . " characters");
			}
			$prepared -> bindParam(":substring", $substring, PDO::PARAM_STR);
			$prepared -> execute();
			$this -> data -> result = $prepared -> fetchAll();
		}

		public function getAllPosts($order)
		{
			$query -> str = "SELECT * FROM posts";
			$query -> orderStr = "SELECT * FROM posts ORDER BY text :order";
			$order = $order . "";
			$orders = array("ASC", "DESC");
			$prepared;
			if($order && in_array($order, $orders))
			{
				$prepared = $this -> data -> connection -> prepare($query -> orderStr);
				$prepared -> bindParam(":order", $newOrder, PDO::PARAM_STR);
			}else if($order && !in_array($order, $orders))
			{
				die("PostQueries -> getAllPosts: Order not recognized as valid (\"ASC\" | \"DESC\")");
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
