<?php 
require 'db.php';
$message = '';
if( isset($_POST['libelle'])) {
  
  $libelle = $_POST['libelle'];
  $sql = 'INSERT INTO categorie(libelle) VALUES(:libelle)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':libelle' => $libelle])) {
    $message = 'Catégorie est inserer avec succée';
  }
}

 ?>
<?php require 'nav.php';?>
<div class="container"  style="width:50%">
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="text-align: center">Créer une Catégorie</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group col"><center>
        <label for="libelle">Libelle <input name="libelle" type="text" id="libelle"class="form-control" required="obligatoires"/></label>
        </div></center>       
        <div class="form-group">
          <button type="submit" class="col-md-5 btn-info" style="border-radius: 4px;margin-left: 2%;text-align: center;" > Ajouter catégorie</button><br><br>
          <a  type="submit" class="col-md-2 btn-info" href='index.php' style="border-radius: 4px;margin-left: 2%;text-align: center;">Retour</a>

        </div>
       
      </form>
    </div>
  </div>
</div>

         

<?php
require 'db.php';
$sql = 'SELECT * FROM categorie';
$statement = $connection->prepare($sql);
$statement->execute();
$cat = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<div class="container">
  
      <h2><u>Tous les Catégorie:</u></h2>
      
    <div class="card-body">
      <table class="table table-bordered" style="text-align: center;">
        <tr >
          <th style="text-align: center;">Libelle</th>
          <th style="text-align: center;">Action</th>
        </tr>
        <?php foreach($cat as $prs): ?>
          <tr>
            <td><?= $prs->libelle; ?></td>
            <td>
              
              <a onclick="return confirm('Vous voullez vraiment supprimer ce fournisseur?')" href="suppression_categorie.php?libelle=<?= $prs->libelle ?>" class='btn btn-danger'>Supprimer</a>

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