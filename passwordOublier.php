<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Connecter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script type="text/javascript" src="javaScript.js"></script>
	<link href="styl.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>



<?php
require 'db.php';
$sql = 'SELECT * FROM authentification';
$statement = $connection->prepare($sql);
$statement->execute();
$article = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>

		<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="POST" action="phpReponse.php">
					
					<span class="login100-form-avatar">
						<img src="image/login.png" alt="AVATAR">
					</span>
                   <?php foreach($article as $person): ?>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" >
						<input class="input100" type="text" name="Question" id="Question" value="<?= $person->Question; ?>" disabled/>
					</div>
                   <?php endforeach; ?>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Entrer la reponse">
						<input class="input100" type="password" name="Reponse" id="Reponse">
						<span class="focus-input100" data-placeholder="Réponse"></span>
					</div>

					<div class="container-login100-form-btn">
						<!--<button class="login100-form-btn" type="submit" id="Connecter">
							Connecter
						</button>-->
						 <input name="Confirmer" type="submit" class="login100-form-btn" id="Confirmer" value="Confirmer"/>
					</div>

				
				</form>
			</div>
		</div>
	</div>
		<div id="dropDownSelect1"></div>



    

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Footer -->

