<?php
	require_once("interfaces/IData.php");
	class Metadata implements IData
	{
		private $data;
		public function Metadata($author, $getTimestamp, $tagString)
		{
			$this -> data -> author = $author . "";
			$this -> data -> timestamp = $this -> createTimestamp($getTimestamp);
			$this -> data -> tags = $this -> parseTags($tagString);
		}

		private function createTimestamp($create)
		{
			$timestamp;
			if($create)
			{
				$timestamp -> date = date("l, F jS, Y");
				$timestamp -> time = date("g:i a");
				return $timestamp;
			}else if(!$create)
			{
				return $timestamp;
			}
		}

		private function parseTags($tagString)
		{
			$tags = explode(",", $tagString);
			foreach($tags as $tag)
			{
				$tag = trim($tag);	
			}
			return $tags;
		}

		public function output()
		{
			return $this -> data;
		}
	}
?>
