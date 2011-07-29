<?php
	require_once("IPage.php");
	interface IPost extends IPage
	{
		public function addTitle($title);
		public function addContent($content);
		public function addMetadata($metadata);
	}
?>
