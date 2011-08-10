<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IPage.php"));
	class BlogPost
	{
		private $data;
		public function BlogPost($title, $content, $metadata)
		{
			$this -> addTitle($title);
			$this -> addContent($content);
			$this -> addMetadata($metadata);
			$this -> parseTags($metadata -> tags);
			$this -> formatOutput();
		}

		private function addTitle($title)
		{
			$this -> data -> title = $title . "";
		}

		private function addContent($content)
		{
			$this -> data -> content = $content . "";
		}

		private function addMetadata($metadata)
		{
			$this -> data -> metadata = $metadata;
		}

		private function parseTags($tags)
		{
			$tagString = implode(", ", $tags);
			$this -> data -> metadata -> tagstring = $tagString;
		}

		private function formatOutput()
		{
			$this -> addPostBody();
		}
		
		private function addPostBody()
		{
			ob_start();
			require_once(realpath(dirname(__FILE__) . "/templates/content/blogpost/body.php"));
			$this -> replaceBodyPlaceholders();
		}

		private function replaceBodyPlaceholders()
		{
			$body = ob_get_clean();
			$body = str_replace("%Title%", $this -> data -> title, $body);
			$body = str_replace("%Content%", $this -> data -> content, $body);
			$body = str_replace("%User Directory%", "users/" . $this -> data -> metadata -> author -> index . "/", $body);
			$body = str_replace("%Display Group%", $this -> data -> metadata -> author -> displaygroup, $body);
			$body = str_replace("%Author%", $this -> data -> metadata -> author -> fullname, $body);
			$body = str_replace("%Date%", $this -> data -> metadata -> timestamp -> date, $body);
			$body = str_replace("%Time%", $this -> data -> metadata -> timestamp -> time, $body);	
			$body = str_replace("%Tags%", $this -> data -> metadata -> tagstring, $body);
			$body = trim($body);			
			$this -> data -> output = $body;
		}

		public function output()
		{
			return $this -> data -> output;
		}
	}
?>
