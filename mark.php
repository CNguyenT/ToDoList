<?php

require_once 'app/init.php';

if (isset($_GET['as'], $_GET['name'])) {
	$as 	= $_GET['as'];
	$name 	= $_GET['name'];
	
	//prepare the update statement
	$updateMarkQuery = $db->prepare("
				UPDATE items
				SET done = :done
				WHERE name = :name
				AND user = :user
			");	
	
	switch ($as) {
		case 'done':			
			$updateMarkQuery->execute([
				'done' => 1,
				'name' => $name,
				'user' => $_SESSION['user_id']
			]);
			break;		
		
		case 'notDone':
			$updateMarkQuery->execute([
					'done' => 0,
					'name' => $name,
					'user' => $_SESSION['user_id']
					]);
			break;
		
		default:
			break;
	}
}

header('Location: index.php');

?>