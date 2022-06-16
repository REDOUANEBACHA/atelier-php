<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inscription</title>
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
$message = '';
if (isset ($_POST['login'])  && isset($_POST['Password']) && isset ($_POST['Confirmer']) && isset($_POST['Question']) && isset($_POST['Reponse'])) {
  $login = $_POST['login'];
  $Password = $_POST['Password'];
  $Confirmer = $_POST['Confirmer'];
  $Question = $_POST['Question'];
  $Reponse = $_POST['Reponse'];
if($Confirmer==$Password){
  $sql = 'INSERT INTO authentification(login,Password,Question,Reponse) VALUES(:login,:Password,:Question,:Reponse)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':login'=> $login,':Password' => $Password,':Question' => $Question, ':Reponse' => $Reponse])) {
    echo '<body onLoad="alert(\'vos donnees sont inserer avec succée\')">';
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
  }
}else{
	 echo '<body onLoad="alert(\'Les mots de passe ne correspondent pas.\')">';
	
}



}

 

 ?>      

    
  
<div class="container"  style="width:50%">
  <div class="card mt-5">
   
    <div class="card-body">
      
      <form method="post">
        <div class="form-group col"><center>

		<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20" method="POST">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-70" style="font-family: algerien">
						INSCRIPTION
					</span>
					<?php if(!empty($message)): ?>
                       <div class="alert alert-success">
                           <?= $message; ?>
                       </div>
                    <?php endif; ?>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Entrez nom d'utilisateur">
						<input class="input100" type="text" name="login" id="login">
						<span class="focus-input100" data-placeholder="Nom d'utilisateur"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Entrez mot de passe">
						<input class="input100" type="password" name="Password" id="Password">
						<span class="focus-input100" data-placeholder="Mot de passe"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Confirmer mot de passe">
						<input class="input100" type="password" name="Confirmer" id="Confirmer">
						<span class="focus-input100" data-placeholder="Confirmer Mot de passe"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-50" data-validate="Donnez une question">
						<select name="Question" id="Question">
							<option>-------------  Séléctionner votre question ------------</option>
							<option>La marque de votre premier téléphone ?</option>
							<option>Votre couleur préféré ?</option>
							<option>La marque de voiture que vous préféré ?</option>
							<option>le nom de votre amie d'enfance ?</option>
						</select>
						
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Donnez la Reponse de votre question">
						<input class="input100" type="text" name="Reponse" id="Reponse">
						<span class="focus-input100" data-placeholder="Reponse"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" onclick="validate()">
							 Inscrire
						</button>
					</div>

					
					</ul>
				</form>
			</div>
		</div>
	</div>
		<div id="dropDownSelect1"></div>
</form>
    </div>
  </div>

</div>

	
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">