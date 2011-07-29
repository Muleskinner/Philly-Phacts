<?php
		require_once("./assets/php/BlogPost.php");
		$blogpost = new BlogPost("This is a blog post title", "This is a blog post", "bing:bang:boom");
		header("Content-Type: text/html");
		header("Content-Encoding: UTF-8");
		echo $blogpost -> output();
?>
