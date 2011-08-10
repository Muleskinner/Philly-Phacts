<?php
	require_once(realpath(dirname(__FILE__) . "/assets/php/DatabaseCredentials.php"));	
	require_once(realpath(dirname(__FILE__) . "/assets/php/UserQueries.php"));
	require_once(realpath(dirname(__FILE__) . "/assets/php/users/Administrator.php"));
	require_once(realpath(dirname(__FILE__) . "/assets/php/Password.php"));	
	$credentials = new DatabaseCredentials();
	$credentials = $credentials -> getCredentials();
	$credentials = $crecentials -> output();
	$userQueries = new UserQueries($credentials -> pdostring, $credentials -> username, $credentials -> password);
	$userQueries -> getUserByIndex(1);
	$user = $userQueries -> output();
	$me = new Administrator($user);
	$me -> getPassword();
	$password = $me -> output();
	$crypt = new Password($password);
	$hash = $crypt -> output();
	header("Content-Type: text/plain");
	header("Content-Encoding: UTF-8");
	echo $hash;
	
?>
