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
			<li><a href="/income/list">Incams</a></li>
			<li><a href="/logout">Log out</a></li>
			<?php else: ?>
			<li style="float:right;"><a href="/login">Log in</a></li>
		</ul>
		<?php endif; ?>
			
	</nav>
    
	<main>
	<?=$output?>
	</main>

	
</html>