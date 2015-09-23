<?php

session_start();

//fake logging in as user 1, cindy
$_SESSION['user_id'] = 1;

//initialize account variables
$username = 'root';
$password = '';
$dsn = 'mysql:host=localhost;dbname=todo';

//connect to the database
try {
	$db = new PDO($dsn, $username, $password);	
// 	$rows = $db->query('SELECT * from users');
	
// 	foreach ($rows as $row) {
// 		print_r($row);		
// 	}
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();//equivalent to exit() --> outputs a message and terminates the current script
}

//handle this in some other way
if (!isset($_SESSION['user_id'])) {
	die('You are not signed in.');
}

?>