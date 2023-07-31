<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/jokes.css">
		<title><?=$title?></title>
	</head>
	<body>
	<nav>
		
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/currency/list">Currency</a></li>
			<li><a href="/currency/edit">Add a new Currency</a></li>
			<li><a href="/currency/edit">Add a new Cash</a></li>
			<?php if ($loggedIn): ?>
			<li><a href="/logout">Log out</a></li>
			<?php else: ?>
			<li><a href="/login">Log in</a></li>
			<?php endif; ?>
		</ul>
	</nav>
    
	<main class="smalltable">
	<?=$output?>
	</main>

	
</html>