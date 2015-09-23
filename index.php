<?php 

//establish database connection
require_once 'app/init.php';

//retrieve user items
$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
");

//pass value of user login to :user 
$itemsQuery->execute([
	'user' => $_SESSION['user_id']
]);


$items = $itemsQuery->rowCount() ? $itemsQuery : [];

/*
 * the foreach in the html section will not work if this is uncommented 
 * because the below loop would have looped to the end of the $item array,
 * leaving no other value for the html's foreach to loop through
 */
// foreach ($items as $item) {
// 	echo $item['name'], '</br>';
// }

?>



<!DOCTYPE html>
<html>

	<head>
	
		<title></title>
	
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/main.css">	
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	
	<body>	
		<div class="list">
			<h1 class="header">To do.</h1>
			
			<!-- if there are items -->
			<?php if (!empty($items)): ?>					
				<ul>
					<?php foreach($items as $item):?>
						<li>							
							<?php if (!$item['done']): ?>
								<!-- send variables to the $_GET var -->
								<a href="mark.php?as=done&name=<?php echo $item['name'];?>" class="done-button">Mark as done</a>
							
							<?php else: ?>
								<a href="mark.php?as=notDone&name=<?php echo $item['name'];?>" class="done-button">Unmark</a>
							<?php endif; ?>
							<span class="item <?php echo $item['done'] ? 'done' : '' ?>">
								<?php echo $item['name']; ?>
							</span>
							<a href="delete.php?name=<?php echo $item['name']?>" class="delete-button">X</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else: ?>	
				<p>You haven't added any items yet.</p>		
			<?php endif; ?>
			<!-- send data to $_POST -->
			<form class="item-add" action="add.php" method="post">
				<input class="input" type="text" name="name" placeholder="Enter an item..." autocomplete="off" required>
				<input class="submit" type="submit" value="Add">
			</form>
		</div>		
	</body>
</html>