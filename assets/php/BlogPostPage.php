<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IPage.php"));
	require_once(realpath(dirname(__FILE__) . "/DatabaseCredentials.php"));
	require_once(realpath(dirname(__FILE__) . "/PostQueries.php"));
	require_once(realpath(dirname(__FILE__) . "/UserQueries.php"));
	require_once(realpath(dirname(__FILE__) . "/Metadata.php"));
	require_once(realpath(dirname(__FILE__) . "/users/Administrator.php"));
	require_once(realpath(dirname(__FILE__) . "/users/Author.php"));
	require_once(realpath(dirname(__FILE__) . "/BlogPost.php"));
	class BlogPostPage implements IPage
	{
		private $data;
		public function BlogPostPage($index)
		{
			$this -> addContent($index);
		}

		private function addContent($index)
		{
			$credentials = new DatabaseCredentials();
			$credentials -> getCredentials();
			$credentials = $credentials -> output();
			$post = new PostQueries($credentials -> pdostring, $credentials -> username, $credentials -> password);
			$post -> connect();
			$post -> getPostByIndex($index);
			$post = $post -> output();
			$this -> data -> post = $post;
			$user = new UserQueries($credentials -> pdostring, $credentials -> username, $credentials -> password);
			$user -> connect();
			$user -> getUserByName($this -> data -> post["author"]);
			$user = $user -> output();
			$this -> addTitle($this -> data -> post["title"]);
			$this -> addMetadata(new Administrator($user));
			$this -> formatOutput();
		}

		private function addTitle($title)
		{
			$this -> data -> title = $title . "";
		}

		private function addMetadata($user)
		{
			$this -> data -> metadata = new Metadata($user, true, $this -> data -> post["tags"]);
			$this -> data -> metadata = $this -> data -> metadata -> output();
		}

		private function formatOutput()
		{
			$this -> addHeaders();
			$this -> addHeadTag();
			$this -> addBodyTag();
			$this -> data -> output = $this -> data -> head;
			$this -> data -> output .= $this -> data -> body;
		}

		public function addHeaders()
		{
			header("Content-Type: text/html");
			header("Content-Encoding: UTF-8");
		}

		public function addHeadTag()
		{
			ob_start();
			require_once(realpath(dirname(__FILE__) . "/templates/content/blogpostpage/head.php"));
			$head = ob_get_clean();
			$head = str_replace("%Title%", $this -> data -> title, $head);
			$this -> data -> head = $head;
		}

		public function addBodyTag()
		{
			ob_start();
			require_once(realpath(dirname(__FILE__) . "/templates/content/blogpostpage/body.php"));
			$body = ob_get_clean();
			$body = str_replace("%Title%", $this -> data -> title, $body);
			$body = str_replace("%User Directory%", "users/" . $this -> data -> metadata -> author -> index . "/", $body);
			$body = str_replace("%Display Group%", $this -> data -> metadata -> author -> displaygroup, $body);
			$body = str_replace("%Author%", $this -> data -> metadata -> author -> fullname, $body);
			$body = str_replace("%Date%", $this -> data -> metadata -> timestamp -> date, $body);
			$body = str_replace("%Time%", $this -> data -> metadata -> timestamp -> time, $body);	
			$body = str_replace("%Tags%", $this -> data -> metadata -> tagstring, $body);
			$post = new BlogPost($this -> data -> post["title"], $this -> data -> post["text"], $this -> data -> metadata);
			$body = str_replace("%Content%", $post -> output(), $body);
			$this -> data -> body = $body;
		}

		public function output()
		{
			return $this -> data -> output;
		}
	}
?>
