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
        <title>Zaloguj się - MiOS ZSTI</title>
        <?php include '../head.php' ?>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <div id="bg-image-container"><div class="bg-image-unloaded" id="bg-image"></div></div>

		<div id="login">
			<h1>Zaloguj się</h1>
			<form action="../includes/login.inc.php" method="post">
				<input id="signin-username" name="username" placeholder="Nazwa użytkownika">
				<input id="signin-password" name="password" type="password" placeholder="Hasło">
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
				<button type="submit" name="submit">Zaloguj się</button>
				<?php
                    echo "<input hidden name='root' value='".$root_path."'>";
                ?>
			</form>
		</div>

		<?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/bgimage.js"></script>
	</body>
</html>