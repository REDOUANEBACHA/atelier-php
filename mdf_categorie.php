<?php
require 'db.php';
$libelle = $_GET['libelle'];
$sql = 'SELECT * FROM categorie WHERE libelle=:libelle';
$statement = $connection->prepare($sql);
$statement->execute([':libelle' => $libelle ]);
$prs = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['libelle'])) {
  

  $libelle = $_POST['libelle'];
  $sql = "update categorie set libelle='$libelle'";
  $statement = $connection->prepare($sql);
  if ($statement->execute([':libelle' => $libelle])) {
 
     echo '<meta http-equiv="refresh" content="0;URL=ajt_categorie.php">'; 
}
}
 ?>
<div class="container" style="width: 50%">
   
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="text-align: center;">Modifier la catégorie</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>                                   
        </div>
      <?php endif; ?>
      <form method="POST"  ><center>
        <div class="form-group">
          <label for="libelle">Libelle
          <input value="<?= $prs->libelle; ?>" type="text" name="libelle" id="libelle" class="form-control"></label>
        </div></center>
        <div class="form-group">
         <button type="submit" class="btn btn-info">Modifier</button><br><br>
         <a  type="submit" class="col-md-2 btn-info" href='ajt_categorie.php'>Annuler</a>
        </div>        
      </form>

    </div>

  </div>
</div>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">