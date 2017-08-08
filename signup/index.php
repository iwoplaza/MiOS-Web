<?php $root_path = '../' ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Zarejestruj się - MiOS ZSTI</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/signup.css">
        <meta charset="utf-8" lang="pl">
    </head>
    <body>
		<?php
			include_once $root_path.'header.php';
		?>

		<?php
			include_once $root_path.'sidemenu.php';
		?>

		<div id="signup">
			<h1>Stwórz konto</h1>
			<form action="../includes/signup.inc.php" method="post">
				<input id="signin-username" name="username" placeholder="Nazwa użytkownika">
				<input id="signin-password" name="password" type="password" placeholder="Hasło">
				<input id="signin-email" name="email" type="email" placeholder="E-mail">
				<input id="signin-first" name="first" placeholder="Imię">
				<input id="signin-last" name="last" placeholder="Nazwisko">
				<button type="submit" name="submit">Zarejestruj się</button>
			</form>
		</div>

		<?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/sidebar.js"></script>
	</body>
</html>