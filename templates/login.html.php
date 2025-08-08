<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		* {
			box-sizing: border-box;
		}

		html, body {
			height: 100%;
			margin: 0;
			background-color: #f3f3f3;
			font-family: sans-serif;
		}

		.wrapper {
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.login {
			width: 400px;
			background: white;
			border: 1px solid #ccc;
			border-radius: 10px;
			padding: 30px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
		}

		h2 {
			text-align: center;
			margin-bottom: 20px;
		}

		.errors {
			background-color: #f8d7da;
			color: #721c24;
			padding: 10px;
			margin-bottom: 15px;
			border-radius: 5px;
		}

		label {
			display: block;
			margin-top: 10px;
			margin-bottom: 5px;
			font-weight: bold;
		}

		input[type="text"],
		input[type="password"] {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 15px;
		}

		input[type="submit"] {
			width: 100%;
			padding: 12px;
			background-color: #007BFF;
			color: white;
			border: none;
			border-radius: 5px;
			font-weight: bold;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #0056b3;
		}
	</style>
</head>
<body>

<div class="wrapper">
	<div class="login">
		<h2>Login</h2>

		<?php if (isset($error)): ?>
			<div class="errors"><?= htmlspecialchars($error) ?></div>
		<?php endif; ?>

		<form method="post" action="">
			<label for="email">Your email address</label>
			<input type="text" id="email" name="email">

			<label for="password">Your password</label>
			<input type="password" id="password" name="password">

			<input type="submit" name="login" value="Log in">
		</form>
	</div>
</div>

</body>
</html>
