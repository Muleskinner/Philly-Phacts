<?php
		require_once("./assets/php/Metadata.php");
		require_once("./assets/php/BlogPost.php");
		header("Content-Type: text/html");
		header("Content-Encoding: UTF-8");
		$metadata = new Metadata("Matt McDonald", true, "foo, bar, baz");
		$metadata = $metadata -> output();
		$blogpost = new BlogPost("This is a blog post title", "This is a blog post", $metadata);
		echo $blogpost -> output();
?>
