<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/jokes.css">
		<title><?=$title?></title>     
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://css.cubit.md/css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="https://css.cubit.md/css/form.css" />
        <link rel="stylesheet" type="text/css" href="https://css.cubit.md/css/shortcast.css" />

		



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
				<li style="float:right; color:red"><a href="/login">Log in</a></li>
		</ul>
		<?php endif; ?>
			
	</nav> 

	<main>
	<?=$output?>
	</main>

	
</html>