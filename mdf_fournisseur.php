<?php
require 'db.php';
$Num_fournisseur = $_GET['Num_fournisseur'];
$sql = 'SELECT * FROM fournisseur WHERE Num_fournisseur=:Num_fournisseur';
$statement = $connection->prepare($sql);
$statement->execute([':Num_fournisseur' => $Num_fournisseur ]);
$prs = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Nom_fournisseur'])  && isset($_POST['Adresse']) && isset($_POST['Telephone']) && isset($_POST['Email']) ) {
  

  $Nom_fournisseur = $_POST['Nom_fournisseur'];
  $Adresse = $_POST['Adresse'];
  $Telephone = $_POST['Telephone'];
  $Email = $_POST['Email'];
  $sql = "update fournisseur set Nom_fournisseur='$Nom_fournisseur',Adresse='$Adresse',Telephone='$Telephone',Email='$Email' where Num_fournisseur='$Num_fournisseur'";
  $statement = $connection->prepare($sql);
  if ($statement->execute([':Nom_fournisseur' => $Nom_fournisseur, ':Adresse' => $Adresse, ':Telephone' => $Telephone , ':Email' => $Email , ':Num_fournisseur' => $Num_fournisseur])) {
 
     echo '<meta http-equiv="refresh" content="0;URL=ajt_fournisseur.php">'; 
}
}
 ?>
 <?php require 'nav.php';?>
<div class="container" style="width: 50%">
   
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="text-align: center;">Modifier le fournisseur <strong style="color: blue "><?= $prs->Num_fournisseur; ?></strong></h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>                                   
        </div>
      <?php endif; ?>
      <form method="POST"  ><center>
        <div class="form-group">
          <label for="Nom_fournisseur">Nom fournisseur
          <input value="<?= $prs->Nom_fournisseur; ?>" type="text" name="Nom_fournisseur" id="Nom_fournisseur" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="Adresse">Adresse
          <input type="text" value="<?= $prs->Adresse; ?>" name="Adresse" id="Adresse" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="Telephone">Adresse
          <input type="text" value="<?= $prs->Telephone; ?>" name="Telephone" id="Telephone" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="Email">Email
          <input type="email" value="<?= $prs->Email; ?>" name="Email" id="Email" class="form-control"></label>
        </div></center>
        <div class="form-group">
         <button type="submit" class="btn btn-info" style="margin-left: 2%">Modifier</button><br><br>
         <a  type="submit" class="col-md-2 btn-info" href='ajt_fournisseur.php'style="border-radius: 4px;width: 10%;margin-left: 2%;height:30px;padding: 5px;text-align: center;">Annuler</a><br><br><br><br>
        </div>        
      </form>

    </div>

  </div>
</div>
<?php require 'foter.php';?>

 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->