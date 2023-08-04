<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/jokes.css">
		<title><?=$title?></title>
	</head>
	<body>
	<nav>
		
		<?php if ($loggedIn): ?>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/currency/list">Currency</a></li>			
			<li><a href="/rate/list">Rate</a></li>
			<li><a href="/logout">Log out</a></li>
			<li style="float:right;"><a href="/login">Log in</a></li>
		</ul>
		<?php else: ?>
			Test
		<?php endif; ?>
	</nav>
    
	<main class="smalltable">
	<?=$output?>
	</main>

	
</html>