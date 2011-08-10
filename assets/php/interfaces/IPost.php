<?php
	require_once(realpath(dirname(__FILE__) . "/IPage.php"));
	interface IPost extends IPage
	{
		public function addTitle($title);
		public function addContent($content);
		public function addMetadata($metadata);
	}
?>
