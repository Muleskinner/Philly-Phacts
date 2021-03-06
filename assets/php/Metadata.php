<?php
	require_once(realpath(dirname(__FILE__) . "/interfaces/IData.php"));
	require_once(realpath(dirname(__FILE__) . "/users/Administrator.php"));
	require_once(realpath(dirname(__FILE__) . "/users/Author.php"));
	class Metadata implements IData
	{
		private $data;
		public function Metadata($author, $getTimestamp, $tagString)
		{
			$this -> data -> author = $this -> readAuthor($author);
			$this -> data -> timestamp = $this -> createTimestamp($getTimestamp);
			$this -> data -> tags = $this -> parseTags($tagString);
		}

		private function readAuthor($author)
		{
			$authorData -> email = $author -> getEmail();
			$authorData -> username = $author -> getUsername();
			$authorData -> password = $author -> getPassword();
			$authorData -> fullname = $author -> getFullname();
			$authorData -> userlevel = $author -> getUserLevel();
			$authorData -> index = $author -> getIndex();
			$authorData -> gravatar = $author -> getGravatar();
			$authorData -> usergroup = $author -> getUsergroup();
			$authorData -> displaygroup = $author -> getDisplayGroup();
			return $authorData;
		}

		private function createTimestamp($create)
		{
			$timestamp;
			date_default_timezone_set("America/Denver");
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
