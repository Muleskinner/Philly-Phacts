<?php
	require_once(realpath(dirname(__FILE__) . "/assets/php/BlogPostPage.php"));
	$postPage = new BlogPostPage(1);
	echo $postPage -> output();
?>
