<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/jokes.css">
		<title><?=$title?></title>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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