<?php $root_path = '../' ?>
<?php include $root_path.'includes/init.inc.php' ?>
<?php
    //If the user is logged in, return him HOME.
    if(isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Zarejestruj się - MiOS ZSTI</title>
        <?php include '../head.php' ?>
        <link rel="stylesheet" href="../css/signup.css">
    </head>
    <body>
		<div id="bg-image-container"><div class="bg-image-unloaded" id="bg-image"></div></div>

		<div id="signup">
			<h1>Stwórz konto</h1>
			<form action="../exec/signup.php" method="post">
				<input id="signin-username" name="username" placeholder="Nazwa użytkownika">
				<input id="signin-password" name="password" type="password" placeholder="Hasło">
				<input id="signin-email" name="email" type="email" placeholder="E-mail">
				<input id="signin-first" name="first" placeholder="Imię">
				<input id="signin-last" name="last" placeholder="Nazwisko">
				<?php 
                    if(isset($_GET['error'])) {
                        $error = $_GET['error'];
                        echo '<p class="error-text">';
                        if($error == 'invalid')
                            echo 'Użytkownik o podanych danych nie istnieje.';
                        else if($error == 'empty')
                            echo 'Jedno z pól jest puste.';
                        echo '</p>';
                    }
                ?>
				<button type="submit" name="submit">Zarejestruj się</button>
			</form>
		</div>

		<?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/bgimage.js"></script>
	</body>
</html>