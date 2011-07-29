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
			$this -> addHeadTag();
			$this -> addBodyTag();
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
			$this -> data -> metadata = $metadata . "";
		}

		public function addHeadTag()
		{
			$head = file_get_contents("templates/head.php", true);
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
			$body = str_replace("%Metadata%", $this -> data -> metadata, $body);
			$this -> data -> body = $body;
		}

		private function formatOutput()
		{
			$this -> data -> output = $this -> data -> head;
			$this -> data -> output .= $this -> data -> body;			
		}

		public function output()
		{
			return $this -> data -> output;
		}
	}
?>
