<?php
	require_once("interfaces/IPage.php");
	class BlogPost implements IPage
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

		public function addTitle($title)
		{
			$this -> data -> title = $title . "";
		}

		public function addContent($content)
		{
			$this -> data -> content = $content . "";
		}

		public function addMetadata($metadata)
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
			$this -> addHeadTag();
			$this -> addBodyTag();
			$this -> data -> output = $this -> data -> head;
			$this -> data -> output .= $this -> data -> body;			
		}

		public function addHeadTag()
		{
			ob_start();
			require_once("templates/head.php");
			$head = ob_get_clean();
			$head = str_replace("%Title%", $this -> data -> title, $head);
			$this -> data -> head = $head;
		}

		public function addBodyTag()
		{
			ob_start();
			require_once("templates/body.php");
			$body = ob_get_clean();
			$body = str_replace("%Title%", $this -> data -> title, $body);
			$body = str_replace("%Content%", $this -> data -> content, $body);
			$body = str_replace("%Author%", $this -> data -> metadata -> author, $body);
			$body = str_replace("%Date%", $this -> data -> metadata -> timestamp -> date, $body);
			$body = str_replace("%Time%", $this -> data -> metadata -> timestamp -> time, $body);	
			$body = str_replace("%Tags%", $this -> data -> metadata -> tagstring, $body);
			$this -> data -> body = $body;
		}

		public function output()
		{
			return $this -> data -> output;
		}
	}
?>
