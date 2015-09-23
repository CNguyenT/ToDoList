<?php

//establish database connection
require_once 'app/init.php';

//get name of item
if (isset($_GET['name'])) {
	$name = $_GET['name'];
	
	//set up delete statement
	$deleteQuery = $db->prepare("
		DELETE FROM items
		WHERE name = :name
	");
	
	//pass in name value
	$deleteQuery->execute([
		'name' => $name
	]);
}	

header('Location: index.php');

?>