<?php 
require 'db.php';
$message = '';
if( isset($_POST['Nom_fournisseur']) && isset($_POST['Adresse']) && isset($_POST['Telephone']) && isset($_POST['Email'])) {
  
  $Nom_fournisseur = $_POST['Nom_fournisseur'];
  $Adresse = $_POST['Adresse'];
  $Telephone = $_POST['Telephone'];
  $Email = $_POST['Email'];
  $sql = 'INSERT INTO fournisseur(Nom_fournisseur,Adresse,Telephone,Email) VALUES(:Nom_fournisseur,:Adresse,:Telephone,:Email)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':Nom_fournisseur' => $Nom_fournisseur, ':Adresse' => $Adresse, ':Telephone' => $Telephone, ':Email' => $Email])) {
    $message = 'Fournisseur est inserer avec succée';
  }
}

 ?>

<?php require 'nav.php';?>
<div class="container"  style="width:50%">
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="text-align: center">Créer un fournisseur</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group col"><center>
        <label for="Nom_fournisseur">Nom_fournisseur <input name="Nom_fournisseur" type="text" id="Nom_fournisseur"class="form-control" required="obligatoires"/></label><br>
        <label for="Adresse">Adresse<input name="Adresse" type="text" id="Adresse"class="form-control" required="obligatoires"/></label><br>
        <label for="Telephone">Téléphone<input name="Telephone" type="text" id="Telephone"class="form-control" required="obligatoires"/></label><br>
        <label for="Email">Email<input name="Email" type="text" id="Email"class="form-control" required="obligatoires"/></label>
        </div></center>       
        <div class="form-group">
          <button type="submit" class="col-md-5 btn-info" style="border-radius: 4px;margin-left: 2%;text-align: center;" > Ajouter Fournisseur</button><br><br>
          <a  type="submit" class="col-md-2 btn-info" href='index.php' style="border-radius: 4px;margin-left: 2%;text-align: center;" >Retour</a>

        </div>
       
      </form>
    </div>
  </div>
</div>

         

<?php
require 'db.php';
$sql = 'SELECT * FROM fournisseur';
$statement = $connection->prepare($sql);
$statement->execute();
$fournisseur = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<div class="container">
  
      <h2><u>Tous les fournisseurs:</u></h2>
      
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Numéro fournisseur</th>
          <th>Nom_fournisseur</th>
          <th>Adresse</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        <?php foreach($fournisseur as $prs): ?>
          <tr>
            <td><?= $prs->Num_fournisseur; ?></td>
            <td><?= $prs->Nom_fournisseur; ?></td>
            <td><?= $prs->Adresse; ?></td>
            <td><?= $prs->Telephone; ?></td>
            <td><?= $prs->Email; ?></td>
            <td>
              <a href="mdf_fournisseur.php?Num_fournisseur=<?= $prs->Num_fournisseur ?>" class="btn btn-info" >Modifier</a>
              <a onclick="return confirm('Vous voullez vraiment supprimer ce fournisseur?')" href="suppression_fr.php?Num_fournisseur=<?= $prs->Num_fournisseur ?>" class='btn btn-danger'>Supprimer</a>

            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  
</div>

  <br>

</div><br><br><br>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
</body>
</html>
<?php require 'foter.php';?>